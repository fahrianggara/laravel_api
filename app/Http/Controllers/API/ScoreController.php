<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());

        $student = new Student;

        $student->nama = $request->nama;
        $student->tanggal_lahir = $request->tanggal_lahir;
        $student->no_telp = $request->no_telp;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $student->id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai'],
            );
            $score = Score::create($score);
        }

        return response()->json([
            'message'   => 'success'
        ], 200);
    }

    public function allStudent()
    {
        $student = Student::all();

        return response()->json([
            'message'   => 'success',
            'students'   => $student,
        ], 200);
    }

    public function studentDetail($id)
    {
        $student = Student::with('scores')
            ->where('id', $id)->first();

        return response()->json([
            'message'   => 'success',
            'data'      => $student,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $student->update([
            'nama'           => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'no_telp'        => $request->no_telp,
        ]);

        Score::where('student_id', $id)->delete();

        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai'],
            );
            $score = Score::create($score);
        }

        return response()->json([
            'message'   => 'success'
        ], 200);
    }
}
