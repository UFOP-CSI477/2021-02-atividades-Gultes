@extends('app')

@section('conteudo')

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Um</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td><a href="{{ route('products.show', $p->id) }}">{{$p->name}}</a></td>
            <td>{{$p->um}}</td>
            <td class="d-flex justify-content-around">
                <a href="{{ route('products.show', $p->id) }}" class="btn btn-info">Exibir</a>
                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning">Editar</a>
        </tr>
        @endforeach
</table>

<div class="container">
    <a class="btn btn-primary" href="{{ route('products.create') }}">Incluir</a>

</div>

@endsection