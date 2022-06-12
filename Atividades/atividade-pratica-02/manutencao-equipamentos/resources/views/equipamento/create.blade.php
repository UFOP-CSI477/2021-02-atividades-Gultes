@extends('app')

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
                                <li class="breadcrumb-item">Área administrativa</li>
                                <li class="breadcrumb-item"><a href="{{ route('sistema.equipamento.index') }}">Equipamentos</a></li>
                                <li class="breadcrumb-item active">Novo equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Novo equipamento</h3>
                                </div>
                                <form id="formNovoEquipamento" method="POST" action="{{ route('sistema.equipamento.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome do equipamento" required maxlength="50">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="btnNovoEquipamento" type="submit" class="btn btn-primary">Cadastrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
@endsection

@section('scripts')
    <script>
        $('#formNovoEquipamento').validate({
            rules: {
                nome: {
                    required: true,
                },
            },
            messages: {
                nome: {
                    required: "Por favor, preencha este campo",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#btnNovoEquipamento').click(function(event) {
            event.preventDefault();
            $('#btnNovoEquipamento').prop('disabled', true);
            if ($('#formNovoEquipamento').valid()) {
                $('#formNovoEquipamento').submit();
            } else {
                $('#btnNovoEquipamento').prop('disabled', false);
            }
        });
    </script>
@endsection
