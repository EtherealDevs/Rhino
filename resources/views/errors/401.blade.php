@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
    <div style="text-align: center; margin-top: 50px;">
        <h1 style="font-size: 4rem;">Error 401</h1>
        <h1 style="font-size: 4rem;">Sin Autorizacion</h1>
        <p style="font-size: 1.5rem; color: #666;">
            Estas intentando acceder a una direccion y no tienes las credenciales necesarias, vuelve a intentarlo.
        </p>
        <a href="{{ url('/') }}" style="text-decoration: none;">
            <button>
                Volver al Inicio
            </button>
        </a>
    </div>
@endsection
