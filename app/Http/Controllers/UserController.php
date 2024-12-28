<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
    public function userprofile()
    {
        return view('userprofile');
    }
 
    public function about()
    {
        return view('about');
    }

    public function edit(User $user)
    {
        return view('edits.uedit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('dashboard.user')->with('success', 'User information updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard.user')->with('success', 'User deleted successfully');
    }

    public function index()
    {
        $users = User::all();
        return view('dashboard.user', compact('users'));


    }
}
