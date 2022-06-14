@extends('app')

@section('conteudo')

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control 
        @error('name') 
            is-invalid
        @enderror" value="{{ old('name') }}">
    </div>

    <div>
        <label for="um" class="form-label">Unidade de Medida:</label>
        <input type="text" name="um" id="um" class="form-control 
        @error('um') 
            is-invalid
        @enderror" value="{{ old('um') }}">
    </div>


    <div class="my-4">
        <input type="submit" value="Cadastrar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-danger">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</form>

@endsection