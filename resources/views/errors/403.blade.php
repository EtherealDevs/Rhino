@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')

    <div style="text-align: center; margin-top: 50px;">
        <h1 style="font-size: 4rem;">Error 403</h1>
        <h1 style="font-size: 4rem;">Página no disponible</h1>
        <p style="font-size: 1.5rem; color: #666;">
            Esta dirección no está disponible en este momento, vuelve a intentarlo más tarde.
        </p>
    </div>
@endsection
