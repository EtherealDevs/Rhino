@extends('layouts.admin')
@section('content')
<div class="pt-20 px-10">
    <form action={{route('admin.categories.update' ,$category)}} method="POST"  enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label for="name">
            <p>nombre</p>
            <input type="text" name="name" value={{$category->name}}>
        </label>
        <label for="slug">
            <p>slug</p>
            <input type="text" name="slug" value={{$category->slug}}>
        </label>
        <label for="description">
            <p>descripcion</p>
            <input type="textarea" name="description" value={{$category->description}}>
        </label>
        <label for="image">
            <img src={{Storage::url($category->image->url)}} alt="">
            <p>imagen</p>
            <input type="file" name="image" accept="image/*" id="image">
        </label>
        <label for="parent_id">
            <p>padre</p>
            <select value={{$category->parent_id}} name="parent_id" id="">
                <option value={{$category->parent_id}}>{{$parent->name}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </label>
        <button type="submit">guardar</button>
    </form>
</div>
@endsection
