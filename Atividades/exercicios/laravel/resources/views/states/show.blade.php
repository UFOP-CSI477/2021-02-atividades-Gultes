@extends('app')

@section('conteudo')

<h1>Dados do produto: {{ $state->name }}</h1>

<ul>
    <li>Id: {{$state->id}}</li>
    <li>Nome: {{$state->name}}</li>
    <li>Sigla: {{$state->initials}}</li>
    <li>Criação: {{$state->created_at}}</li>
    <li>Última alteração: {{$state->updated_at}}</li>
</ul>

<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    <a href="{{ route('states.edit', $state->id) }}" class="btn btn-warning">Editar</a>
    <a href="#" class="btn btn-danger" onclick="confirmaExclusao()">Excluir</a>
</div>

<form name="exclusao" action="{{ route('states.destroy', $state->id) }}" method="post">
    @csrf
    @method('DELETE')
</form>

<script>
    function confirmaExclusao() {
        if (confirm('Deseja realmente excluir este produto?')) {
            document.exclusao.submit();
        }
    }
</script>
@endsection