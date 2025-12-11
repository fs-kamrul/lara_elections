<?php

namespace Modules\Option\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\Option\Http\Models\OptionShift;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\Option\Repositories\Interfaces\OptionShiftInterface;
use Modules\Option\Http\Imports\OptionShiftImport;
use Modules\Option\Tables\OptionShiftTable;
use mysql_xdevapi\Exception;
use Throwable;

class OptionShiftController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var OptionShiftInterface
     */
    protected $optionshiftRepository;

    /**
     * OptionShiftController constructor.
     * @param OptionShiftInterface $optionshiftRepository
     */
    public function __construct(OptionShiftInterface $optionshiftRepository)
    {
        $this->optionshiftRepository = $optionshiftRepository;
    }
    protected $photo_path = 'uploads/option/optionshift/';

    /**
     * @param OptionShiftTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(OptionShiftTable $dataTable)
    {
        if (!auth()->user()->can('optionshift_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('optionshift_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift_import'));
        $data = array();
        $data['title']        = 'optionshift_import';
        return view('option::optionshift.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('optionshift_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new OptionShiftImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('option::lang.record_save_successfully');
        return redirect()->route('optionshift.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('optionshift_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('optionshift_list_all')) {
            $custom_table = OptionShift::all();
        }else {
            $custom_table = OptionShift::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('optionshift_pdf')) {
                $html .= '<a target="_blank" href="' . url('option/optionshift/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('option::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('optionshift_show')) {
                $html .= '<a href="' . url('option/optionshift/' . $row->id) . '" class="btn btn-xs btn-success">' . __('option::lang.view') . '</a> ';
            }
            if(auth()->user()->can('optionshift_edit')) {
                $html .= '<a  href="' . url('option/optionshift/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('option::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('optionshift_destroy')) {
                $html .= '<form action="' . url('option/optionshift', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('option::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'option/optionshift') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('optionshift_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift_create'));
        $data = array();
        $data['title']        = 'optionshift_create';
        return view('option::optionshift.create',$data);
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
        if (!auth()->user()->can('optionshift_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->optionshiftRepository->createOrUpdate(array_merge($request->input(), [
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
            event(new CreatedContentEvent(OPTIONSHIFT_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('optionshift.index'))
                ->setNextUrl(route('optionshift.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('optionshift.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\Option\Http\Models\OptionShift  $optionshift
     * @return \Illuminate\Http\Response
     */
    public function show(OptionShift $optionshift)
    {
        if (!auth()->user()->can('optionshift_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift_show'));
        $data = array();
        $data['optionshift']        = $optionshift;
        $data['title']        = 'optionshift_show';
        return view('option::optionshift.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\Option\Http\Models\OptionShift  $optionshift
     * @return \Illuminate\Http\Response
     */
    public function pdf(OptionShift $optionshift)
    {
        if (!auth()->user()->can('optionshift_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift_show'));
        $data = array();
        $data['optionshift']        = $optionshift;
        $data['title']        = 'optionshift_show';
        return view('option::optionshift.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\Option\Http\Models\OptionShift  $optionshift
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionShift $optionshift)
    {
        if (!auth()->user()->can('optionshift_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionshift_edit'));
        $data = array();
        $data['title']        = 'optionshift_edit';
        $data['record']        = $this->optionshiftRepository->findOrFail($optionshift->id);
        return view('option::optionshift.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Option\Http\Models\OptionShift  $optionshift
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionShift  $optionshift, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('optionshift_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $optionshift->id;
        $optionshift = $this->optionshiftRepository->firstOrNew(compact('id'));
        $optionshift->fill($request->input());
        $this->optionshiftRepository->createOrUpdate($optionshift);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($optionshift->$file_name, $path);

            $optionshift->$file_name      = processUpload($request, $optionshift,$file_name,$path);
            $optionshift->save();
        }

        event(new UpdatedContentEvent(OPTIONSHIFT_MODULE_SCREEN_NAME, $request, $optionshift));

        return $response
            ->setPreviousUrl(route('optionshift.index'))
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
        if (!auth()->user()->can('optionshift_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $optionshift = $this->optionshiftRepository->findOrFail($id);
            $this->optionshiftRepository->delete($optionshift);
            $path = $this->photo_path;
            deleteFile($optionshift->photo, $path);
            event(new DeletedContentEvent(OPTIONSHIFT_MODULE_SCREEN_NAME, $request, $optionshift));

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
        return $this->executeDeleteItems($request, $response, $this->optionshiftRepository, OPTIONSHIFT_MODULE_SCREEN_NAME);
    }
}
