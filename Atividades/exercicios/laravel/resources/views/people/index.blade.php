@extends('app')

@section('conteudo')

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($people as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td><a href="{{ route('people.show', $p->id) }}">{{$p->name}}</a></td>
            <td>{{ $p->city->name }}</td>
            <td>{{ $p->city->state->name }}</td>
            <td class="d-flex justify-content-around">
                <a href="{{ route('people.show', $p->id) }}" class="btn btn-info">Exibir</a>
                <a href="{{ route('people.edit', $p->id) }}" class="btn btn-warning">Editar</a>
            </td>
        </tr>
        @endforeach
</table>

<div class="container">
    <a class="btn btn-primary" href="{{ route('people.create') }}">Incluir</a>

</div>

@endsection