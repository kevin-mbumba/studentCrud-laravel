@extends('layouts.master')

@section('content')
<div class="my-3 p-3 bg-white rounded box-shadow">
    <h4 class="border-bottom border-gray pb-2 mb-2">Ajoute d'un nouvel étudiant</h4>
    <div class="mt-4">

        @if (session()->has("success"))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
                <strong>  {{session()->get("success")}} </strong>
            </div>    
        @endif

        {{-- @if ($erros->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li> 
                    @endforeach
                    
                </ul>
            </div>
        @endif --}}

        <div>

        </div>
        <form style="width:80%" method="POST" action="{{route('etudiants.store')}}" autocomplete="off">

            @csrf

            <div class="mb-3">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" id="nom" name="nom" class="form-control @error('nom')is-invalid @enderror" value="{{old('nom')}}">
                @error('nom')
                    <span class="invalid-feedback">{{ $message}}</span>
                @enderror
            </div>

            <div class="mb-3">
              <label for="Prenom" class="form-label">Prenom</label>
              <input type="text" id="prenom" name="prenom" class="form-control @error('prenom')is-invalid @enderror" value="{{old('prenom')}}">
                @error('prenom')
                    <span class="invalid-feedback">{{ $message}}</span>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="classe" class="form-label">Classe</label>
                <select  class="form-control @error('classe_id')is-invalid @enderror" id="classe_id" name="classe_id">
                    <option value=""></option>
                    @foreach ($classes as $classe)
                        <option value="{{$classe->id}}">{{$classe->libelle}}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <span class="invalid-feedback">{{ $message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{route('etudiants.index')}}" class="btn btn-danger">Annuler</a>
          </form>
    </div>
  
  </div>
        
@endsection