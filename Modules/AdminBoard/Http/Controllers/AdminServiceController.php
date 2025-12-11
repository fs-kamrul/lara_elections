<?php

namespace Modules\AdminBoard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminBoard\Forms\AdminServiceForm;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\AdminBoard\Http\Models\AdminService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\AdminBoard\Repositories\Interfaces\AdminServiceInterface;
use Modules\AdminBoard\Http\Imports\AdminServiceImport;
use Modules\AdminBoard\Tables\AdminServiceTable;
use mysql_xdevapi\Exception;
use Throwable;

class AdminServiceController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdminServiceInterface
     */
    protected $adminserviceRepository;

    /**
     * AdminServiceController constructor.
     * @param AdminServiceInterface $adminserviceRepository
     */
    public function __construct(AdminServiceInterface $adminserviceRepository)
    {
        $this->adminserviceRepository = $adminserviceRepository;
    }
    protected $photo_path = 'uploads/adminboard/adminservice/';

    /**
     * @param AdminServiceTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdminServiceTable $dataTable)
    {
        if (!auth()->user()->can('adminservice_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('adminservice_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice_import'));
        $data = array();
        $data['title']        = 'adminservice_import';
        return view('adminboard::adminservice.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('adminservice_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdminServiceImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('adminboard::lang.record_save_successfully');
        return redirect()->route('adminservice.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('adminservice_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('adminservice_list_all')) {
            $custom_table = AdminService::all();
        }else {
            $custom_table = AdminService::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('adminservice_pdf')) {
                $html .= '<a target="_blank" href="' . url('adminboard/adminservice/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('adminservice_show')) {
                $html .= '<a href="' . url('adminboard/adminservice/' . $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.view') . '</a> ';
            }
            if(auth()->user()->can('adminservice_edit')) {
                $html .= '<a  href="' . url('adminboard/adminservice/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('adminboard::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('adminservice_destroy')) {
                $html .= '<form action="' . url('adminboard/adminservice', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('adminboard::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'adminboard/adminservice') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('adminservice_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice_create'));

        return AdminServiceForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'adminservice_create';
        //return view('adminboard::adminservice.create',$data);
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
        if (!auth()->user()->can('adminservice_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->adminserviceRepository->createOrUpdate(array_merge($request->input(), [
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
            event(new CreatedContentEvent(ADMINSERVICE_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('adminservice.index'))
                ->setNextUrl(route('adminservice.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('adminservice.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminService  $adminservice
     * @return \Illuminate\Http\Response
     */
    public function show(AdminService $adminservice)
    {
        if (!auth()->user()->can('adminservice_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice_show'));
        $data = array();
        $data['adminservice']        = $adminservice;
        $data['title']        = 'adminservice_show';
        return view('adminboard::adminservice.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminService  $adminservice
     * @return \Illuminate\Http\Response
     */
    public function pdf(AdminService $adminservice)
    {
        if (!auth()->user()->can('adminservice_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice_show'));
        $data = array();
        $data['adminservice']        = $adminservice;
        $data['title']        = 'adminservice_show';
        return view('adminboard::adminservice.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminService  $adminservice
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminService $adminservice)
    {
        if (!auth()->user()->can('adminservice_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminservice_edit'));

        return AdminServiceForm::createFromModel($adminservice)->renderForm();
     //   $data = array();
      //  $data['title']        = 'adminservice_edit';
     //   $data['record']        = $this->adminserviceRepository->findOrFail($adminservice->id);
      //  return view('adminboard::adminservice.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\AdminBoard\Http\Models\AdminService  $adminservice
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminService  $adminservice, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('adminservice_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $adminservice->id;
        $adminservice = $this->adminserviceRepository->firstOrNew(compact('id'));
        $adminservice->fill($request->input());
        $this->adminserviceRepository->createOrUpdate($adminservice);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($adminservice->$file_name, $path);

            $adminservice->$file_name      = processUpload($request, $adminservice,$file_name,$path);
            $adminservice->save();
        }

        event(new UpdatedContentEvent(ADMINSERVICE_MODULE_SCREEN_NAME, $request, $adminservice));

        return $response
            ->setPreviousUrl(route('adminservice.index'))
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
        if (!auth()->user()->can('adminservice_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $adminservice = $this->adminserviceRepository->findOrFail($id);
            $this->adminserviceRepository->delete($adminservice);
            $path = $this->photo_path;
            deleteFile($adminservice->photo, $path);
            event(new DeletedContentEvent(ADMINSERVICE_MODULE_SCREEN_NAME, $request, $adminservice));

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
        return $this->executeDeleteItems($request, $response, $this->adminserviceRepository, ADMINSERVICE_MODULE_SCREEN_NAME);
    }
}
