<?php

namespace App\BaseConfig;

class HeaderItem
{

    private int $row;
    private int $col;
    private string $title;
    private string $colindex;
    private int $numberColMax;
    private array $headers;

    const ROW = 1;

    const COL = 2;

    const COLOR = 3;

    const TITLE = 4;


    private string $color;

    public function setRow(int $row): static
    {
        $this->row = $row;
        $this->updateItem(self::ROW);
        return $this;
    }


    public function setCol(int $col): static
    {
        $this->col = $col;
        $this->updateItem(self::COL);
        return $this;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;
        $this->updateItem(self::COLOR);
        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        $this->updateItem(self::TITLE);
        return $this;
    }

    private function updateItem(int $type): void
    {
        if ($type == self::ROW) {
            $this->headers[] = [
                'row' => $this->row,
            ];
        }
        if ($type == self::COL) {
            $this->colindex = fake()->uuid();

            $this->headers[$this->row - 1]['data'][$this->colindex]['col']   = $this->col;
            $this->headers[$this->row - 1]['data'][$this->colindex]['title'] = '';
        }
        if ($type == self::COLOR) {
            $this->headers[$this->row - 1]['data'][$this->colindex]['color'] = $this->color;
        }
        if ($type == self::TITLE) {
            $this->headers[$this->row - 1]['data'][$this->colindex]['title'] = $this->title;
        }
    }

    public function getHeader(): array
    {
        return $this->headersValue($this->headers);
    }

    private function headersValue(array $headers): array
    {
        $data = [];
        foreach ($headers as $header) {
            if (!isset($header['data'])) {
                continue;
            }
            $this->setNumberColMax($header['data']);
            $header['data'] = array_values($header['data']);
            $data[]         = $header;
        }
        return $data;
    }

    private function setNumberColMax(array $data): void
    {
        $max      = $this->numberColMax ?? 0;
        $valueCol = 0;
        foreach ($data as $item) {
            $valueCol += $item['col'];
        }
        $this->numberColMax = max($valueCol, $max);
    }

    public function getNumberColMax(): int
    {
        return $this->numberColMax ?? 0;
    }

    public function clear(): void
    {
        $this->headers = [];
    }
}