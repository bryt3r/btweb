<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(['id', 'email', 'username', 'role',])->paginate(15);
        return view('users.users')->with('users', $users);
    }


    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('users.user')->with('user', $user);
    }


    public function profile(Request $request, $username)
    {
        if (Auth::user()->is_banned) {
            Auth::logout();
 
            $request->session()->invalidate();
         
            $request->session()->regenerateToken();
         
            return redirect('/');
        }
        return $this->show($username);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $request->validate(
            [
                'firstname' => ['required', 'string', 'max:20'],
                'lastname' => ['required', 'string', 'max:20'],
                'username' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
                'phone' => ['required', 'numeric', 'digits_between:11,16'],
                'email' => ['required', Rule::unique('users')->ignore($user->id)],
                'address' => ['required', 'string', 'max:255'],
            ]
        );

        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->username = $request->username;
        // $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('admin.users', ['id' => $user->id])->with('success', 'USER UPDATE SUCCESSFUL');
    }


    public function change_role(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('adminUpdate', $user);
        $request->validate(
            [
                'role' => ['required', 'string', 'max:20'],
            ]
        );
        $roles = ['guest', 'writer', 'lister'];
        $role = $request->role;
        if (in_array($role, $roles)) {
            $user->role = $role;
            $user->save();
        }

        return redirect()->route('admin.users', ['id' => $user->id])->with('success', 'USER UPDATE SUCCESSFUL');
    }


    public function ban($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('adminUpdate', $user);
        $user->is_banned = !$user->is_banned;
        $user->save();

        return redirect()->route('admin.users', ['id' => $user->id])->with('success', 'USER UPDATE SUCCESSFUL');
    }


    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        User::destroy($id);
        return redirect()->route('admin.users')->with('success', 'USER DELETED SUCCESSFUL');
    }
}
