@extends('layouts.app')

@section('content')
        <h2>Gestion Contacte</h2>
    <div class="row yt-2">
            <div class="d-flex justify-content-between">
                {{$articles->links()}}
                <a class="btn btn-success mb-4" href="{{ url('article/create') }}">Ajouter</a>    
            </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nom Complet</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Salaire</th>

        </tr>

        @foreach ($articles as $index=>$article)

            <tr>
                <td>{{ $index +1 }}</td>
                <td>{{ $article->nomComplet }}</td>
                <td>{{ $article->Email }}</td>
                <td>{{ $article->telephone }}</td>
                <td>{{ $article->Salaire }}</td>
                <td>

                    <form action="{{ url('article/'. $article->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('article/'. $article->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('article/'. $article->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>
                </td>

            </tr>

        @endforeach
    </table>

@endsection

