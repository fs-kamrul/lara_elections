<?php

namespace Modules\Admission\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admission\Http\Requests\StoreAdmissionRequest;
use Modules\Admission\Rules\ImageDimensions;
use Modules\KamrulDashboard\Events\DeletedContentEvent;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;
use Modules\KamrulDashboard\Events\CreatedContentEvent;
use Modules\KamrulDashboard\Http\Responses\DboardHttpResponse;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Modules\Admission\Http\Models\Admission;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admission\Repositories\Interfaces\AdmissionInterface;
use Modules\Admission\Http\Imports\AdmissionImport;
use Modules\Admission\Tables\AdmissionTable;
use Exception;
use Mpdf\Mpdf;
use Throwable;

class AdmissionController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var AdmissionInterface
     */
    protected $admissionRepository;

    /**
     * AdmissionController constructor.
     * @param AdmissionInterface $admissionRepository
     */
    public function __construct(AdmissionInterface $admissionRepository)
    {
        $this->admissionRepository = $admissionRepository;
    }
    protected $photo_path = 'uploads/admission/';

    /**
     * @param AdmissionTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdmissionTable $dataTable)
    {
        if (!auth()->user()->can('admission_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission'));

        return $dataTable->renderTable();
    }

    public function import()
    {
        if (!auth()->user()->can('admission_import')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_import'));
        $data = array();
        $data['title']        = 'admission_import';
        return view('admission::admission.create_import',$data);
    }
    public function store_import(Request $request)
    {
        if (!auth()->user()->can('admission_import')) {
            abort(403, 'Unauthorized action.');
        }
        $file = $request->file('photo');
        Excel::import(new AdmissionImport, $file);
        $response_data['status'] = 1;
        $response_data['message'] =  __('admission::lang.record_save_successfully');
        return redirect()->route('admission.index')->with('response_data', $response_data);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!auth()->user()->can('admission_create')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_create'));
        $data = array();
        $data['title']        = 'admission_create';
        return view('admission::admission.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmissionRequest $request, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('admission_create')) {
            abort(403, 'Unauthorized action.');
        }
//        $validated = $request->validate([
//            'name'              => 'bail|required|max:255',
//        ]);

        try {
            $record = $this->admissionRepository->createOrUpdate(array_merge($request->input(), [
//                'user_id' => Auth::id(),
                'uuid'    => gen_uuid(),
                'slug'    => checkSlugFunction($request->input('name')),
            ]));

            $file_name = 'photo';
            if ($request->hasFile($file_name))
            {
//                return $file_name;
                $request->validate([
                    "$file_name" => 'required|image|mimes:jpeg,jpg,png|max:151'
                ]);
                $path = $this->photo_path;
                deleteFile($record->photo, $path);
                // Open the image file
                $uploadedImage = $request->file($file_name);

                $img = \Intervention\Image\Facades\Image::make($uploadedImage);

                // Get image width and height
                $width = $img->width();
                $height = $img->height();

                // Check width and height
                if ($width > 301 || $height > 301) {
//                    return redirect()->back()->withErrors(['message' => 'Image dimensions are too large.']);
                    return $response
                        ->setPreviousUrl(route('admission.index'))
                        ->setMessage(trans('Image dimensions are too large.'));
                }

                $record->$file_name      = processUpload($request, $record,$file_name, $path);
                $record->save();
            }

            event(new CreatedContentEvent(ADMISSION_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(route('admission.index'))
                ->setNextUrl(route('admission.edit', $record->id))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (\Exception $e){

            return $response
                ->setPreviousUrl(route('admission.index'))
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DboardHttpResponse $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function admission_store(StoreAdmissionRequest $request, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('admission_create')) {
            abort(403, 'Unauthorized action.');
        }
//        $validated = $request->validate([
//            'name'              => 'bail|required|max:255',
//        ]);

        try {
            $record = $this->admissionRepository->createOrUpdate(array_merge($request->input(), [
//                'user_id' => Auth::id(),
                'uuid'    => gen_uuid(),
                'slug'    => checkSlugFunction($request->input('name')),
            ]));

            $file_name = 'photo';
            if ($request->hasFile($file_name))
            {
//                return $file_name;
//                $validator = $request->validate([
////                    "$file_name" => 'required|image|mimes:jpeg,jpg,png|max:150'
//                    "photo" => [
//                        'required',
//                        'image',
//                        'mimes:jpeg,png,jpg,gif',
//                        'max:15',
//                        new ImageDimensions(300, 300), // Adjust the dimensions as needed
//                    ],
//                ]);
//                dd($validator);
                $path = $this->photo_path;
                deleteFile($record->photo, $path);

                $record->$file_name      = documentProcessUpload($request, $record,$file_name, $path);
                $record->save();
            }

            event(new CreatedContentEvent(ADMISSION_MODULE_SCREEN_NAME, $request, $record));

            return $response
                ->setPreviousUrl(URL::previous())
                ->setNextUrl(route('public.admission_show', $record->uuid))
                ->setMessage(trans('kamruldashboard::notices.create_success_message'));
        }catch (Exception $e){
            return $response
                ->setPreviousUrl(URL::previous())
                ->setMessage(trans('kamruldashboard::notices.something_error_please_try_again_later'));
        }
    }
    public function admission_show($id)
    {
        if (!auth()->user()->can('admission_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_show'));
        $admission = Admission::where('uuid', $id)->first();
//        dd($admission);
        $data = array();
        $data['admission']        = $id;
        $data['record']        = $this->admissionRepository->findOrFail($admission->id);
        $data['title']        = 'admission_show';
// Specify the path to the Bangla font file
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $fontPath = public_path('vendor/Modules/KamrulDashboard/fonts');
        $mpdf = new Mpdf([
            'format'        => 'A4',
            'orientation'   => 'p',
            'fontDir'       => array_merge($fontDirs, [$fontPath]),
//            'autoScriptToLang' => true,
//            'autoVietnamese' => true,
//            'autoArabic' => true,
//            'autoLangToFont' => true,
            'fontdata' => $fontData + [
                "solaimanlipi" => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                ],
                'rupali' => [
                    'R' => "Rupali.ttf",
                    'useOTL' => 0xFF,
                ],
                'nikosh' => [
                    'R' => 'Nikosh.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'nikosh'
        ]);
        $mpdf->AddPageByArray([
            'margin-left' => 5,
            'margin-right' => 5,
            'margin-top' => 5,
            'margin-bottom' => 10,
        ]);
//        $mpdf->SetMargins(1, 1, 3);
        $mpdf->SetFont('rupali');
        $html = view('admission::admission.admission_pdf', $data)->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output("$admission->name" . ".pdf", 'I');
    }
    /**
     * Show the specified resource.
     * @param  Admission\Http\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        if (!auth()->user()->can('admission_show')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_show'));
        $data = array();
        $data['admission']        = $admission;
        $data['title']        = 'admission_show';
        return view('admission::admission.show',$data);
    }
    /**
     * Show the specified resource.
     * @param  Admission\Http\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function pdf(Admission $admission)
    {
        if (!auth()->user()->can('admission_pdf')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_show'));
        $data = array();
        $data['admission']        = $admission;
        $data['title']        = 'admission_show';
        return view('admission::admission.pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Admission\Http\Models\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {
        if (!auth()->user()->can('admission_edit')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('admission::lang.admission_edit'));
        $data = array();
        $data['title']        = 'admission_edit';
        $data['record']        = $this->admissionRepository->findOrFail($admission->id);
        return view('admission::admission.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Admission\Http\Models\Admission  $admission
     * @param  DboardHttpResponse  $response
     * @return DboardHttpResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission  $admission, DboardHttpResponse $response)
    {
        if (!auth()->user()->can('admission_edit')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'              => 'bail|required|max:255',
        ]);

        $id = $admission->id;
        $admission = $this->admissionRepository->firstOrNew(compact('id'));
        $admission->fill($request->input());
        $admission = $this->admissionRepository->createOrUpdate($admission);

        $file_name = 'photo';
        if ($request->hasFile($file_name))
        {
//            return $file_name;
            $rules = $request->validate([
                "$file_name" => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
            $path = $this->photo_path;
            deleteFile($admission->$file_name, $path);

            $admission->$file_name      = processUpload($request, $admission,$file_name,$path);
            $admission->save();
        }

        event(new UpdatedContentEvent(ADMISSION_MODULE_SCREEN_NAME, $request, $admission));
        return $response
            ->setPreviousUrl(route('admission.index'))
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
        if (!auth()->user()->can('admission_destroy')) {
            abort(403, 'Unauthorized action.');
        }
        try{

            $admission = $this->admissionRepository->findOrFail($id);
            $this->admissionRepository->delete($admission);

            event(new DeletedContentEvent(ADMISSION_MODULE_SCREEN_NAME, $request, $admission));

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
        return $this->executeDeleteItems($request, $response, $this->admissionRepository, ADMISSION_MODULE_SCREEN_NAME);
    }
}
