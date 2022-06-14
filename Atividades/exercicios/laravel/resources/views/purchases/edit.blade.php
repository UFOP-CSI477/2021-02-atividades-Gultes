@extends('app')

@section('conteudo')

<form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="my-4">
        <label for="person_id" class="form-label">Pessoa:</label>
        <select name="person_id" id="person_id" class="form-select 
        @error('person_id') 
            is-invalid
        @enderror">
            <option value="" selected disabled>Selecione</option>
            @foreach($people as $person)
            <option value="{{ $person->id }}" @if(old('person_id', $purchase)==$person->id)
                selected @endif
                >{{ $person->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="my-4">
        <label for="product_id" class="form-label">Produto:</label>
        <select name="product_id" id="product_id" class="form-select 
        @error('product_id') 
            is-invalid
        @enderror">
            <option value="" selected disabled>Selecione</option>
            @foreach($products as $product)
            <option value="{{ $product->id }}" @if(old('product_id', $purchase)==$product->id)
                selected @endif
                >{{ $product->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="my-4">
        <input type="submit" value="Cadastrar" class="btn btn-primary">
        <input type="reset" value="Limpar" class="btn btn-danger">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
    </div>
</form>

@endsection