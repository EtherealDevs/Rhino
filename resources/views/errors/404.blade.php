@extends('errors.minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    <div style="text-align: center; margin-top: 50px;">
        <h1 style="font-size: 4rem;">Error 404</h1>
        <h2 style="font-size: 3rem;">URL invalida</h2>
        <p style="font-size: 1.5rem; color: #666;">
            Esta direccion no existe, vuelve a intentarlo.
        </p>
    </div>
@endsection
