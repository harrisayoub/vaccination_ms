<?php

namespace App\Exports;

use App\Finance;
use Maatwebsite\Excel\Concerns\FromCollection;

class FinanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Finance::all();
    }
}
