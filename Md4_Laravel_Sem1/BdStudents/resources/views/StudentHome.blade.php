@extends('layouts.master')
@section('contenu')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-4 mb-0">Bienvenu dans notre Application</h3>
  </div>    
<div class="yt-2">
    <div class="d-flex justify-content-between">
        {{$etudiants->links()}}
        <a href="{{route('etudiant.create')}}" class=" btn btn-outline-primary mb-4">Ajouter un nouvel étudiant</a>
    </div>
  <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
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
            <td>{{$etudiant->classe->libelle}}</td>
            <td>
                <a href="#" class=" btn btn-outline-info">Editer</a>
                <a href="#" class=" btn btn-outline-danger">Supprimer</a>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>

@endsection