<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\QRMail;
use App\Models\Degree;
use App\Models\User;
use App\Models\Attendance;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
        {
            $students = Student::all(); // Fetch all records from the students table
            return view('dashboard.student', compact('students')); // Pass the data to the view
            
        }

    public function disstudent()
        {
            $students = Student::all();
            return view('dashboard.disstudent', compact('students'));
        }

    public function sregister()
        {
            return view('auth/sregister');
        }

    public function registerSave(Request $request)
        {

        Validator::make($request->all(), [
            'nic' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required|date|before_or_equal:' . now()->subYears(15)->format('Y-m-d'),
            'gender' => 'required',
            'email' => 'required|email',
            'phone_no' => 'required',
            'address' => 'required',
            'degree_id' => 'required',
            'batch_no' => 'required'
        ])->validate();
    
        // Fetch the degree name based on the selected degree_id
        $degree_name = Degree::findOrFail($request->degree_id)->name;

        $student = new Student([
            'nic' => $request->nic,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'degree_id' => $request->degree_id,
            'degree_name' => $degree_name, // Assign the degree name here
            'batch_no' => $request->batch_no,
        ]);
        $student->save();
        
            // Send email with the student details
            Mail::to($student->email)->send(new QRMail($student->fname, $student->lname, $student->student_id, $student->degree_name));
        
            return redirect()->route('student'); // Redirect to the dashboard
        }
    

    public function sendQr() // Send QR 
        {
            // Fetch all student details from the database
            $students = Student::all();

            // Pass the students variable to the view
            return view('qr', ['students' => $students]);
        }

    public function edit(Student $student)
        {
            return view('edits.sedit', compact('student'));
        }

    public function update(Request $request, $id)
        {
            $request->validate([
                'nic' => 'required',
                'fname' => 'required',
                'lname' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'email' => 'required|email',
                'phone_no' => 'required',
                'address' => 'required',
                'degree_id' => 'required',
                'degree_name' => 'required',
                'batch_no' => 'required',
            ]);

            $student = Student::findOrFail($id);

            $student->nic = $request->input('nic');
            $student->fname = $request->input('fname');
            $student->lname = $request->input('lname');
            $student->dob = $request->input('dob'); 
            $student->gender = $request->input('gender');
            $student->email = $request->input('email');
            $student->phone_no = $request->input('phone_no');
            $student->address = $request->input('address');
            $student->degree_id = $request->input('degree_id');
            $student->degree_name = $request->input('degree_name');
            $student->batch_no = $request->input('batch_no');

            $student->save();

                    return redirect()->route('student')->with('success', 'Student information updated successfully.');
        }

    public function destroy($id)
        {
            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->route('student')->with('success', 'Student deleted successfully');
        }

        // QR Generate

    public function showQRCodes()
        {
            $students = Student::all();
            return view('students.qrcodes', compact('students'));
        }


    public function generateQRCode($student_id)
        {
            $qrCode = new QrCode($student_id);
            $qrCode->setSize(200);

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            return response($result->getString(), 200)->header('Content-Type', 'image/png');
        }

}


