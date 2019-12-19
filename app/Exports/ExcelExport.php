<?php

namespace App\Exports;

use App\formularios_aprobados;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return formularios_aprobados::all();
    }

    public function headings(): array

    {

        return [
            'ID',
            ' ',
            ' ',
            'Nombre Empresa',
            'Rut Empresa',
            'Giro',
            'Latitud',
            'Longitud',
            'Ubicación',
            'Horario',
            'Facebook',
            'Instagram',
            'Otro sitio',
            '¿Formalizado?',
            'Comuna',
            'Contacto',
            'Teléfono',
            'Correo',
            'Descripción',

        ];

    }
}
