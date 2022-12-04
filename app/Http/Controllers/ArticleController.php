<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
            'path' => Article::getPath(),
            'permision' => $this->getPermision(),
            'formInputs' => Article::getFormInputs(),
        ]);
    }

    public function create()
    {
        if (str_contains($this->getPermision(), 'c')) {
            return view('pages.form', [
                'formInputs' => Article::getFormInputs(),
                'path' => Article::getPath(),
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
                'content' =>  'required',
                'introduction' =>  'required',
            ]);

            $formFields['createdby'] = Auth::user()->name;
            $formFields['updatedby'] = Auth::user()->name;
            Article::create($formFields);

            return redirect(Article::getPath()."/manage")->with('message', 'article created successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function edit(Article $article)
    {
        if (str_contains($this->getPermision(), 'u')) {
            return view('pages.form', [
                'formInputs' => Article::getFormInputs(),
                'path' => Article::getPath(),
                'record' => $article
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function update(Request $request, Article $article)
    {
        if (str_contains($this->getPermision(), 'u')) {
            $formFields = $request->validate([
                'name' => 'required',
                'tags' =>  'required',
                'content' =>  'required',
                'introduction' =>  'required',
            ]);
            $formFields['updatedby'] = Auth::user()->name;
            $article->update($formFields);
            return redirect(Article::getPath() . "/{$article->id}")->with('message', 'article Updated Successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function destroy(Article $article)
    {
        if (str_contains($this->getPermision(), 'r')) {
            $article->delete();
            $previousURL = url()->previous();
            if (str_contains($previousURL, 'manage'))
                return back()->with('message', 'article deleted successfully');
            else
                return redirect(Article::getPath())->with('message', 'article deleted successfully');
        } else
            abort('403', 'unathorized Action');
    }

    public function manage()
    {
        if (str_contains($this->getPermision(), 'd')) {
            return view('pages.manage', [
                'items' => Article::latest()->filter(request(['search']))->paginate(12),
                'path' => Article::getPath(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function getPermision()
    {
        if (auth()->user() != null) {
            $authId = $authId = auth()->user()->id;

            $roleId = DB::table('user_roles')
                ->select('user_roles.role_id')
                ->where('user_roles.user_id', '=', $authId);

            if (count($roleId->get()) != 0) {
                $t = $roleId->get()[0]->role_id;
                $permision = DB::table('roles')
                    ->select('roles.article')
                    ->where('id', '=', $t)
                    ->get()[0]->article;
                return $permision;
            }
            return null;
        } else
            return null;
    }
}
