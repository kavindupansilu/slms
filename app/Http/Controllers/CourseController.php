<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Degree;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Course;

class CourseController extends Controller
{
        public function index()
        {
            $courses = Course::all();
            return view('dashboard.course', compact('courses')); 
        }

        public function indexes($degree_id)
        {
        $courses = Course::where('degree_id', $degree_id)->get();
        return view('dashboard.course', compact('courses', 'degree_id'));
        }

        public function coursereg()
        {
            return view('auth/coursereg');
        }

        public function registerSave(Request $request)
        {
        Validator::make($request->all(), [
            'cname' => 'required',
            'credit' => 'required',
            'year' => 'required',
            'semster' => 'required',
            'degree_id' => 'required',
            'user_id' => 'required',
        ])->validate();

            // Fetch the degree name based on the selected degree_id
        $degree_name = Degree::findOrFail($request->degree_id)->name;

            // Fetch the user name based on the selected degree_id
        $fname = User::findOrFail($request->user_id)->fname;
        $lname = User::findOrFail($request->user_id)->lname;

        $course = new Course([
            'cname' => $request->cname,
            'credit' => $request->credit,
            'year' => $request->year,
            'semster' => $request->semster,
            'degree_id' => $request->degree_id,
            'degree_name' => $degree_name, // Assign the degree name here
            'fname' => $fname,
            'lname' => $lname,
            'user_id' => $request->user_id,

        ]);
        $course->save();

        return redirect()->route('degree')->with('success', 'Course information added successfully.'); // Redirect to the dashboard
        }
    
        public function edit(Course $course)
        {
        return view('edits.cedit', compact('course'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'cname' => 'required',
                'credit' => 'required',
                'year' => 'required',
                'semster' => 'required',
                'degree_id' => 'required',
                'user_id' => 'required',
            ]);

            // Fetch the degree name based on the selected degree_id
            $degree_name = Degree::findOrFail($request->degree_id)->name;
            
            // Fetch the user names based on the selected user_id
            $fname = User::findOrFail($request->user_id)->fname;
            $lname = User::findOrFail($request->user_id)->lname;

            $course = Course::findOrFail($id);

            $course->cname = $request->input('cname');
            $course->credit = $request->input('credit');
            $course->year = $request->input('year');
            $course->semster = $request->input('semster');
            $course->degree_id = $request->input('degree_id');        
            $course->degree_name = $degree_name; 
            $course->fname = $fname; 
            $course->lname = $lname; 
            $course->user_id = $request->input('user_id');

            $course->save();

            return redirect()->route('degree')->with('success', 'Course information updated successfully.'); 
        }



        public function destroy($id)
        {
            $course = Course::findOrFail($id);
            $course->delete();
            return redirect()->route('course');
        }

        
   
}

    