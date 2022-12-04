<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'path' => Product::getPath(),
            'articlepath' => Article::getPath(),
            'articles' => Article::latest()->paginate(12),
            'posts' => Product::latest()->filter(request(['tag', 'search']))->paginate(12),
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'path' => Product::getPath(),
            'allproductswatcher' => $this->getAllProductPermision(),
            'formInputs' => Product::getFormInputs(),
        ]);
    }
    public function shops()
    {
        $users = User::
        join('user_roles','users.id','user_roles.user_id')
        ->join('roles','user_roles.role_id','roles.id')
        ->where('roles.product', 'like', '%c%') 
        ->select('users.*')
        ->filter(request(['search']))->paginate(12);

        
            return view('pages.index', [
            'articlepath' => Article::getPath(),
            'articles' => Article::latest()->paginate(12),
            'path' => Product::getPath().'/shops',
            'posts' => $users,
        ]);
    }
   
    public function shop(User $user)
    {
        $products = Product::latest()
            ->where('products.user_id', '=', $user->id)
            ->filter(request(['search']))
            ->paginate(12);
   
        return view('pages.index', [
            'articlepath' => Article::getPath(),
            'articles' => Article::latest()->paginate(12),
            'posts' => $products,
            'path' => Product::getPath()
        ]);
    }
    public function create()
    {
        if (str_contains($this->getPermision(), 'c') || str_contains($this->getAllProductPermision(), 'c')) {
            return view('pages.form', [
                'formInputs' => Product::getFormInputs(),
                'path' => product::getPath(),
                'record' => null
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function store(Request $request)
    {
        if (str_contains($this->getPermision(), 'c') || str_contains($this->getAllProductPermision(), 'c')) {
            $formFields = $request->validate([
                'name' => 'required',
                'tags' =>  'required',
                'description' =>  'required'
            ]);

            $formFields['user_id'] = auth()->id();
            Product::create($formFields);
            return redirect(Product::getPath())->with('message', 'Product created successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function edit(Product $product)
    {

        if ((str_contains($this->getPermision(), 'u') && $product->user_id == auth()->id()) || str_contains($this->getAllProductPermision(), 'u')) {
            return view('pages.form', [
                'formInputs' => Product::getFormInputs(),
                'path' => Product::getPath(),
                'record' => $product
            ]);
        } else
            abort('403', 'unathorized Action');
    }
    public function update(Request $request, Product $product)
    {
        if ((str_contains($this->getPermision(), 'u') && $product->user_id == auth()->id()) || str_contains($this->getAllProductPermision(), 'u')) {
            $formFields = $request->validate([
                'name' => 'required',
                'tags' =>  'required',
                'description' =>  'required'
            ]);

            $product->update($formFields);
            return redirect(Product::getPath() . "/{$product->id}")->with('message', 'Product Updated Successfully!');
        } else
            abort('403', 'unathorized Action');
    }
    public function destroy(Product $product)
    {
        if ((str_contains($this->getPermision(), 'r') && $product->user_id == auth()->id()) || str_contains($this->getAllProductPermision(), 'r')) {
            $product->delete();
            $previousURL = url()->previous();
            if (str_contains($previousURL, 'manage'))
                return back()->with('message', 'Product deleted successfully');
            else
                return redirect(Product::getPath())->with('message', 'Product deleted successfully');
        } else
            abort('403', 'unathorized Action');
    }
    public function manage()
    {
        if (str_contains($this->getPermision(), 'd') || str_contains($this->getAllProductPermision(), 'd')) {
            $product = auth()->user()->products()->latest()->filter(request(['search']))->paginate(12);
            return view('pages.manage', [
                'items' => $product,
                'path' => Product::getPath(),
                'permision' => $this->getPermision()
            ]);
        } else
            abort('403', 'unathorized Action');
    }

    public function manageAll()
    {
        if( str_contains($this->getAllProductPermision(), 'd')){
        $product =  Product::latest()->filter(request(['tag', 'search']))->paginate(12);
        return view('pages.manage', [
            'items' => $product,
            'path' => Product::getPath(),
            'permision' => $this->getAllProductPermision()
        ]);
    }else
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
                    ->select('roles.product')
                    ->where('id', '=', $t)
                    ->get()[0]->product;
                return $permision;
            }
            return null;
        } else
            return null;
    }

    public function getAllProductPermision()
    {
        if (auth()->user() != null) {
            $authId = $authId = auth()->user()->id;

            $roleId = DB::table('user_roles')
                ->select('user_roles.role_id')
                ->where('user_roles.user_id', '=', $authId);

            if (count($roleId->get()) != 0) {
                $t = $roleId->get()[0]->role_id;
                $permision = DB::table('roles')
                    ->select('roles.allproducts')
                    ->where('id', '=', $t)
                    ->get()[0]->allproducts;
                return $permision;
            }
            return null;
        } else
            return null;
    }
}
