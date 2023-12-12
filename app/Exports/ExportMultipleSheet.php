<?php

namespace App\Exports;

use App\BaseConfig\HeaderItem;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportMultipleSheet implements WithMultipleSheets
{
    public function __construct(public readonly HeaderItem $headerItem)
    {
    }

    public function sheets(): array
    {
        $className = ['Name1', 'Name2'];
        $sheets = [];
        foreach ($className as $name) {
            $sheets[] = (new HeaderExport($this->headerItem))->setTitleSheet($name);
        }

        return $sheets;
    }

}