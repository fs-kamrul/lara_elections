<?php

namespace Modules\AdminBoard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminBoard\Forms\AdminTypeForm;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\AdminBoard\Http\Models\AdminType;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\AdminBoard\Repositories\Interfaces\AdminTypeInterface;
use Modules\AdminBoard\Http\Imports\AdminTypeImport;
use Modules\AdminBoard\Tables\AdminTypeTable;
use mysql_xdevapi\Exception;
use Throwable;

class AdminTypeController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdminTypeInterface
     */
    protected $admintypeRepository;

    /**
     * AdminTypeController constructor.
     * @param AdminTypeInterface $admintypeRepository
     */
    public function __construct(AdminTypeInterface $admintypeRepository)
    {
        $this->admintypeRepository = $admintypeRepository;
    }
    protected $photo_path = 'uploads/adminboard/admintype/';

    /**
     * @param AdminTypeTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdminTypeTable $dataTable)
    {
        if (!auth()->user()->can('admintype_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('admintype_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype_import'));
        $data = array();
        $data['title']        = 'admintype_import';
        return view('adminboard::admintype.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('admintype_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdminTypeImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('adminboard::lang.record_save_successfully');
        return redirect()->route('admintype.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('admintype_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('admintype_list_all')) {
            $custom_table = AdminType::all();
        }else {
            $custom_table = AdminType::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('admintype_pdf')) {
                $html .= '<a target="_blank" href="' . url('adminboard/admintype/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('admintype_show')) {
                $html .= '<a href="' . url('adminboard/admintype/' . $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.view') . '</a> ';
            }
            if(auth()->user()->can('admintype_edit')) {
                $html .= '<a  href="' . url('adminboard/admintype/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('adminboard::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('admintype_destroy')) {
                $html .= '<form action="' . url('adminboard/admintype', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('adminboard::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'adminboard/admintype') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('admintype_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype_create'));

        return AdminTypeForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'admintype_create';
        //return view('adminboard::admintype.create',$data);
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
        if (!auth()->user()->can('admintype_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->admintypeRepository->createOrUpdate(array_merge($request->input(), [
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
            event(new CreatedContentEvent(ADMINTYPE_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('admintype.index'))
                ->setNextUrl(route('admintype.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('admintype.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminType  $admintype
     * @return \Illuminate\Http\Response
     */
    public function show(AdminType $admintype)
    {
        if (!auth()->user()->can('admintype_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype_show'));
        $data = array();
        $data['admintype']        = $admintype;
        $data['title']        = 'admintype_show';
        return view('adminboard::admintype.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminType  $admintype
     * @return \Illuminate\Http\Response
     */
    public function pdf(AdminType $admintype)
    {
        if (!auth()->user()->can('admintype_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype_show'));
        $data = array();
        $data['admintype']        = $admintype;
        $data['title']        = 'admintype_show';
        return view('adminboard::admintype.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminType  $admintype
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminType $admintype)
    {
        if (!auth()->user()->can('admintype_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.admintype_edit'));

        return AdminTypeForm::createFromModel($admintype)->renderForm();
     //   $data = array();
      //  $data['title']        = 'admintype_edit';
     //   $data['record']        = $this->admintypeRepository->findOrFail($admintype->id);
      //  return view('adminboard::admintype.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\AdminBoard\Http\Models\AdminType  $admintype
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminType  $admintype, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('admintype_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $admintype->id;
        $admintype = $this->admintypeRepository->firstOrNew(compact('id'));
        $admintype->fill($request->input());
        $this->admintypeRepository->createOrUpdate($admintype);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($admintype->$file_name, $path);

            $admintype->$file_name      = processUpload($request, $admintype,$file_name,$path);
            $admintype->save();
        }

        event(new UpdatedContentEvent(ADMINTYPE_MODULE_SCREEN_NAME, $request, $admintype));

        return $response
            ->setPreviousUrl(route('admintype.index'))
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
        if (!auth()->user()->can('admintype_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $admintype = $this->admintypeRepository->findOrFail($id);
            $this->admintypeRepository->delete($admintype);
            $path = $this->photo_path;
            deleteFile($admintype->photo, $path);
            event(new DeletedContentEvent(ADMINTYPE_MODULE_SCREEN_NAME, $request, $admintype));

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
        return $this->executeDeleteItems($request, $response, $this->admintypeRepository, ADMINTYPE_MODULE_SCREEN_NAME);
    }
}
