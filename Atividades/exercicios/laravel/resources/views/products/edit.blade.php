@extends('app')

@section('conteudo')

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control 
        @error('name') 
            is-invalid
        @enderror" value="{{ old('name', $product->name) }}">
    </div>

    <div class="my-4">
        <label for="um" class="form-label">Unidade de medida:</label>
        <input type="text" name="um" id="um" class="form-control
        @error('um') 
            is-invalid
        @enderror
        " value="{{ old('um', $product->um) }}">
    </div>

    <div class="my-4">
        <input type="submit" value="Atualizar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-danger">
    </div>
</form>

@endsection