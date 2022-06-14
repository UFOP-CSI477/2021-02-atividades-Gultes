@extends('app')

@section('conteudo')

<form action="{{ route('cities.update', $city->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="form-label">Nome:</label>
        <input type="text" name="name" id="name" class="form-control
        @error('name') 
            is-invalid
        @enderror" value="{{ $city->name }}">
    </div>

    <div class="my-4">
        <label for="state_id" class="form-label">Estado:</label>
        <select name="state_id" id="state_id" class="form-select 
        @error('state_id') 
            is-invalid
        @enderror">
            <option value="" selected disabled>Selecione</option>
            @foreach($states as $state)
            <option value="{{ $state->id }}" @if(old('state_id', $city)==$state->id)
                selected @endif>{{ $state->name }}</option>
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