<?php

namespace Modules\AdminBoard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AdminBoard\Forms\EventForm;
use Modules\AdminBoard\Services\StoreEventCategoryService;
use Modules\AdminBoard\Services\StoreEventTeamService;
use Modules\AdminBoard\Services\StoreVideoStoriesService;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\AdminBoard\Repositories\Interfaces\AdminEventInterface;
use Modules\AdminBoard\Http\Imports\AdminEventImport;
use Modules\AdminBoard\Tables\AdminEventTable;
use mysql_xdevapi\Exception;
use Throwable;

class AdminEventController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdminEventInterface
     */
    protected $admineventRepository;

    /**
     * AdminEventController constructor.
     * @param AdminEventInterface $admineventRepository
     */
    public function __construct(AdminEventInterface $admineventRepository)
    {
        $this->admineventRepository = $admineventRepository;
    }
    protected $photo_path = 'uploads/adminboard/adminevent/';

    /**
     * @param AdminEventTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdminEventTable $dataTable)
    {
        if (!auth()->user()->can('adminevent_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminevent'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('adminevent_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminevent_import'));
        $data = array();
        $data['title']        = 'adminevent_import';
        return view('adminboard::adminevent.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('adminevent_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdminEventImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('adminboard::lang.record_save_successfully');
        return redirect()->route('adminevent.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('adminevent_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('adminevent_list_all')) {
            $custom_table = AdminEvent::all();
        }else {
            $custom_table = AdminEvent::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('adminevent_pdf')) {
                $html .= '<a target="_blank" href="' . url('adminboard/adminevent/pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('adminevent_show')) {
                $html .= '<a href="' . url('adminboard/adminevent/' . $row->id) . '" class="btn btn-xs btn-success">' . __('adminboard::lang.view') . '</a> ';
            }
            if(auth()->user()->can('adminevent_edit')) {
                $html .= '<a  href="' . url('adminboard/adminevent/' . $row->id . "/edit") . '" class="btn btn-xs btn-secondary">' . __('adminboard::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('adminevent_destroy')) {
                $html .= '<form action="' . url('adminboard/adminevent', $row->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-xs btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('adminboard::lang.delete') . '</button>
                            </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'adminboard/adminevent') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('adminevent_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminevent_create'));
        return EventForm::create()->renderForm();
//        $data = array();
//        $data['title']        = 'adminevent_create';
//        return view('adminboard::adminevent.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreEventCategoryService $eventCategoryService,
                          StoreEventTeamService $eventTeamService, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('adminevent_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->admineventRepository->createOrUpdate(array_merge($request->input(), [
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
            $eventCategoryService->execute($request, $record);
            $eventTeamService->execute($request, $record);
            event(new CreatedContentEvent(ADMINEVENT_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('adminevent.index'))
                ->setNextUrl(route('adminevent.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('adminevent.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminEvent  $adminEvent
     * @return \Illuminate\Http\Response
     */
    public function show(AdminEvent $adminEvent)
    {
        if (!auth()->user()->can('adminevent_show')) {
            abort(403, 'Unauthorized action.');
        }
//        dd($adminEvent->registrations);
        page_title()->setTitle(trans('adminboard::lang.adminevent_show'));
        $data = array();
        $data['adminevent']        = $adminEvent;
        $data['title']        = 'adminevent_show';
        return view('adminboard::adminevent.show',$data);
    }
    public function download($id)
    {
        $event = AdminEvent::with('registrations')->findOrFail($id);
        $registrations = $event->registrations;

        if ($registrations->isEmpty()) {
            return back()->with('error', 'No data found to download!');
        }

        $fields = json_decode($registrations->first()->customer_fields, true) ?? [];
        $fileName = $event->slug . '-customers.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($registrations, $fields, $event) {
            $file = fopen('php://output', 'w');

            // ✅ Add event name as CSV first row (Header Title)
            fputcsv($file, [$event->name]);
            fputcsv($file, []); // Empty row for spacing

            // ✅ Dynamic header row
            fputcsv($file, array_merge(['ID'], array_keys($fields), ['Registered At']));

            foreach ($registrations as $item) {
                $data = json_decode($item->customer_fields, true) ?? [];

                fputcsv($file, array_merge(
                    [$item->id],
                    array_map(fn($key) => $data[$key] ?? '', array_keys($fields)),
                    [$item->created_at]
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminEvent  $adminevent
     * @return \Illuminate\Http\Response
     */
    public function pdf(AdminEvent $adminevent)
    {
        if (!auth()->user()->can('adminevent_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminevent_show'));
        $data = array();
        $data['adminevent']        = $adminevent;
        $data['title']        = 'adminevent_show';
        return view('adminboard::adminevent.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Modules\AdminBoard\Http\Models\AdminEvent  $adminevent
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminEvent $adminevent)
    {
        if (!auth()->user()->can('adminevent_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('adminboard::lang.adminevent_edit'));
        $adminevent = $this->admineventRepository->findOrFail($adminevent->id);
        return EventForm::createFromModel($adminevent)->renderForm();
//        $data = array();
//        $data['title']        = 'adminevent_edit';
//        $data['record']        = $this->admineventRepository->findOrFail($adminevent->id);
//        return view('adminboard::adminevent.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\AdminBoard\Http\Models\AdminEvent  $adminevent
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        AdminEvent  $adminevent,
        StoreEventCategoryService $eventCategoryService,
        StoreEventTeamService $eventTeamService,
        DboardHttpResponse $response,
        StoreVideoStoriesService $storeVideoStoriesService
    )
    {
        if (!auth()->user()->can('adminevent_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);
//        dd($request);

        $id = $adminevent->id;
        $adminevent = $this->admineventRepository->firstOrNew(compact('id'));
        $adminevent->fill($request->input());
        $this->admineventRepository->createOrUpdate($adminevent);
        $storeVideoStoriesService->execute($request, $adminevent);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($adminevent->$file_name, $path);

            $adminevent->$file_name      = processUpload($request, $adminevent,$file_name,$path);
            $adminevent->save();
        }
//        $storeVideoStoriesService->execute($request, $adminevent);
        if ($request->has('related_products')) {
            $adminevent->products()->detach();

//            dd($adminevent);
            if ($relatedProducts = $request->input('related_products', '')) {
                $adminevent->products()->attach(array_filter(explode(',', $relatedProducts)));
            }
        }
        $eventCategoryService->execute($request, $adminevent);
        $eventTeamService->execute($request, $adminevent);
        event(new UpdatedContentEvent(ADMINEVENT_MODULE_SCREEN_NAME, $request, $adminevent));

        return $response
            ->setPreviousUrl(route('adminevent.index'))
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
        if (!auth()->user()->can('adminevent_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $adminevent = $this->admineventRepository->findOrFail($id);
            $this->admineventRepository->delete($adminevent);
            $path = $this->photo_path;
            deleteFile($adminevent->photo, $path);
            event(new DeletedContentEvent(ADMINEVENT_MODULE_SCREEN_NAME, $request, $adminevent));

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
        return $this->executeDeleteItems($request, $response, $this->admineventRepository, ADMINEVENT_MODULE_SCREEN_NAME);
    }
}
