<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        if (str_contains($this->getPermision(), 'd')) {
            return view('pages.manage', [
                'items' => Role::latest()->filter(request(['search']))->paginate(12),
                'path' => Role::getPath(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }

    public function create()
    {
        if (str_contains($this->getPermision(), 'c')) {
            return view('pages.form', [
                'formInputs' => Role::getFormInputs(),
                'path' => Role::getPath(),
                'record' => null
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function store(Request $request)
    {
        if (str_contains($this->getPermision(), 'c')) {
            $formFields = $request->validate([
                'name' => 'required',
                'article' => 'nullable',
                'user' => 'nullable',
                'product' => 'nullable',
                'allproducts' => 'nullable',
                'flower' => 'nullable',
                'role' => 'nullable',
            ]);

            if($formFields['article']) $formFields['article'] = implode("",$formFields['article']);
            if($formFields['user']) $formFields['user'] = implode("",$formFields['user']);
            if($formFields['product']) $formFields['product'] = implode("",$formFields['product']);
            if($formFields['allproducts']) $formFields['allproducts'] = implode("",$formFields['allproducts']);
            if($formFields['flower']) $formFields['flower'] = implode("",$formFields['flower']);
            if($formFields['role']) $formFields['role'] = implode("",$formFields['role']);

            Role::create($formFields);
            return redirect(Role::getPath() . '/manage')->with('message', 'Role created successfully!');
        } else
            abort('403', 'unathorized Action');
    }


    public function show(Role $role)
    {
        if (str_contains($this->getPermision(), 'd')) {
            return view('roles.show', [
                'item' => $role,
                'formInputs' => Role::getFormInputs(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }


    public function edit(Role $role)
    {
        if (str_contains($this->getPermision(), 'u')) {
            return view('pages.form', [
                'formInputs' => Role::getFormInputs(),
                'path' => Role::getPath(),
                'record' => $role
            ]);
        } else
            abort('403', 'unathorized Action');
    }


    public function update(Request $request, Role $role)
    {
        //dd($request);
        if (str_contains($this->getPermision(), 'u')) {
            $formFields = $request->validate([
                'name' => 'required',
                'article' => 'nullable',
                'user' => 'nullable',
                'product' => 'nullable',
                'allproducts' => 'nullable',
                'flower' => 'nullable',
                'role' => 'nullable'
            ]);
            
            
            if(is_array($formFields['article']) && $formFields['article']) $formFields['article'] = implode("",$formFields['article']);
            if(is_array($formFields['user']) && $formFields['user']) $formFields['user'] = implode("",$formFields['user']);
            if(is_array($formFields['product']) && $formFields['product']) $formFields['product'] = implode("",$formFields['product']);
            if(is_array($formFields['allproducts']) && $formFields['allproducts']) $formFields['allproducts'] = implode("",$formFields['allproducts']);
            if(is_array($formFields['flower']) && $formFields['flower']) $formFields['flower'] = implode("",$formFields['flower']);
            if(is_array($formFields['role']) && $formFields['role']) $formFields['role'] = implode("",$formFields['role']);

            $role->update($formFields);
            return redirect(Role::getPath() . "/{$role->id}")->with('message', 'Role Updated Successfully!');
        } else
            abort('403', 'unathorized Action');
    }

    public function destroy(Role $role)
    {
        if (str_contains($this->getPermision(), 'r')) {
            $role->delete();
            return redirect(Role::getPath() . '/manage')->with('message', $role['name'] . ' has been deleted');
        } else
            abort('403', 'unathorized Action');
    }
    public function getPermision()
    {
        $authId = $authId = auth()->user()->id;

        $roleId =   DB::table('user_roles')
            ->select('user_roles.role_id')
            ->where('user_roles.user_id', '=', $authId);

        if (count($roleId->get()) != 0) {
            $t = $roleId->get()[0]->role_id;
            $permision = DB::table('roles')
                ->select('roles.role')
                ->where('id', '=', $t)
                ->get()[0]->role;
            return $permision;
        }
        return null;
    }
}
