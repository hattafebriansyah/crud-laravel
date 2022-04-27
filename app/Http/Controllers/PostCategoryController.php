<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostCategory::latest()->get();
        return view('dashboard.post-category.index', [
            "active" => "Post Category",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.post-category.create', [
            "active" => "Form Create Post Category"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $create = PostCategory::create($validate);
        if (!$create) {
            return redirect('/post-category/create')->with('error', 'Create Post Category Failed !');
        }

        return redirect('/post-category')->with('success', 'Success Created Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        $data = PostCategory::find($postCategory['id']);
        return view('dashboard.post-category.edit', [
            "active" => "Form Edit Post Category",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $edit = PostCategory::find($id);
        if (!$edit) {
            return redirect('/post-category/' . $id . 'edit')->with('error', 'data not found');
        }

        $input = $request->except('_token', '_method');
        // dd($input);
        $edit->update($input);

        if (!$edit) {
            return redirect('/post-category/' . $id . 'edit')->with('error', 'Update Failed');
        }

        return redirect('/post-category')->with('success', 'data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PostCategory::find($id);
        if (!$data) {
            return redirect('/post-category/')->with('error', 'data not found');
        }

        $data->delete();

        return redirect('/post-category')-> with ('success', 'data deleted');
    }
}