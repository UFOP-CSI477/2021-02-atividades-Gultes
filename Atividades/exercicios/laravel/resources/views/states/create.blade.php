@extends('app')

@section('conteudo')

<form action="{{ route('states.store') }}" method="POST">
    @csrf

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control
        @error('name') 
            is-invalid
        @enderror">
    </div>

    <div>
        <label for=" initials" class="form-label">Sigla:</label>
        <input type="text" name="initials" id="initials" class="form-control 
        @error('initials') 
            is-invalid
        @enderror" value="{{ old('initials') }}">
    </div>


    <div class="my-4">
        <input type="submit" value="Cadastrar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-danger">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</form>

@endsection