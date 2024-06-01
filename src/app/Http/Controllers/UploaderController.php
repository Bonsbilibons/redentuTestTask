<?php

namespace App\Http\Controllers;

use App\Requests\XLSXUploadRequest;

use App\Services\UploaderService;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UploaderController
{

    /**
     * @var UploaderService
     */
    protected $uploaderService;

    /**
     * @param UploaderService $uploaderService
     */
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function mainXLSXView(Request $request)
    {
        return view('uploader/xlsx_upload_page');
    }

    /**
     * @param XLSXUploadRequest $request
     * @return array
     * @throws Exception
     */
    public function xlsxUpload(XLSXUploadRequest $request): array
    {
        $startTime = microtime(true);
        $result = $this->uploaderService->processXLSXArrayV2($request->getTableDataAsArray());
        $timePassed = (microtime(true) - $startTime);

        return [
            'status' => 'success',
            'result' => $result,
            'time_passed' => $timePassed
        ];
    }
}
