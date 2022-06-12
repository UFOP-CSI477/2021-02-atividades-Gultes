@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="wrapper">
        @include('layouts.navbar')

        @include('layouts.sidebar')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Área administrativa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Página inicial</a></li>
                                <li class="breadcrumb-item">Área administrativa</li>
                                <li class="breadcrumb-item active">Manutenções</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Todas manutenções</h3> <br>
                                    <h5 class="p-2">Nova manutenção:
                                        <a href="{{ route('sistema.registro.create') }}" class="btn btn-success btn-circle">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Data limite</th>
                                                <th>Nome do equipamento</th>
                                                <th>Nome do usuário</th>
                                                <th>Tipo da manutenção</th>
                                                <th>Descrição da manutenção</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    <td class="text-center">{{ data_br($registro->data_limite) }}</td>
                                                    <td>{{ $registro->equipamento->nome }}</td>
                                                    <td>{{ $registro->user->name }}</td>
                                                    <td class="text-center">{!! get_tipo_registro($registro->tipo) !!}</td>
                                                    <td>{{ $registro->descricao }}</td>
                                                    <td class="align-center text-center">
                                                        <a href="{{ route('sistema.registro.edit', ['id' => $registro->id]) }}" class="btn btn-info btn-circle">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeletarRegistro" data-id="{{ $registro->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Data limite</th>
                                                <th>Nome do equipamento</th>
                                                <th>Nome do usuário</th>
                                                <th>Tipo da manutenção</th>
                                                <th>Descrição da manutenção</th>
                                                <th>Ações</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>

    <div class="modal fade" id="modalDeletarRegistro">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tem certeza que deseja deletar esse registro?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('sistema.registro.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="registro_id" name="id" value="">
                    <div class="modal-body">
                        <p>Essa ação não poderá ser desfeita.</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true;">Deletar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>

    <script>
        $("#example1").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });

        $('#modalDeletarRegistro').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const modal = $(this);
            modal.find('#registro_id').val(button.attr('data-id'));
        });
    </script>
@endsection
