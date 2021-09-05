<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'tanggal_lahir'  => 'required',
            'no_telp'  => 'required',
        ]);

        // dd($request->all());
        
        // Save data masukkan ke database
        $student = new Student();
        $student->nama = $request->nama;
        $student->tanggal_lahir = $request->tanggal_lahir;
        $student->no_telp = $request->no_telp;
        $student->save();

        return response()->json([
            'message'   => 'Data berhasil tersimpan',
            'data' => $student,
        ], 200);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        // dd($student);
        return response()->json([
            'message'   => 'success',
            'data_student' => $student,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $request->validate([
            'nama'  => 'required',
            'tanggal_lahir'  => 'required',
            'no_telp'  => 'required',
        ]);

        $student->update([
            'nama'  => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'no_telp'  => $request->no_telp,
        ]);

        return response()->json([
            'message'   => 'Data berhasil diupdate!',
            'data_student' => $student,
        ], 200);
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();
        
        return response()->json([
            'message'   => 'Data berhasil dihapus!'
        ], 200);
    }

    public function allStudent()
    {
        $student = Student::all();
        $response["students"] = $student;
        $response["message"] = "1";
        return response()->json($response);
    }
}
