@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Ver Zona</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('zonas.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
                @include('zonas.partials.form')
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection
