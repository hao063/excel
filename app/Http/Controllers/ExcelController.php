<?php

namespace App\Http\Controllers;

use App\Exports\ExportMultipleSheet;
use App\Exports\HeaderExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use phpseclib3\Net\SSH2;

class ExcelController extends Controller
{

    public function __construct(
        private readonly HeaderExport $export,
        public readonly ExportMultipleSheet $exportMultipleSheet
    ) {
    }

    public function header()
    {
        $filename = 'address_config_'.Carbon::now()->timestamp.'.xlsx';
        return Excel::download($this->export, $filename);
    }

    public function header2()
    {
        $filename = 'address_config_'.Carbon::now()->timestamp.'.xlsx';
        return Excel::download($this->exportMultipleSheet, $filename);
    }

    public function exportAndZip()
    {
        $filename = 'address_config_'.Carbon::now()->timestamp.'.xlsx';
        $filename2 = 'address_config_2'.Carbon::now()->timestamp.'.xlsx';
        $excelFiles = [
            'file1.xlsx' => Excel::download($this->exportMultipleSheet, $filename)->getFile(),
            'file2.xlsx' => Excel::download($this->export, $filename2)->getFile(),
        ];

        // Create a temporary directory to store Excel files
        $tempDir = 'temp_' . uniqid();
        Storage::makeDirectory($tempDir);

//        // Move Excel files to the temporary directory
        foreach ($excelFiles as $fileName => $filePath) {
            Storage::move($filePath, $tempDir . '/' . $fileName);
        }
//
//        // Create a zip file
        $zipFile = public_path('exports/exported_files.zip');
        $zip = new SSH2($zipFile);
        if ($zip->create()) {
            foreach ($excelFiles as $fileName => $filePath) {
                $zip->addFile($tempDir . '/' . $fileName, $fileName);
            }

            $zip->close();
        }
//
//        // Delete the temporary directory
//        Storage::deleteDirectory($tempDir);

        // Download the zip file
//        return response()->download($zipFile)->deleteFileAfterSend(true);
    }

}