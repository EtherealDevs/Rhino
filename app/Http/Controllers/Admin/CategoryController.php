<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class CategoryController extends Controller
{
    public function index()
    {
        // Eager load de las relaciones parentCategory y subCategories
        $categories = Category::with('parentCategory', 'subCategories')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        return view('admin.categories.create', compact('categories', 'id'));
    }

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
            'parent_id' =>  $request->parent_id ?? null,
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


    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        $parent = Category::where('id', $category->parent_id)->first();
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories', 'parent'));
    }

    public function update(Request $request, Category $category)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'images' => 'nullable|array', // Para permitir múltiples imágenes
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // Validación de imágenes
        ]);

        // Actualizar la categoría
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        // Subir imágenes si se han proporcionado
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('categories/images', 'public');
                $category->images()->create([
                    'url' => $path,
                ]);
            }
        }

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente.');
    }


    public function destroy(Category $category)
    {
        if (isset($category->images)) {
            $category->images()->delete();
        }/*
        @dd($category->images(), $category->images); */
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
