<?php

namespace Modules\Icon\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Modules\Icon\Http\Models\Icon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Icon\Repositories\Interfaces\IconInterface;
use Modules\Icon\Http\Imports\IconImport;
use Modules\Icon\Tables\IconTable;
use mysql_xdevapi\Exception;
use Throwable;

class IconController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var IconInterface
     */
    protected $iconRepository;

    /**
     * IconController constructor.
     * @param IconInterface $iconRepository
     */
    public function __construct(IconInterface $iconRepository)
    {
        $this->iconRepository = $iconRepository;
    }
    protected $photo_path = 'uploads/icon/';

    /**
     * @param IconTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(IconTable $dataTable)
    {
        if (!auth()->user()->can('icon_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('icon_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon_import'));
        $data = array();
        $data['title']        = 'icon_import';
        return view('icon::icon.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('icon_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new IconImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('icon::lang.record_save_successfully');
        return redirect()->route('icon.index')->with('response_data', $response_data);
    }
    public function data()
    {
        if (!auth()->user()->can('icon_access')) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->can('icon_list_all')) {
            $custom_table = Icon::all();
        }else {
            $custom_table = Icon::where('user_id', Auth::id())->get();
        }
        return datatables()->of($custom_table)->addColumn('action', function ($row) {
            $html = '';
            if(auth()->user()->can('icon_pdf')) {
                $html .= '<a target="_blank" href="' . route('icon.pdf_show', $row->id) . '" class="btn btn-xs btn-success">' . __('icon::lang.pdf') . '</a> ';
            }
            if(auth()->user()->can('icon_show')) {
                $html .= '<a href="' . route('icon.show', $row->id) . '" class="btn btn-xs btn-success">' . __('icon::lang.view') . '</a> ';
            }
            if(auth()->user()->can('icon_edit')) {
                $html .= '<a  href="' . route('icon.edit', $row->id) . '" class="btn btn-xs btn-secondary">' . __('icon::lang.edit') . '</a> ';
            }
            if(auth()->user()->can('icon_destroy')) {
                $html .= '<form action="' . route('icon.destroy', $row->id) . '" method="POST" style="display: inline-block;">
                        ' . csrf_field() . '
                        ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-xs btn-danger"
                            onclick="return confirm(\'Are You Sure Want to Delete?\')"
                            style="padding: .0em !important;"><i class="icon-trash"> </i>' . __('icon::lang.delete') . '</button>
                        </form>';
            }
            return $html;
        })->addColumn('photo', function ($row) {
            $html = '<img style="height: 100px;width: 100px;" src="' . getImageUrl($row->photo,'icon') . '" alt="' . $row->name . '" class="img-rounded img-preview">';
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
        if (!auth()->user()->can('icon_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon_create'));
        $data = array();
        $data['title']        = 'icon_create';
        return view('icon::icon.create',$data);
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
        if (!auth()->user()->can('icon_create')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        try {
            $record = $this->iconRepository->createOrUpdate(array_merge($request->input(), [
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
                deleteFile($record->photo, $path);

                $record->$file_name      = processUpload($request, $record,$file_name, $path);
                $record->save();
            }

            event(new CreatedContentEvent(ICON_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('icon.index'))
                ->setNextUrl(route('icon.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('icon.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Show the specified resource.
     * @param  Icon\Http\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function show(Icon $icon)
    {
        if (!auth()->user()->can('icon_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon_show'));
        $data = array();
        $data['icon']        = $icon;
        $data['title']        = 'icon_show';
        return view('icon::icon.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  Icon\Http\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function pdf(Icon $icon)
    {
        if (!auth()->user()->can('icon_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon_show'));
        $data = array();
        $data['icon']        = $icon;
        $data['title']        = 'icon_show';
        return view('icon::icon.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Icon\Http\Models\Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function edit(Icon $icon)
    {
        if (!auth()->user()->can('icon_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('icon::lang.icon_edit'));
        $data = array();
        $data['title']        = 'icon_edit';
        $data['record']        = $this->iconRepository->findOrFail($icon->id);
        return view('icon::icon.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Icon\Http\Models\Icon  $icon
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Icon  $icon, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('icon_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $icon->id;
        $icon = $this->iconRepository->firstOrNew(compact('id'));
        $icon->fill($request->input());
        $icon = $this->iconRepository->createOrUpdate($icon);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($icon->$file_name, $path);

            $icon->$file_name      = processUpload($request, $icon,$file_name,$path);
            $icon->save();
        }

        event(new UpdatedContentEvent(ICON_MODULE_SCREEN_NAME, $request, $icon));
        return $response
            ->setPreviousUrl(route('icon.index'))
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
        if (!auth()->user()->can('icon_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $icon = $this->iconRepository->findOrFail($id);
            $this->iconRepository->delete($icon);

            event(new DeletedContentEvent(ICON_MODULE_SCREEN_NAME, $request, $icon));

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
        return $this->executeDeleteItems($request, $response, $this->iconRepository, ICON_MODULE_SCREEN_NAME);
    }
}
