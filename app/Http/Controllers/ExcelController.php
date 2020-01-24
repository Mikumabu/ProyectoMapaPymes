<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /* Método que exporta el Excel con todos los datos de la tabla "formularios_aprobados" */

    public function exportarAprobados()
    {
        return Excel::download(new ExcelExport, 'Aprobados.xlsx');
    }

}

