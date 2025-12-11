<?php

namespace Modules\Election\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Election\Forms\ElectionForm;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\Election\Http\Models\Election;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\Election\Repositories\Interfaces\ElectionInterface;
use Modules\Election\Http\Imports\ElectionImport;
use Modules\Election\Tables\ElectionTable;
use mysql_xdevapi\Exception;
use Throwable;

class ElectionController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var ElectionInterface
     */
    protected $electionRepository;

    /**
     * ElectionController constructor.
     * @param ElectionInterface $electionRepository
     */
    public function __construct(ElectionInterface $electionRepository)
    {
        $this->electionRepository = $electionRepository;
    }
    protected $photo_path = 'uploads/election/election/';

    /**
     * @param ElectionTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(ElectionTable $dataTable)
    {
        if (!auth()->user()->can('election_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('election_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election_import'));
        $data = array();
        $data['title']        = 'election_import';
        return view('election::election.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('election_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new ElectionImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('election::lang.record_save_successfully');
        return redirect()->route('election.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('election_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('election_list_all')) {
            $custom_table = Election::all();
        }else {
            $custom_table = Election::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('election_pdf')) {
                $html .= '<a target="_blank" href="' . url('election/election/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('election::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('election_show')) {
                $html .= '<a href="' . url('election/election/' . $row->id) . '" class="btn btn-xs btn-success">' . __('election::lang.view') . '</a> ';
            }
            if(auth()->user()->can('election_edit')) {
                $html .= '<a  href="' . url('election/election/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('election::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('election_destroy')) {
                $html .= '<form action="' . url('election/election', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('election::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'election/election') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('election_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election_create'));

        return ElectionForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'election_create';
        //return view('election::election.create',$data);
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
        if (!auth()->user()->can('election_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->electionRepository->createOrUpdate(array_merge($request->input(), [
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
            event(new CreatedContentEvent(ELECTION_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('election.index'))
                ->setNextUrl(route('election.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

//            dd($e);
            return $response
                ->setPreviousUrl(route('election.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\Election\Http\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        if (!auth()->user()->can('election_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election_show'));
        $data = array();
        $data['election']        = $election;
        $data['title']        = 'election_show';
        return view('election::election.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\Election\Http\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function pdf(Election $election)
    {
        if (!auth()->user()->can('election_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election_show'));
        $data = array();
        $data['election']        = $election;
        $data['title']        = 'election_show';
        return view('election::election.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\Election\Http\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        if (!auth()->user()->can('election_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('election::lang.election_edit'));

        return ElectionForm::createFromModel($election)->renderForm();
     //   $data = array();
      //  $data['title']        = 'election_edit';
     //   $data['record']        = $this->electionRepository->findOrFail($election->id);
      //  return view('election::election.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Election\Http\Models\Election  $election
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election  $election, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('election_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $election->id;
        $election = $this->electionRepository->firstOrNew(compact('id'));
        $election->fill($request->input());
        $this->electionRepository->createOrUpdate($election);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($election->$file_name, $path);

            $election->$file_name      = processUpload($request, $election,$file_name,$path);
            $election->save();
        }

        event(new UpdatedContentEvent(ELECTION_MODULE_SCREEN_NAME, $request, $election));

        return $response
            ->setPreviousUrl(route('election.index'))
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
        if (!auth()->user()->can('election_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $election = $this->electionRepository->findOrFail($id);
            $this->electionRepository->delete($election);
            $path = $this->photo_path;
            deleteFile($election->photo, $path);
            event(new DeletedContentEvent(ELECTION_MODULE_SCREEN_NAME, $request, $election));

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
        return $this->executeDeleteItems($request, $response, $this->electionRepository, ELECTION_MODULE_SCREEN_NAME);
    }
}
