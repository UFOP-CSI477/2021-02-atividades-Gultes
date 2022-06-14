@extends('app')

@section('conteudo')

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Pessoa</th>
            <th scope="col">Produto</th>
            <th scope="col">Data</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->person->name}}</td>
            <td>{{ $p->product->name }}</td>
            <td>{{ $p->created_at }}</td>
            <td class="d-flex justify-content-around">
                <a href="{{ route('purchases.show', $p->id) }}" class="btn btn-info">Exibir</a>
                <a href="{{ route('purchases.edit', $p->id) }}" class="btn btn-warning">Editar</a>
            </td>
        </tr>
        @endforeach
</table>

<div class="container">
    <a class="btn btn-primary" href="{{ route('purchases.create') }}">Incluir</a>
    <a class="btn btn-primary" href="{{ route('purchases.people') }}">Listar por pessoa</a>
    <a class="btn btn-primary" href="{{ route('purchases.date') }}">Listar por data</a>
    <a class="btn btn-primary" href="{{ route('purchases.products') }}">Listar por produto</a>

</div>

@endsection