<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $id=null;
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        return view('admin.categories.create',compact('categories','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category=Category::create(
            [
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description,
                'parent_id'=>$request->parent_id,
            ]
            );
        if($request->file('image')){
            $url = Storage::put('categories', $request->file('image'));
            $category->image()->create([
                'url' => $url
            ]);
        }
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parent=Category::where('id',$category->parent_id)->first();
        $categories= Category::all();
        return view('admin.categories.edit',compact('category','categories','parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $category->update(
            [
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description,
                'parent_id'=>$request->parent_id,
            ]
            );
        if ($request->file('image')) {
            $url = Storage::put('categories', $request->file('image'));
            $category->image()->create([
                'url' => $url
            ]);
        }
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->image()->delete();
        $category->delete();
        return back();
    }
}
