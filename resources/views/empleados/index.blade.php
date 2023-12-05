@extends('layouts.app-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline-flex">
            <h1>Empleados</h1>
        </div>
        @can('crear-empleado')
            <a href="{{ route('empleados.create') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-plus"></i>
                Agregar</a>
        @endcan
        <div class="card-body">
            <table class="table table-striped shadow-lg mt-6" id="empleados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Foto</th>
                        <th>Email</th>
                        <th>CI</th>
                        <th>Sexo</th>
                        <th>Phone</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->name }}</td>
                            <td><img src="{{ $empleado->image }}" class="img-fluid" alt="Responsive image" width="150">
                            </td>
                            <td>{{ $empleado->email }}</td>
                            <td>{{ $empleado->ci }}</td>
                            <td>{{ $empleado->sexo }}</td>
                            <td>{{ $empleado->phone }}</td>
                            @if ($empleado->estado = 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            <td>
                                @if (!empty($empleado->getRoleNames()))
                                    @foreach ($empleado->getRoleNames() as $rolname)
                                        <span>{{ $rolname }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @can('ver-empleado')
                                        <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info"><i
                                                class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('editar-empleado')
                                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary"><i
                                                class="fas fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('borrar-empleado')
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $empleado->id }}"
                                            onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form action="{{ route('empleados.destroy', $empleado->id) }}"
                                            id="delete_{{ $empleado->id }}" method="POST" enctype="multipart/form-data"
                                            hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script>
        let table = new DataTable('#empleados', {
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            dom: 'Bfrtilp',
            buttons: [{
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i>',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn btn-primary'
                }, {
                    extend: 'csv',
                    text: '<i class="fas fa-code"></i>',
                    titleAttr: 'Exportar a CSV',
                    className: 'btn btn-success',
                    filename: 'empleados',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    filename: 'empleados'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info',
                    filename: 'empleados'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    filename: 'empleados',
                },
            ]
        });
    </script>
@endsection