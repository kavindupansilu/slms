<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::query();

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('batch') && !empty($request->batch)) {
            $query->where('batch_no', $request->batch);
        }

        if ($request->has('degree') && !empty($request->degree)) {
            $query->where('degree_name', 'LIKE', '%' . $request->degree . '%');
        }

        $attendances = $query->get();
        
        return view('dashboard.attendance', compact('attendances'));
    }

    public function disattendance(Request $request)
    {
        $attendances = Attendance::all();
        $query = Attendance::query();

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('batch') && !empty($request->batch)) {
            $query->where('batch_no', $request->batch);
        }

        if ($request->has('degree') && !empty($request->degree)) {
            $query->where('degree_name', 'LIKE', '%' . $request->degree . '%');
        }

        $attendances = $query->get();
        return view('dashboard.disattendance', compact('attendances'));
    }

    public function statregis()
    {
        return view('auth/statregis');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'student_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'date' => 'required',
            'time' => 'required',
            'degree_name' => 'required',
            'batch_no' => 'required',
            'status' => 'required'
        ])->validate();

        $attendance = new Attendance([
            'student_id' => $request->student_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'date' => $request->date,
            'time' => $request->time,
            'degree_name' => $request->degree_name,
            'batch_no' => $request->batch_no,
            'status' => $request->status,
        ]);
        $attendance->save();
        return redirect()->route('statregis')->with('success', 'Attendance marked successfully.');
    }

    public function scanQRCode()
    {
        return view('dashboard.scan');
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
        ]);

        $student = Student::where('student_id', $request->student_id)->first();

        Attendance::create([
            'student_id' => $student->student_id,
            'fname' => $student->fname,
            'lname' => $student->lname,
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'degree_name' => $student->degree_name,
            'batch_no' => $student->batch_no,
            'status' => 'present',
        ]);

        return redirect()->route('attendances.index')->with('success', 'Attendance marked successfully.');
    }

    

    public function edit(Attendance $attendance)
        {
            return view('edits.aedit', compact('attendance'));
        }

    public function update(Request $request, $id)
        {
            $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'date' => 'required',
            'time' => 'required',
            'degree_name' => 'required',
            'batch_no' => 'required',
            'status' => 'required'
            ]);

            $attendance = Attendance::findOrFail($id);

            $attendance->fname = $request->input('fname');
            $attendance->lname = $request->input('lname');
            $attendance->date = $request->input('date'); 
            $attendance->time = $request->input('time');
            $attendance->degree_name = $request->input('degree_name');
            $attendance->batch_no = $request->input('batch_no');
            $attendance->status = $request->input('status');

            $attendance->save();

            return redirect()->route('attendance')->with('success', 'Student attendance information updated successfully.');
        }
}
