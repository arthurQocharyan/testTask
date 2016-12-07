<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Posts;
use Validator;
use Carbon\Carbon;
use Auth;


class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data,$params)
    {
        return Validator::make($data, $params);
    }

    public function getPost(Posts $post,$id){
        $data = $post->whereId($id)->get();
        return view('posts.post')->with('post',$data[0]);
    }
    public function getAddPost(Category $category)
    {
       
        $data = $category->get()->toArray();
        return view('posts.index')->with('categ',$data);
        
    }
    public function postAddPost(Request $request)
    {
        $params= [
            'title' => 'required|max:255|min:3',
            'description' => 'required|min:3',
            'category' => 'required|numeric',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validator($request->all(),$params)->validate();
        $current = Carbon::now();
        $avatarName = '';
        if(isset($request->avatar)){
            $avatarName = $this->avatarUpload($request->avatar);
        }
        Posts::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'categories_id' => $request->category,
            'publish_date' =>$current,
            'avatar' => $avatarName,
        ]);
        return redirect()->route('login');
        
        
    }
    public function postDelete(Posts $post ,$id)
    {
        $oldAvatar = Posts::whereId($id)->pluck('avatar');
        if($post->whereId($id)->delete()){
            unlink(public_path('avatar'.'/'.$oldAvatar['0']));
        };
        return redirect()->route('login');
    }

    public function postPostedit(Request $request,$id)
    {
        $oldAvatar = Posts::whereId($id)->pluck('avatar');
        $params= [
            'title' => 'required|max:255|min:3',
            'description' => 'required|min:3',
            'category' => 'required|numeric',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        if(!$request->avatar){
            unset($params['avatar']);
        }
        
        $this->validator($request->all(),$params)->validate();
        if(isset($request->avatar)){
            $imageName = time().'.'.$request->avatar->getClientOriginalExtension();
            $success = $request->avatar->move(public_path('avatar'), $imageName);
            if(isset($success)){
               unlink(public_path('avatar'.'/'.$oldAvatar['0']));
                $oldAvatar['0'] = $imageName;
            }
        }
        $post = Posts::find($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->categories_id = $request->category;
            $post->avatar = $oldAvatar['0'];
        $post->save();
        return back();
        
    }

    private function avatarUpload($data)
    {
    	$imageName = time().'.'.$data->getClientOriginalExtension();
        $data->move(public_path('avatar'), $imageName);
    	return $imageName;
    }
    public function getPostedit(Posts $post,$id)
    {
        $categ = Category::get()->toArray();
        $data = $post->whereId($id)->get();
        return view('posts.postedite')
                ->with('post',$data[0])
                ->with('categ',$categ);
    }
    
}