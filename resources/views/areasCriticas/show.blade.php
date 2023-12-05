@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Ver Areas Criticas</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('areasCriticas.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            @include('areasCriticas.partials.form')
        </div>
    </div>
@endsection
