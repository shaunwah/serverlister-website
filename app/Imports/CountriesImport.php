<?php

namespace App\Imports;

use App\Country;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class CountriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Country([
            'user_id' => 1,
            'code' => $row[2],
            'name' => $row[3],
            'slug' => Str::slug($row[3]),
        ]);
    }
}
