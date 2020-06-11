<?php

namespace App\Exports;

use App\Models\Pombo as ModelsPombo;
use App\Pombo;
use Maatwebsite\Excel\Concerns\FromCollection;

class PombosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsPombo::all();
    }
}
