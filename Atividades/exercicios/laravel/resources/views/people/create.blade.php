@extends('app')

@section('conteudo')

<form action="{{ route('people.store') }}" method="POST">
    @csrf

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control
        @error('name') 
            is-invalid
        @enderror">
    </div>

    <div class="my-4">
        <label for="city_id" class="form-label">Cidade:</label>
        <select name="city_id" id="city_id" class="form-select 
        @error('city_id') 
            is-invalid
        @enderror">
            <option value="" selected disabled>Selecione</option>
            @foreach($cities as $city)
            <option value="{{ $city->id }}" @if(old('city_id', -1)==$city->id)
                selected @endif
                >{{ $city->name }}</option>
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