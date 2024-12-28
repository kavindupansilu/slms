<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Degree;

class DegreeController extends Controller
{
    public function index()
        {
            $degrees = Degree::all(); // Fetch all records from the degree table
            return view('dashboard.degree', compact('degrees')); // Pass the data to the view
        }


    public function degregister()
        {
            return view('auth/degregister');
        }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
            'duration' => 'required',
        ])->validate();

        $degree = new Degree([
            'name' => $request->name,
            'title' => $request->title,
            'duration' => $request->duration,
        ]);
        $degree->save();

        return redirect()->route('degree'); // Redirect to the dashboard
    }

    public function getDegrees()
    {
        $degrees = Degree::all();
        return response()->json($degrees);
    }


        public function edit(Degree $degree)
    {
        return view('edits.dedit', compact('degree'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'duration' => 'required',
        ]);

        $degree = Degree::findOrFail($id);

        $degree->name = $request->input('name');
        $degree->title = $request->input('title');
        $degree->duration = $request->input('duration');

        $degree->save();

        return redirect()->route('degree');
    }

    public function destroy($id)
    {
        $degree = Degree::findOrFail($id);
        $degree->delete();
        return redirect()->route('degree');
    }
}

    