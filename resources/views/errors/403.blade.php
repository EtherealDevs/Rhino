@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
<div style="text-align: center; margin-top: 50px;">
    <h1 style="font-size: 4rem;">Error 403</h1>
    <h1 style="font-size: 4rem;">Pagina no disponible</h1>
    <p style="font-size: 1.5rem; color: #666;">
        Esta direccion no esta disponible en este momento, vuelve a intentarlo mas tarde.
    </p>
    <a href="{{ url('/') }}" style="text-decoration: none;">
        <button>
            Volver al Inicio
        </button>
    </a>
</div>
@endsection
