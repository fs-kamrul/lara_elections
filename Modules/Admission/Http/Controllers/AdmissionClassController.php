<?php

namespace Modules\Admission\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Admission\Tables\AdmissionClassTable;
use Modules\KamrulDashboard\Traits\HasDeleteManyItemsTrait;
use Illuminate\Routing\Controller;
use Modules\Option\Repositories\Interfaces\OptionClassInterface;
use Modules\Option\Tables\OptionClassTable;
use Exception;
use Throwable;

class AdmissionClassController extends Controller
{
    use HasDeleteManyItemsTrait;
    /**
     * @var OptionClassInterface
     */
    protected $optionclassRepository;

    /**
     * OptionClassController constructor.
     * @param OptionClassInterface $optionclassRepository
     */
    public function __construct(OptionClassInterface $optionclassRepository)
    {
        $this->optionclassRepository = $optionclassRepository;
    }

    /**
     * @param OptionClassTable $dataTable
     * @return JsonResponse|View
     *
     * @throws Throwable
     */
    public function index(AdmissionClassTable $dataTable)
    {
        if (!auth()->user()->can('optionclass_access')) {
            abort(403, 'Unauthorized action.');
        }
        page_title()->setTitle(trans('option::lang.optionclass'));

        return $dataTable->renderTable();
    }

}
