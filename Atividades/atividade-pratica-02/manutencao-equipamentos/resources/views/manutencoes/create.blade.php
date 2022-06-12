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
                                <li class="breadcrumb-item"><a href="{{ route('sistema.registro.index') }}">Registros</a>
                                </li>
                                <li class="breadcrumb-item active">Novo registro</li>
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
                                    <h3 class="card-title">Novo registro</h3>
                                </div>
                                <form id="formNovaManutencao" method="POST" action="{{ route('sistema.registro.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="equipamento_id">Equipamento</label>
                                            <select name="equipamento_id" class="custom-select form-control-border" id="equipamento_id" required>
                                                @foreach ($equipamentos as $equipamento)
                                                    <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="descricao">Descrição</label>
                                            <textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição da manutenção/problema" required maxlength="191"> </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_limite">Data limite</label>
                                            <input type="date" name="data_limite" class="form-control" id="data_limite" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <select name="tipo" class="custom-select form-control-border" id="tipo" required>
                                                <option value="1">Preventiva</option>
                                                <option value="2">Corretiva</option>
                                                <option value="3">Urgente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="btnNovaManutencao" type="submit" class="btn btn-primary">Cadastrar</button>
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
        $('#formNovaManutencao').validate({
            rules: {
                descricao: {
                    required: true,
                },
                data_limite: {
                    required: true,
                }
            },
            messages: {
                descricao: {
                    required: "Por favor, preencha este campo",
                },
                data_limite: {
                    required: "Por favor, selecione uma data válida",
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

        $('#btnNovaManutencao').click(function(event) {
            event.preventDefault();
            $('#btnNovaManutencao').prop('disabled', true);
            if ($('#formNovaManutencao').valid()) {
                $('#formNovaManutencao').submit();
            } else {
                $('#btnNovaManutencao').prop('disabled', false);
            }
        });
    </script>
@endsection
