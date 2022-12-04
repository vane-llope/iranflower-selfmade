<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (str_contains($this->getPermision(), 'd')) {
            return view('pages.manage', [
                'items' => User::latest()->filter(request(['search']))->paginate(12),
                'path' => User::getPath(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function create()
    {
        return view('users.register', [
            'formInputs' => User::getFormInputs(),
            'path' => User::getPath(),
            'record' => null
        ]);
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'address' => 'required',
            'idnumber' => 'required',
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        //create user
        $user = User::create($formFields);
        //login
        auth()->login($user);
        return redirect('/flowers')->with('message', 'welcome ' . $formFields['name']);
    }
    public function show(User $user)
    {
        if (str_contains($this->getPermision(), 'd')) {
            $userRoleId = DB::table('user_roles')
                ->select('user_roles.role_id')
                ->where('user_roles.user_id', $user->id);
            if (count($userRoleId->get()) != 0) {
                $role =  DB::table('roles')
                    ->select('roles.name')
                    ->where('roles.id', $userRoleId->get()[0]->role_id)
                    ->get()[0]->name;
            } else
                $role = 'No Role';
            return view('users.show', [
                'user' => $user,
                'formInputs' => User::getFormInputs(),
                'role' => $role
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function edit(User $user)
    {
        if (str_contains($this->getPermision(), 'u') || (auth()->user()->id == $user->id)) {
            $roleID = DB::table('user_roles')->where('user_id', $user->id);
            $role = null;
            if (count($roleID->get()) != 0)
                $role = DB::table('roles')->where('id', $roleID->get('role_id')[0]->role_id)->get()[0];
            else
                $role = null;
            return view('users.edit', [
                'formInputs' => User::getFormInputs(),
                'path' => User::getPath(),
                'record' => $user,
                'roles' => Role::get(),
                'selectedrole' =>  $role,
                'accessRole' =>  str_contains($this->getPermision(), 'u')
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function update(Request $request, User $user)
    {
        if (str_contains($this->getPermision(), 'u') || (auth()->user()->id == $user->id)) {
            $formFields = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'company' => 'required',
                'address' => 'required',
                'role' => 'nullable',
            ]);
            if ($formFields['role'] == 0) {
                DB::table('user_roles')->where('user_id', $user->id)->delete();
            }
            if ($formFields['role'] && str_contains($this->getPermision(), 'u')) {
                $roleExist = DB::table('user_roles')
                    ->select('*')
                    ->where('user_roles.user_id', '=', $user->id)
                    ->get();
                if (count($roleExist) == 0) {
                    $role = [
                        "role_id" => $formFields['role'],
                        "user_id" => "$user->id",
                    ];
                    UserRole::create($role);
                } else {
                    DB::table('user_roles')->where('user_id', $user->id)->update(['role_id' =>  $formFields['role']]);
                }
            }
            $user->update($formFields);
            return back()->with('message', 'User Updated successfully');
        } else
            abort('403', 'unathorized Action');
    }
    public function destroy(User $user)
    {
        if (str_contains($this->getPermision(), 'r')) {
            $user->delete();
            return redirect(User::getPath() . "/manage")->with('message', $user['name'] . ' has been deleted');
        } else
            abort('403', 'unathorized Action');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/flowers')->with('message', 'You Have Been Logged Out');
    }
    public function login()
    {
        return view('users.login', [
            'formInputs' => [
                ["type" => "text", "name" => "email", "value" => "Email", "rule" => "required"],
            ],
            'path' => User::getPath() . '/authenticate',
            'record' => null
        ]);
    }
    //authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/flowers')->with('message', 'You Are Logged In');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
    public function getPermision()
    {
        $authId = auth()->user()->id;
        $roleId =   DB::table('user_roles')
            ->select('user_roles.role_id')
            ->where('user_roles.user_id', '=', $authId);

        if (count($roleId->get()) != 0) {
            $t = $roleId->get()[0]->role_id;
            $permision = DB::table('roles')
                ->select('roles.user')
                ->where('id', '=', $t)
                ->get()[0]->user;
            return $permision;
        }
        return null;
    }
    public function changePassword()
    {
        return view('users.change-password');
    }
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("message", "Old Password Doesn't match!");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/flowers')->with('message', 'Password changed successfully!');
    }
}
