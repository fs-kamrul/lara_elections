<?php

namespace Modules\AdminBoard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminBoard\Forms\AdminFtpServerForm;
use Modules\AdminBoard\Services\StoreFtpServerCategoryService;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\AdminBoard\Http\Models\AdminFtpServer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\AdminBoard\Repositories\Interfaces\AdminFtpServerInterface;
use Modules\AdminBoard\Http\Imports\AdminFtpServerImport;
use Modules\AdminBoard\Tables\AdminFtpServerTable;
use mysql_xdevapi\Exception;
use Throwable;

class AdminFtpServerController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdminFtpServerInterface
     */
    protected $adminftpserverRepository;

    /**
     * AdminFtpServerController constructor.
     * @param AdminFtpServerInterface $adminftpserverRepository
     */
    public function __construct(AdminFtpServerInterface $adminftpserverRepository)
    {
        $this->adminftpserverRepository = $adminftpserverRepository;
    }
    protected $photo_path = 'uploads/adminboard/adminftpserver/';

    /**
     * @param AdminFtpServerTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdminFtpServerTable $dataTable)
    {
        if (!auth()->user()->can('adminftpserver_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('adminftpserver_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver_import'));
        $data = array();
        $data['title']        = 'adminftpserver_import';
        return view('adminboard::adminftpserver.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('adminftpserver_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdminFtpServerImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('adminboard::lang.record_save_successfully');
        return redirect()->route('adminftpserver.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('adminftpserver_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('adminftpserver_list_all')) {
            $custom_table = AdminFtpServer::all();
        }else {
            $custom_table = AdminFtpServer::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('adminftpserver_pdf')) {
                $html .= '<a target="_blank" href="' . url('adminboard/adminftpserver/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('adminftpserver_show')) {
                $html .= '<a href="' . url('adminboard/adminftpserver/' . $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.view') . '</a> ';
            }
            if(auth()->user()->can('adminftpserver_edit')) {
                $html .= '<a  href="' . url('adminboard/adminftpserver/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('adminboard::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('adminftpserver_destroy')) {
                $html .= '<form action="' . url('adminboard/adminftpserver', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('adminboard::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'adminboard/adminftpserver') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('adminftpserver_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver_create'));

        return AdminFtpServerForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'adminftpserver_create';
        //return view('adminboard::adminftpserver.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreFtpServerCategoryService $ftpServerCategoryService, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('adminftpserver_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->adminftpserverRepository->createOrUpdate(array_merge($request->input(), [
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
            $ftpServerCategoryService->execute($request, $record);
            event(new CreatedContentEvent(ADMINFTPSERVER_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('adminftpserver.index'))
                ->setNextUrl(route('adminftpserver.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('adminftpserver.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminFtpServer  $adminftpserver
     * @return \Illuminate\Http\Response
     */
    public function show(AdminFtpServer $adminftpserver)
    {
        if (!auth()->user()->can('adminftpserver_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver_show'));
        $data = array();
        $data['adminftpserver']        = $adminftpserver;
        $data['title']        = 'adminftpserver_show';
        return view('adminboard::adminftpserver.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminFtpServer  $adminftpserver
     * @return \Illuminate\Http\Response
     */
    public function pdf(AdminFtpServer $adminftpserver)
    {
        if (!auth()->user()->can('adminftpserver_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver_show'));
        $data = array();
        $data['adminftpserver']        = $adminftpserver;
        $data['title']        = 'adminftpserver_show';
        return view('adminboard::adminftpserver.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminFtpServer  $adminftpserver
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminFtpServer $adminftpserver)
    {
        if (!auth()->user()->can('adminftpserver_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminftpserver_edit'));

        return AdminFtpServerForm::createFromModel($adminftpserver)->renderForm();
     //   $data = array();
      //  $data['title']        = 'adminftpserver_edit';
     //   $data['record']        = $this->adminftpserverRepository->findOrFail($adminftpserver->id);
      //  return view('adminboard::adminftpserver.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\AdminBoard\Http\Models\AdminFtpServer  $adminftpserver
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminFtpServer  $adminftpserver, StoreFtpServerCategoryService $ftpServerCategoryService, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('adminftpserver_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $adminftpserver->id;
        $adminftpserver = $this->adminftpserverRepository->firstOrNew(compact('id'));
        $adminftpserver->fill($request->input());
        $this->adminftpserverRepository->createOrUpdate($adminftpserver);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($adminftpserver->$file_name, $path);

            $adminftpserver->$file_name      = processUpload($request, $adminftpserver,$file_name,$path);
            $adminftpserver->save();
        }
        $ftpServerCategoryService->execute($request, $adminftpserver);
        event(new UpdatedContentEvent(ADMINFTPSERVER_MODULE_SCREEN_NAME, $request, $adminftpserver));

        return $response
            ->setPreviousUrl(route('adminftpserver.index'))
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
        if (!auth()->user()->can('adminftpserver_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $adminftpserver = $this->adminftpserverRepository->findOrFail($id);
            $this->adminftpserverRepository->delete($adminftpserver);
            $path = $this->photo_path;
            deleteFile($adminftpserver->photo, $path);
            event(new DeletedContentEvent(ADMINFTPSERVER_MODULE_SCREEN_NAME, $request, $adminftpserver));

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
        return $this->executeDeleteItems($request, $response, $this->adminftpserverRepository, ADMINFTPSERVER_MODULE_SCREEN_NAME);
    }
}
