@extends('app')

@section('conteudo')

<h1>Dados da cidade: {{ $city->name }}</h1>

<ul>
    <li>Id: {{$city->id}}</li>
    <li>Nome: {{$city->name}}</li>
    <li>Estado:<a href="{{ route('states.show', $city->state_id) }}">{{$city->state->name}}</a></li>
    <li>Criação: {{$city->created_at}}</li>
    <li>Última alteração: {{$city->updated_at}}</li>
</ul>

<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-warning">Editar</a>
    <a href="#" class="btn btn-danger" onclick="confirmaExclusao()">Excluir</a>
</div>

<form name="exclusao" action="{{ route('cities.destroy', $city->id) }}" method="post">
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