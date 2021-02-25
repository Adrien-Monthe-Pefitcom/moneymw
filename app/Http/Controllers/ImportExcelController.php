<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;
use DB;
use Excel;

class ImportExcelController extends Controller
{
    function index()
    {
        $data = DB::table('users')->orderBy('id', 'DESC')->get();
        return view('admin.upload-clients', compact('data'));
    }

    function import(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        $data = Excel::import(new UserImport(), $path);

        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
