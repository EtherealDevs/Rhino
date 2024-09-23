@extends('layouts.app')
@section('title', 'Seccion de productos')

@section('meta_description', 'Descubre la moda del futuro hoy mismo. Ropa de hombre y adolescente innovadora y exclusiva, diseñada para los que buscan un estilo único. Compra online las últimas tendencias y renueva tu armario sin salir de casa. #modainnovadora #ropasonline #estilopropio')
@section('content')
    <div id="products">
        @livewire('products')
    </div>
@endsection
