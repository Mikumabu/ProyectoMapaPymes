<?php

namespace App\Exports;

use App\formularios_aprobados;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return formularios_aprobados::all();
    }
}
