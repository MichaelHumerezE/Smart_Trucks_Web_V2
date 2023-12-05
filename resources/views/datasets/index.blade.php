@extends('layouts.app-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-header d-inline-flex">
            <h1>Datasets</h1>
        </div>
        <a href="{{ route('datasets.query', 1) }}" class="btn btn-primary ml-auto">
            <i class="fas fa-plus"></i>
            Consultas</a>
        <div class="card-body">
            <table class="table table-striped shadow-lg mt-6" id="Datasets">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Carpeta</th>
                        <th>Nombres</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasets as $dataset)
                        <tr>
                            <th>{{ $dataset->id }}</th>
                            <td>{{ $dataset->filename }}</td>
                            <td>{{ $dataset->carpeta }}</td>
                            <td>{{ $dataset->nombres }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @can('ver-dataset')
                                        <a href="{{ url($dataset->url) }}" class="btn btn-info"><i
                                                class="fas fa-download"></i></a>
                                    @endcan
                                    @can('editar-dataset')
                                        <a href="{{ route('datasets.edit', $dataset->id) }}" class="btn btn-primary"><i
                                                class="fas fa-upload"></i></a>
                                    @endcan
                                    <a href="{{ route('datasets.show', $dataset->id) }}" class="btn btn-info"><i
                                            class="fas fa-chart-area"></i></a>
                                    @can('borrar-dataset')
                                        <button type="submit" class="btn btn-danger" form="delete_{{ $dataset->id }}"
                                            onclick="return confirm('¿Estás seguro de eliminar el registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form action="{{ route('datasets.destroy', $dataset->id) }}"
                                            id="delete_{{ $dataset->id }}" method="POST" enctype="multipart/form-data"
                                            hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                    <a href="#" class="btn btn-primary" data-target="#myModal{{ $dataset->id }}"
                                        data-toggle="modal"><i class="fas fa-chart-line"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{ $dataset->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Predecir</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('datasets.store') }}" method="POST"
                                                        enctype="multipart/form-data" id="predict{{ $dataset->id }}">
                                                        @csrf
                                                        <!-- Contenido del modal -->
                                                        <div class="form-floating">
                                                            <input type="hidden" value="{{ $dataset->id }}"
                                                                name="id_dataset">
                                                            <input type="number" name="cantidad"
                                                                placeholder="Cantidad de Dias a Predecir ..."
                                                                class="form-control">
                                                            <label>Cantidad de Dias a Predecir...</label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        form="predict{{ $dataset->id }}">Enviar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        let table = new DataTable('#Datasets', {
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
                    filename: 'Datasets',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    filename: 'Datasets'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info',
                    filename: 'Datasets'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    filename: 'Datasets',
                },
            ]
        });
    </script>
@endsection
