<?php

namespace App\Imports;

use App\Version;
use Maatwebsite\Excel\Concerns\ToModel;

class VersionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Version([
            'user_id' => 1,
            'code' => $row[0],
            'name' => $row[1],
            'slug' => $row[2],
        ]);
    }
}
