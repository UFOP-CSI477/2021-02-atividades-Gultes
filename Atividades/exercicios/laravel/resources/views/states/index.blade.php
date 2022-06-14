@extends('app')

@section('conteudo')

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Sigla</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($states as $s)
        <tr>
            <td>{{$s->id}}</td>
            <td><a href="{{ route('states.show', $s->id) }}">{{$s->name}}</a></td>
            <td>{{$s->initials}}</td>
            <td class="d-flex justify-content-around">
                <a href="{{ route('states.show', $s->id) }}" class="btn btn-info">Exibir</a>
                <a href="{{ route('states.edit', $s->id) }}" class="btn btn-warning">Editar</a>
        </tr>
        @endforeach
</table>

<div class="container">
    <a class="btn btn-primary" href="{{ route('states.create') }}">Incluir</a>

</div>

@endsection