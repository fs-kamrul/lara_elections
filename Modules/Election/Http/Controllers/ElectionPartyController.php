<?php

namespace Modules\Election\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Election\Forms\ElectionPartyForm;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\Election\Http\Models\ElectionParty;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\Election\Repositories\Interfaces\ElectionPartyInterface;
use Modules\Election\Http\Imports\ElectionPartyImport;
use Modules\Election\Tables\ElectionPartyTable;
use mysql_xdevapi\Exception;
use Throwable;

class ElectionPartyController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var ElectionPartyInterface
     */
    protected $electionpartyRepository;

    /**
     * ElectionPartyController constructor.
     * @param ElectionPartyInterface $electionpartyRepository
     */
    public function __construct(ElectionPartyInterface $electionpartyRepository)
    {
        $this->electionpartyRepository = $electionpartyRepository;
    }
    protected $photo_path = 'uploads/election/electionparty/';

    /**
     * @param ElectionPartyTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(ElectionPartyTable $dataTable)
    {
        if (!auth()->user()->can('electionparty_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('electionparty_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty_import'));
        $data = array();
        $data['title']        = 'electionparty_import';
        return view('election::electionparty.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('electionparty_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new ElectionPartyImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('election::lang.record_save_successfully');
        return redirect()->route('electionparty.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('electionparty_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('electionparty_list_all')) {
            $custom_table = ElectionParty::all();
        }else {
            $custom_table = ElectionParty::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('electionparty_pdf')) {
                $html .= '<a target="_blank" href="' . url('election/electionparty/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('election::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('electionparty_show')) {
                $html .= '<a href="' . url('election/electionparty/' . $row->id) . '" class="btn btn-xs btn-success">' . __('election::lang.view') . '</a> ';
            }
            if(auth()->user()->can('electionparty_edit')) {
                $html .= '<a  href="' . url('election/electionparty/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('election::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('electionparty_destroy')) {
                $html .= '<form action="' . url('election/electionparty', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('election::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'election/electionparty') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
            return $html;
        })->addColumn('status', function ($row) {
            $html = array_status_disign($row->status);
            return $html;
        })->addColumn('user', function ($row) {
            $html = $row->user->name;
            return $html;
        })->rawColumns(['action','status','photo','user'])->toJson();;
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!auth()->user()->can('electionparty_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty_create'));

        return ElectionPartyForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'electionparty_create';
        //return view('election::electionparty.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('electionparty_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->electionpartyRepository->createOrUpdate(array_merge($request->input(), [
                'user_id' => Auth::id(),
                'uuid'    => gen_uuid(),
                'slug'    => checkSlugFunction($request->input('name')),
            ]));

            $file_name = 'photo';
            if ($request->hasFile($file_name))
            {
//                return $file_name;
                $rules = $request->validate([
                    "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
                ]);
                $path = $this->photo_path;
                deleteFile($record->$file_name, $path);

                $record->$file_name      = processUpload($request, $record,$file_name, $path);
                $record->save();
            }
            event(new CreatedContentEvent(ELECTIONPARTY_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('electionparty.index'))
                ->setNextUrl(route('electionparty.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('electionparty.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\Election\Http\Models\ElectionParty  $electionparty
     * @return \Illuminate\Http\Response
     */
    public function show(ElectionParty $electionparty)
    {
        if (!auth()->user()->can('electionparty_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty_show'));
        $data = array();
        $data['electionparty']        = $electionparty;
        $data['title']        = 'electionparty_show';
        return view('election::electionparty.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\Election\Http\Models\ElectionParty  $electionparty
     * @return \Illuminate\Http\Response
     */
    public function pdf(ElectionParty $electionparty)
    {
        if (!auth()->user()->can('electionparty_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty_show'));
        $data = array();
        $data['electionparty']        = $electionparty;
        $data['title']        = 'electionparty_show';
        return view('election::electionparty.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\Election\Http\Models\ElectionParty  $electionparty
     * @return \Illuminate\Http\Response
     */
    public function edit(ElectionParty $electionparty)
    {
        if (!auth()->user()->can('electionparty_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.electionparty_edit'));

        return ElectionPartyForm::createFromModel($electionparty)->renderForm();
     //   $data = array();
      //  $data['title']        = 'electionparty_edit';
     //   $data['record']        = $this->electionpartyRepository->findOrFail($electionparty->id);
      //  return view('election::electionparty.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Election\Http\Models\ElectionParty  $electionparty
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ElectionParty  $electionparty, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('electionparty_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $electionparty->id;
        $electionparty = $this->electionpartyRepository->firstOrNew(compact('id'));
        $electionparty->fill($request->input());
        $this->electionpartyRepository->createOrUpdate($electionparty);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($electionparty->$file_name, $path);

            $electionparty->$file_name      = processUpload($request, $electionparty,$file_name,$path);
            $electionparty->save();
        }

        event(new UpdatedContentEvent(ELECTIONPARTY_MODULE_SCREEN_NAME, $request, $electionparty));

        return $response
            ->setPreviousUrl(route('electionparty.index'))
            ->setMessage(trans('kamruldashboard::notices.update_success_message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     */
    public function destroy(Request $request, $id, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('electionparty_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $electionparty = $this->electionpartyRepository->findOrFail($id);
            $this->electionpartyRepository->delete($electionparty);
            $path = $this->photo_path;
            deleteFile($electionparty->photo, $path);
            event(new DeletedContentEvent(ELECTIONPARTY_MODULE_SCREEN_NAME, $request, $electionparty));

            return $response->setMessage(trans('kamruldashboard::notices.delete_success_message'));
        } catch ( \Exception $e) {
            return $response
                ->setError()
                ->setMessage($e->getMessage());
        }
    }
    /**
     * @param Request $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @throws \Exception
     */
    public function deletes(Request $request, DboardHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->electionpartyRepository, ELECTIONPARTY_MODULE_SCREEN_NAME);
    }
}
