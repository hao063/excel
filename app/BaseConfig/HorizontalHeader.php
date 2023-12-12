<?php

namespace App\BaseConfig;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

abstract class HorizontalHeader implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting, WithTitle
{

    public function __construct(public readonly HeaderItem $headerItem)
    {
    }

    public function view(): View
    {
        $this->setHeaders();
        $headers      = $this->headerItem->getHeader();
        $numberColMax = $this->headerItem->getNumberColMax();
        $codesHeader  = $this->codeHeader();
        $this->headerItem->clear();
        return view('address_config_export', compact('headers', 'numberColMax', 'codesHeader'));
    }


    abstract public function setHeaders(): void;

    abstract public function codeHeader(): array;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->calculateWorksheetDataDimension();
                //                $event->sheet->getDelegate()
                //                    ->getStyle('B6')
                //                    ->getNumberFormat()
                //                    ->setFormatCode('#,##0_-"€"');
                //                $event->sheet->getDelegate()
                //                    ->getStyle('A6')
                //                    ->getAlignment()
                //                    ->setWrapText(true);

                $event->sheet->getDelegate()->getStyle('A6')
                    ->getFont()->setBold(true)->setItalic(true);

                // Format cell B2 with red font color

                // Format cell C3 with 14-point font size
                //                $event->sheet->getDelegate()->getStyle('B6')->getFont()->setSize(14);

                // Format cell D4 with centered text alignment

                //                $event->sheet->autoSize();


            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => 'Currency',   // Format for column C as currency
        ];
    }

    abstract public function titleSheet();

    public function title(): string
    {
        return $this->titleSheet();
    }

}