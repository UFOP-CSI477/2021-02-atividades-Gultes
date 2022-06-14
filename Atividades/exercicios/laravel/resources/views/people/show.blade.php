@extends('app')

@section('conteudo')

<h1>Dados da pessoa: {{ $person->name }}</h1>

<ul>
    <li>Id: {{$person->id}}</li>
    <li>Nome: {{$person->name}}</li>
    <li>Cidade: {{$person->city->name}}</li>
    <li>Estado: {{$person->city->state->name}}</li>
    <li>Criação: {{$person->created_at}}</li>
    <li>Última alteração: {{$person->updated_at}}</li>
</ul>

<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    <a href="{{ route('people.edit', $person->id) }}" class="btn btn-warning">Editar</a>
    <a href="#" class="btn btn-danger" onclick="confirmaExclusao()">Excluir</a>
</div>

<form name="exclusao" action="{{ route('people.destroy', $person->id) }}" method="post">
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