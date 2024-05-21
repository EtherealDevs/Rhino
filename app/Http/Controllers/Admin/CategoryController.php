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
        return view('admin.categories.create');
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
                'parent_id'=>$request->parent_id||null,
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
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->file('file')->store('post');

        $category->update(
            [
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description,
                'parent_id'=>$request->parent_id||null,
            ]
            );
        if ($request->file('file')) {
            $url = Storage::put('/', $request->file('file'));
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
