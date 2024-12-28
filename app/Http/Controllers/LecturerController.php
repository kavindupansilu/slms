<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Lecturedetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LecturerController extends Controller
{
    public function index()
        {
            $users = Lecturer::all();
            return view('dashboard.lecturer', compact('users'));
        }

    public function dislecturer()
        {
            $users = Lecturer::all();
            return view('dashboard.dislecturer', compact('users'));
        }

    public function registerSave(Request $request)
        {
            Validator::make($request->all(), [
                'lecturer_name' => 'required',
                'degree' => 'required',
                'course_name' => 'required',
                'batch' => 'required',
            ])->validate();

            $lecturedetail = new Lecturedetail([
                'lecturer_name' => $request->lecturer_name,
                'degree' => $request->degree,
                'course_name' => $request->course_name,
                'batch' => $request->batch,
            ]);
            $lecturedetail->save();

            return view('auth/lecturedetailregis');
        }

    public function edit(Lecturedetail $lecturedetail)
        {
            return view('edits.ldedit', compact('lecturedetail'));
        }

    public function update(Request $request, $id)
        {
            $request->validate([
                'lecturer_name' => 'required',
                'degree' => 'required',
                'course_name' => 'required',
                'batch' => 'required',
                
            ]);

            $lecturedetail = Lecturedetail::findOrFail($id);

            $lecturedetail->lecturer_name = $request->input('lecturer_name');
            $lecturedetail->degree = $request->input('degree');
            $lecturedetail->course_name = $request->input('course_name');
            $lecturedetail->batch = $request->input('batch');

            $lecturedetail->save();

            return redirect()->route('lecturedetail');
        }

    public function destroy($id)
        {
            $lecturedetail = Lecturedetail::findOrFail($id);
            $lecturedetail->delete();
            return redirect()->route('lecturedetail');
        }


}
