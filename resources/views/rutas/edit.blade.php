@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Areas Criticas de la Ruta</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('rutas.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{route('rutas.update', $ruta->id)}}" method="POST" enctype="multipart/form-data" id="update">
                @method('PUT')
                @include('rutas.partials.form')
            </form>
        </div>
    </div>
@endsection
