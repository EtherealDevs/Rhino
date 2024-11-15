<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load de las relaciones parentCategory y subCategories
        $categories = Category::with('parentCategory', 'subCategories')->get();
        return view('admin.categories.index', compact('categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        return view('admin.categories.create', compact('categories', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'nullable|array', // Validar si las imágenes están presentes
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validar cada imagen
        ]);

        // Crear la categoría
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        // Manejar la carga de imágenes si existen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Subir la imagen y almacenar la URL
                $path = $image->store('images/categories', 'public');

                // Crear una nueva imagen asociada a la categoría
                $category->images()->create([
                    'url' => $path,
                ]);
            }
        }

        // Redirigir a la vista con éxito
        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada correctamente!');
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
        $parent = Category::where('id', $category->parent_id)->first();
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Subir imagen si existe y eliminar la antigua
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $path = $request->file('image')->store('categories', 'public');
            $validatedData['image'] = $path;
        }

        $category->update($validatedData);

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

    public function deleteImage(Image $image)
    {
        Storage::disk('public')->delete($image->url); // Elimina el archivo del storage
        $image->delete(); // Elimina el registro de la base de datos

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
