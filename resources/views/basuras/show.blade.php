@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Ver Basuras</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('basuras.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            @include('basuras.partials.form')
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection
