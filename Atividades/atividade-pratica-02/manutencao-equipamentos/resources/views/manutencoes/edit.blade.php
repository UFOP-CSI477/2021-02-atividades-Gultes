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
                                <li class="breadcrumb-item active">Alterar registro #{{ $registro->id }}</li>
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
                                    <h3 class="card-title">Alterar registro #{{ $registro->id }}</h3>
                                </div>
                                <form id="formEditarManutencao" method="POST" action="{{ route('sistema.registro.update', ['id' => $registro->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="equipamento_id">Equipamento</label>
                                            <select name="equipamento_id" class="custom-select form-control-border" id="equipamento_id" required>
                                                @foreach ($equipamentos as $equipamento)
                                                    <option @if ($registro->equipamento->id == $equipamento->id) selected @endif value="{{ $equipamento->id }}">{{ $equipamento->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="descricao">Descrição</label>
                                            <textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição da manutenção/problema" required maxlength="191">{{ $registro->descricao }} </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_limite">Data limite</label>
                                            <input value="{{ $registro->data_limite }}" type="date" name="data_limite" class="form-control" id="data_limite" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <select name="tipo" class="custom-select form-control-border" id="tipo" required>
                                                <option @if ($registro->tipo == 1) selected @endif value="1">Preventiva</option>
                                                <option @if ($registro->tipo == 2) selected @endif value="2">Corretiva</option>
                                                <option @if ($registro->tipo == 3) selected @endif value="3">Urgente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="btnEditarManutecao" type="submit" class="btn btn-primary">Alterar</button>
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
        $('#formEditarManutencao').validate({
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

        $('#btnEditarManutecao').click(function(event) {
            event.preventDefault();
            $('#btnEditarManutecao').prop('disabled', true);
            if ($('#formEditarManutencao').valid()) {
                $('#formEditarManutencao').submit();
            } else {
                $('#btnEditarManutecao').prop('disabled', false)
            }
        });
    </script>
@endsection
