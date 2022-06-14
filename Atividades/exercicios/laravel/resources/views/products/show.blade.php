@extends('app')

@section('conteudo')

<h1>Dados do produto: {{ $product->name }}</h1>

<ul>
    <li>Id: {{$product->id}}</li>
    <li>Nome: {{$product->name}}</li>
    <li>Unidade de medida: {{$product->um}}</li>
    <li>Criação: {{$product->created_at}}</li>
    <li>Última alteração: {{$product->updated_at}}</li>
</ul>

<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
    <a href="#" class="btn btn-danger" onclick="confirmaExclusao()">Excluir</a>
</div>

<form name="exclusao" action="{{ route('products.destroy', $product->id) }}" method="post">
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