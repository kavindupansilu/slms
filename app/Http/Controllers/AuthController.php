<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'nic' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required'
        ])->validate();

        $user = new User([
            'title' => $request->title,
            'nic' => $request->nic,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);
        $user->save();

        // Send email with the user details
        Mail::to($user->email)->send(new HelloMail($user->fname, $user->user_id, $user->getPlainPassword()));

        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('user_id', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'user_id' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        if (auth()->user()->role == 'Admin') {
            return redirect()->route('user');
        } else if (auth()->user()->role == 'Lecturer' && (auth()->user()->id) ){
            return redirect()->route('dislecturer');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function getUsers()
    {
        // Filter only role = Lecturer
        $users = User::where('role', 'Lecturer')->get();
        return response()->json($users);
    }


    public function edit(User $user)
    {
        return view('edits.uedit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'nic' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);

        $user->title = $request->input('title');
        $user->nic = $request->input('nic');
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->role = $request->input('role');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('user')->with('success', 'User information updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }

    public function index()
{
    $users = User::all();
    return view('dashboard.user', compact('users'));
}

}