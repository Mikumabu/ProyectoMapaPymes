<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportarAprobados()
    {
        return Excel::download(new ExcelExport, 'formularios_aprobados.xlsx');
    }

}

