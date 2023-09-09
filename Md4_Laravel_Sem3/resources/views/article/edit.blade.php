@extends('layouts.app')


@section('content')


    <h1>Modifier article</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('article/'. $article->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="nomComplet">Nom:</label>
            <input type="text" class="form-control" id="nomComplet" placeholder="Entrer Nom" name="nomComplet" value="{{ $article->nomComplet }}">

        </div>

        <div class="form-group mb-3">

            <label for="telephone">Telephone:</label>
            <input type="text" class="form-control" id="telephone" placeholder="Entrer Telephone" name="telephone" value="{{ $article->telephone }}">

        </div>

        <div class="form-group mb-3">

            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Entrer Email" name="Email" value="{{ $article->Email }}">

        </div>

        <div class="form-group mb-3">

            <label for="salaire">Salaire ($):</label>
            <input type="number" class="form-control" id="salaire" placeholder="Salaire" name="Salaire" value="{{ $article->Salaire }}">

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection
