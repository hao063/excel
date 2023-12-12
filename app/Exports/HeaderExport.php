<?php

namespace App\Exports;

use App\BaseConfig\HeaderItem;
use App\BaseConfig\HorizontalHeader;

class HeaderExport extends HorizontalHeader
{

    private string $title;

    public function __construct(HeaderItem $headerItem)
    {
        parent::__construct($headerItem);
    }

    public function setHeaders(): void
    {
        $row1 = $this->headerItem->setRow(1);
        $row1->setCol(1)->setColor('#ff0303')->setTitle('red');
        $row1->setCol(2)->setColor('#000000')->setTitle('back');
        $row1->setCol(1)->setColor('#ff00a2')->setTitle('pink');
        $this->headerItem->setRow(2);
        $this->headerItem->setCol(1)->setTitle('red2');
        $this->headerItem->setRow(3);
    }


    public function codeHeader(): array
    {
        return [
            'code_red',
            'code_back',
            'pink',
        ];
    }

    public function titleSheet(): string
    {
        return $this->title ?? 'Sheet1';
    }

    public function setTitleSheet(string $title): static
    {
        $this->title = $title;
        return $this;
    }

}
