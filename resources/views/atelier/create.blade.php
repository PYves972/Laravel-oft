@extends('layouts.app') <!-- Utilise votre layout existant visible dans layouts/ -->

@section('content')
<div class="container py-4">
    <h2>Uploader une image vers Cloudflare R2</h2>

    <!-- Affichage d'un message de succès éventuel -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire pointant vers la route de votre AtelierController -->
    <form action="{{ route('atelier.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="image" class="form-label">Choisir une image :</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer l'image</button>
    </form>
</div>
@endsection
