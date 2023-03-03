@extends('layouts.master')

@section('content')
<div class="my-3 p-3 bg-white rounded box-shadow">
    <h4 class="border-bottom border-gray pb-2 mb-2">Liste des étudiants inscrits</h4>
    <div class="mt-4">
      <div class="d-flex justify-content-end mb-2">
        <div><a href="{{route('etudiants.create')}}" class="btn btn-primary d-flex ">Ajouter un nouvel étudiant<a/> </div>
      </div>

      @if (session()->has("successDelete"))
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
          <strong>  {{session()->get("successDelete")}} </strong>
      </div>    
      @endif

      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Noms</th>
            <th scope="col">Prénom</th>
            <th scope="col">Classe</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($etudiants as $etudiant)
          <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$etudiant->nom}}</td>
            <td>{{$etudiant->prenom}}</td>
            <td>{{$etudiant->Classe->libelle}}</td>
            <td>
                <a href="{{route('etudiants.edit',$etudiant->id)}}" class="btn btn-info">Editer</a>
                <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cet étudiant ?')){
                  document.getElementById('form-{{$etudiant->id}}').submit()}">Supprimer</a>
                
                <form id="form-{{$etudiant->id}}"action="{{route('etudiants.delete',
                ['etudiant'=>$etudiant->id])}}"method="post">
                    @csrf
                  <input type="hidden" name="_method" value="delete">
                </form>
            
            </td>
          </tr>
          @endforeach
        </tbody>
        
      </table>
      <div class="">{{$etudiants->links()}}</div>
    </div>
  
  </div>
        
@endsection