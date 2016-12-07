<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Validator;
use Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|min:3',
            'description' => 'required|min:3',
        ]);
    }
    
    public function index(Category $category)
    {
        $data['allCateg'] = $category->get()->toArray();
        return view('home')->with('categ',$data);
    }
    public function postAddCategory(Request $request)
    {
        $this->validator($request->all())->validate();
        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' =>  Auth::user()->id
        ]);
        return back();
        
    }
    public function getCategory(Category $category,$id)
    {
        $data['allCateg'] = $category->get()->toArray();
        $selected = $category::whereId($id)->get()->toArray();
        $posts = $category::find($id)->post()->whereCategories_id($id)->get()->toArray();
        
        return view('category.index')
                ->with('categ',$data)
                ->with('selected',$selected)
                ->with('posts',$posts);
    }
}
