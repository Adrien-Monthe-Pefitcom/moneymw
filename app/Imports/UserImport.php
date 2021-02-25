<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'identifiant_unique' => $row['identifiant_unique'],
            'ville' => $row['ville'],
            'num_piece' => $row['num_piece'],
            'pays' => $row['pays'],
            'profession' => $row['profession'],
            'date_naissance' => $row['date_naissance'],
            'phone' => '+237'.$row['phone'],
            'photo' => $row['photo'],
            'role' => 'user',
            'scan_piece_recto' => $row['scan_piece_recto'],
            'scan_piece_verso' => $row['scan_piece_verso'],
            'type_compte'=> 'Compte Personnel',
            'password' => \Hash::make($row['phone']),
            'no_compte_carte_virtuelle' => $this->generateBarcodeNumber(),

        ]);
    }

    function generateBarcodeNumber() {
        $number = mt_rand(10000000000, 99999999999); // better than rand()

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists($number) {

        $referee = DB::table('users')->where('no_compte_carte_virtuelle', $number)->first();
        if($referee == null)
            return true;
        else
            return false;
    }
}