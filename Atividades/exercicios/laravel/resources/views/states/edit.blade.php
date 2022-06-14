@extends('app')

@section('conteudo')

<form action="{{ route('states.update', $state->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control 
        @error('name') 
            is-invalid
        @enderror" value="{{ old('name', $state->name) }}">
    </div>

    <div class="my-4">
        <label for="initials" class="form-label">Sigla:</label>
        <input type="text" name="initials" id="initials" class="form-control
        @error('initials') 
            is-invalid
        @enderror
        " value="{{ old('initials', $state->initials) }}">
    </div>

    <div class="my-4">
        <input type="submit" value="Atualizar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-danger">
    </div>
</form>

@endsection