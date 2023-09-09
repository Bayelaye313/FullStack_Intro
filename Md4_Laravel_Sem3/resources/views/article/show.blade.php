@extends('layouts.app')


@section('content')

    <h1>Gestion Article</h1>


    <table class="table table-bordered">

        <tr>
            <th>Nom Complet:</th>
            <td>{{ $article->nomComplet }}</td>
        </tr>

        <tr>

            <th>Telephone:</th>
            <td>{{ $article->telephone }}</td>

        </tr>

        <tr>

            <th>Email:</th>
            <td>{{ $article->Email }}</td>

        </tr>

        <tr>

            <th>Salaire:</th>
            <td>$ {{ $article->Salaire }}</td>

        </tr>

    </table>

    <a href="{{url('/')}}" class="btn btn-info">Retour</a>

@endsection