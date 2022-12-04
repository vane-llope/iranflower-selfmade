<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowerController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'articles' => Article::latest()->paginate(12),
            'articlepath' => Article::getPath(),
            'posts' => Flower::latest()->filter(request(['tag', 'search']))->paginate(12),
            'path' => Flower::getPath()
        ]);
    }
    public function show(Flower $flower)
    {
        return view('flowers.show', [
            'flower' => $flower,
            'path' => Flower::getPath(),
            'permision' => $this->getPermision(),
            'formInputs' => Flower::getFormInputs(),
        ]);
    }

    public function create()
    {
        if (str_contains($this->getPermision(), 'c')) {
            return view('pages.form', [
                'formInputs' => Flower::getFormInputs(),
                'path' => Flower::getPath(),
                'record' => null,
            ]);
        } else
            abort('403', 'unathorized Action');
    }

    public function store(Request $request)
    {
        if (str_contains($this->getPermision(), 'c')) {
            $formFields = $request->validate([
                'name' => 'required',
                'tags' =>  'required',
                'summary' =>  'required',
                'introduction' =>  'required',
                'irrigation' =>  'required',
                'light' =>  'required',
                'temperature' =>  'required',
                'soil' =>  'required',
                'compost' =>  'required',
            ]);
            Flower::create($formFields);
            return redirect(Flower::getPath())->with('message', 'Flower created successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function edit(Flower $flower)
    {
        if (str_contains($this->getPermision(), 'u')) {
            return view('pages.form', [
                'formInputs' => Flower::getFormInputs(),
                'path' => Flower::getPath(),
                'record' => $flower
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function update(Request $request, Flower $flower)
    {
        if (str_contains($this->getPermision(), 'u')) {
            $formFields = $request->validate([
                'name' => 'required',
                'tags' =>  'required',
                'summary' =>  'required',
                'introduction' =>  'required',
                'irrigation' =>  'required',
                'light' =>  'required',
                'temperature' =>  'required',
                'soil' =>  'required',
                'compost' =>  'required',
            ]);
            $flower->update($formFields);
            return redirect(Flower::getPath() . "/{$flower->id}")->with('message', 'Flower Updated Successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function destroy(Flower $flower)
    {
        if (str_contains($this->getPermision(), 'r')) {
            $flower->delete();
            $previousURL = url()->previous();
            if (str_contains($previousURL, 'manage'))
                return back()->with('message', 'Flower deleted successfully');
            else
                return redirect(Flower::getPath())->with('message', 'Flower deleted successfully');
        } else
            abort('403', 'unathorized Action');
    }

    public function manage()
    {
        if (str_contains($this->getPermision(), 'd')) {
            return view('pages.manage', [
                'items' => Flower::latest()->filter(request(['search']))->paginate(12),
                'path' => Flower::getPath(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function getPermision()
    {
        if (auth()->user() != null) {
            $authId = $authId = auth()->user()->id;

            $roleId =   DB::table('user_roles')
                ->select('user_roles.role_id')
                ->where('user_roles.user_id', '=', $authId);

            if (count($roleId->get()) != 0) {
                $t = $roleId->get()[0]->role_id;
                $permision = DB::table('roles')
                    ->select('roles.flower')
                    ->where('id', '=', $t)
                    ->get()[0]->flower;
                return $permision;
            }
            return null;
        } else
            return null;
    }
}
