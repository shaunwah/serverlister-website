<?php

namespace App\Imports;

use App\ServerType;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class ServerTypesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ServerType([
            'user_id' => 1,
            'code' => $row[0],
            'name' => $row[1],
            'slug' => Str::slug($row[1]),
        ]);
    }
}
