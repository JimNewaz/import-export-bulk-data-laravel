<?php

namespace App\Http\Controllers;

use App\Models\YourModelName;
use Illuminate\Http\Request;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $row) {
            YourModelName::create([
                'name' => $row[0],
                'email' => $row[1],
            ]);
        }

        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }
}
