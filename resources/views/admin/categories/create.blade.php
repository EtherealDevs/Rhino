@extends('layouts.admin')
@section('content')
<div class="pt-20 px-10">
    <form action={{route('admin.categories.store')}} method="POST">
        @csrf
        <label for="name">
            <p>nombre</p>
            <input type="text" name="name">
        </label>
        <label for="slug">
            <p>slug</p>
            <input type="text" name="slug">
        </label>
        <label for="description">
            <p>descripcion</p>
            <input type="textarea" name="description">
        </label>
        <label for="image">
            <p>imagen</p>
            <input type="file" name="image" accept="image/*" id="image">
        </label>
        <label for="parent_id">
            <p>padre</p>
            <select name="parent_id" id="">
                <option value="null">0</option>
            </select>
        </label>
        <button type="submit">guardar</button>
    </form>
</div>
@endsection
