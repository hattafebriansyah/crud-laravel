<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::latest();

        if(request('search')){
            $data->where('title','like','%'.request('search').'%')
                 ->orWhere('body','like','%'.request('search').'%');
        }

        return view('dashboard.post.index', [
            'active' => 'Post',
            'data' => $data->paginate(4)
        ] );
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategory = PostCategory::all();
        //dd($postCategory);

        return view('dashboard.post.create', [
            'active' => 'Post',
            'postCategory' => $postCategory
            ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function slugify($text){
        $text = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/','-',$text)));

        return $text;
    }

    public function store(Request $request)
    {
       

        $validate = $request->validate([
            'title' => 'required|max:255',
            'post_category_id' => 'required',
            'author' => 'required',
            'body' => 'required',
        ]);
        $validate ['slug'] = $this->slugify($validate['title']);
        //dd($validate);

        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('post-image');
        }

        $create = Post::create($validate);

        if (!$create){
            return redirect('/post/create')-> with ('error', 'Create Post Failed!');
        }

        return redirect('/post') ->with('success', 'Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Post::find($id);
        $postCategory = PostCategory::all();
        return view ('dashboard.post.edit',[
            'active' => 'Form Edit Post',
            'edit' => $edit,
            'postCategory' => $postCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Post::find($id);
        if(!$edit){
            return redirect('/post/'.$id.'/edit')-> with ('error', 'Data Not Found!');
        }

        $request-> validate([
            'title' => 'required|max:255',
            'post_category_id' => 'required',
            'author' => 'required',
            'body' => 'required',
        ]);

        $input = $request -> except('_token','_method');
        $input['slug'] = $this->slugify($input['title']);

        if($request->file('image')){
            $input['image'] = $request->file('image')->store('post-image');

            if($edit->image){
                Storage::delete($edit->image);
            }
        }


        $edit->update($input);

        if(!$edit){
            return redirect('/post')->with('error','Update Failed!');
        }

        return redirect('/post')->with('success','Data Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::find($id);

        if(!$data){
            return redirect('/post')->with ('error','Data not Found');
        }

        if($data->image){
            Storage::delete($data->image);
        }

        $data->delete();

        return redirect('/post')->with ('success', 'Data Deleted !');
    }
}
