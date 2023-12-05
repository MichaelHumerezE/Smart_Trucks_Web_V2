@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Mapa de Calor</h1>
        </div>
        <div class="card-body">
            <form action="{{route('mapasCalor.store')}}" method="POST" enctype="multipart/form-data" id="create">
                @include('mapasCalor.partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection