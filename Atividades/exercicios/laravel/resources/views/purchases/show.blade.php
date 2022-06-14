@extends('app')

@section('conteudo')

<h1>Compra:</h1>

<ul>
    <li>Id: {{$purchase->id}}</li>
    <li>Pessoa: {{$purchase->person->name}}</li>
    <li>Produto: {{$purchase->product->name}}</li>
    <li>Criação: {{$purchase->created_at}}</li>
    <li>Última alteração: {{$purchase->updated_at}}</li>
</ul>

<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning">Editar</a>
    <a href="#" class="btn btn-danger" onclick="confirmaExclusao()">Excluir</a>
</div>

<form name="exclusao" action="{{ route('purchases.destroy', $purchase->id) }}" method="post">
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