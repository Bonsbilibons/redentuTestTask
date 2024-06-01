<?php

namespace App\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

class XLSXUploadRequest extends FormRequest
{
    protected $maxFileSize = 2048;
    protected $mimes = 'xlsx';
    public function rules()
    {
        $maxFileSize = $this->maxFileSize;
        $mimes = $this->mimes;
        return [
            'xlsx' => "required|file|mimes:$mimes|max:$maxFileSize",
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getTableDataAsArray(): array
    {
        $file = $this->file('xlsx');

        try {
            $spreadsheet = IOFactory::load($file->getPathname());
        } catch (ReaderException $e) {
            throw new Exception('Unable to read the XLSX file.');
        }

        $sheet = $spreadsheet->getActiveSheet();

        return $sheet->toArray();
    }
}
