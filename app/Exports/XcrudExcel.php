<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class XcrudExcel implements FromArray, WithHeadings
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            'Slak Username',
            'Link',
            'Point',
            'Day',
            'Date',
            'InvitedTOStage3Channel',
        ];
    }
}
