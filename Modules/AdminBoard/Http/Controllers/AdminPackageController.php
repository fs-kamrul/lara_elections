<?php

namespace Modules\AdminBoard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminBoard\Forms\AdminPackageForm;
use Modules\AdminBoard\Services\SaveFacilitiesService;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\AdminBoard\Http\Models\AdminPackage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\AdminBoard\Repositories\Interfaces\AdminPackageInterface;
use Modules\AdminBoard\Http\Imports\AdminPackageImport;
use Modules\AdminBoard\Tables\AdminPackageTable;
use mysql_xdevapi\Exception;
use Throwable;
use Assets;

class AdminPackageController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdminPackageInterface
     */
    protected $adminpackageRepository;

    /**
     * AdminPackageController constructor.
     * @param AdminPackageInterface $adminpackageRepository
     */
    public function __construct(AdminPackageInterface $adminpackageRepository)
    {
        $this->adminpackageRepository = $adminpackageRepository;
    }
    protected $photo_path = 'uploads/adminboard/adminpackage/';

    /**
     * @param AdminPackageTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdminPackageTable $dataTable)
    {
        if (!auth()->user()->can('adminpackage_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('adminpackage_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage_import'));
        $data = array();
        $data['title']        = 'adminpackage_import';
        return view('adminboard::adminpackage.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('adminpackage_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdminPackageImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('adminboard::lang.record_save_successfully');
        return redirect()->route('adminpackage.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('adminpackage_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('adminpackage_list_all')) {
            $custom_table = AdminPackage::all();
        }else {
            $custom_table = AdminPackage::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('adminpackage_pdf')) {
                $html .= '<a target="_blank" href="' . url('adminboard/adminpackage/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('adminpackage_show')) {
                $html .= '<a href="' . url('adminboard/adminpackage/' . $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.view') . '</a> ';
            }
            if(auth()->user()->can('adminpackage_edit')) {
                $html .= '<a  href="' . url('adminboard/adminpackage/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('adminboard::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('adminpackage_destroy')) {
                $html .= '<form action="' . url('adminboard/adminpackage', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('adminboard::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'adminboard/adminpackage') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('adminpackage_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage_create'));

        Assets::addScriptsDirectly('vendor/Modules/AdminBoard/js/components.js');
        Assets::usingVueJS();

        return AdminPackageForm::create()->renderForm();
        //$data = array();
        //$data['title']        = 'adminpackage_create';
        //return view('adminboard::adminpackage.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DboardHttpResponse $response, SaveFacilitiesService $saveFacilitiesService)
    {
        if (!auth()->user()->can('adminpackage_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->adminpackageRepository->createOrUpdate(array_merge($request->input(), [
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

            $saveFacilitiesService->execute($record, $request->input('facilities', []));

            event(new CreatedContentEvent(ADMINPACKAGE_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('adminpackage.index'))
                ->setNextUrl(route('adminpackage.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('adminpackage.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminPackage  $adminpackage
     * @return \Illuminate\Http\Response
     */
    public function show(AdminPackage $adminpackage)
    {
        if (!auth()->user()->can('adminpackage_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage_show'));
        $data = array();
        $data['adminpackage']        = $adminpackage;
        $data['title']        = 'adminpackage_show';
        return view('adminboard::adminpackage.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminPackage  $adminpackage
     * @return \Illuminate\Http\Response
     */
    public function pdf(AdminPackage $adminpackage)
    {
        if (!auth()->user()->can('adminpackage_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage_show'));
        $data = array();
        $data['adminpackage']        = $adminpackage;
        $data['title']        = 'adminpackage_show';
        return view('adminboard::adminpackage.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminPackage  $adminpackage
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminPackage $adminpackage)
    {
        if (!auth()->user()->can('adminpackage_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminpackage_edit'));

        Assets::addScriptsDirectly('vendor/Modules/AdminBoard/js/components.js');
        Assets::usingVueJS();

        return AdminPackageForm::createFromModel($adminpackage)->renderForm();
     //   $data = array();
      //  $data['title']        = 'adminpackage_edit';
     //   $data['record']        = $this->adminpackageRepository->findOrFail($adminpackage->id);
      //  return view('adminboard::adminpackage.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\AdminBoard\Http\Models\AdminPackage  $adminpackage
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminPackage  $adminpackage, DboardHttpResponse $response, SaveFacilitiesService $saveFacilitiesService)
    {
        if (!auth()->user()->can('adminpackage_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $adminpackage->id;
        $adminpackage = $this->adminpackageRepository->firstOrNew(compact('id'));
        $adminpackage->fill($request->input());
        $this->adminpackageRepository->createOrUpdate($adminpackage);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($adminpackage->$file_name, $path);

            $adminpackage->$file_name      = processUpload($request, $adminpackage,$file_name,$path);
            $adminpackage->save();
        }

//        dd($request->input('facilities', []));
        $saveFacilitiesService->execute($adminpackage, $request->input('facilities', []));
        event(new UpdatedContentEvent(ADMINPACKAGE_MODULE_SCREEN_NAME, $request, $adminpackage));

        return $response
            ->setPreviousUrl(route('adminpackage.index'))
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
        if (!auth()->user()->can('adminpackage_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $adminpackage = $this->adminpackageRepository->findOrFail($id);
            $this->adminpackageRepository->delete($adminpackage);
            $path = $this->photo_path;
            deleteFile($adminpackage->photo, $path);
            event(new DeletedContentEvent(ADMINPACKAGE_MODULE_SCREEN_NAME, $request, $adminpackage));

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
        return $this->executeDeleteItems($request, $response, $this->adminpackageRepository, ADMINPACKAGE_MODULE_SCREEN_NAME);
    }
}
