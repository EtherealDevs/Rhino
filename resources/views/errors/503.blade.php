@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message')
    <div style="text-align: center; margin-top: 50px;">
        <h1 style="font-size: 4rem;">Error 503</h1>
        <h1 style="font-size: 4rem;">Servicio no disponible</h1>
        <p style="font-size: 1.5rem; color: #666;">
            Esta direccion no esta disponible en este momento,el servidor a caido, vuelve a intentarlo mas tarde.
        </p>
    </div>
@endsection
