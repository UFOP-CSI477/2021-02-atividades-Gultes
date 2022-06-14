@extends('app')

@section('conteudo')

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Estado</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td><a href="{{ route('cities.show', $c->id) }}">{{$c->name}}</a></td>
            <td>{{ $c->state->name }} - {{ $c->state->initials }}</td>
            <td class="d-flex justify-content-around">
                <a href="{{ route('cities.show', $c->id) }}" class="btn btn-info">Exibir</a>
                <a href="{{ route('cities.edit', $c->id) }}" class="btn btn-warning">Editar</a>
        </tr>
        @endforeach
</table>

<div class="container">
    <a class="btn btn-primary" href="{{ route('cities.create') }}">Incluir</a>

</div>

@endsection