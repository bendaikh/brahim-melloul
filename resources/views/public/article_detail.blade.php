@extends('layouts.app')
@section('title', $article->name)
@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded shadow-lg p-8">
        <h1 class="text-3xl font-bold">{{ $article->name }}</h1>
        <p class="text-gray-500">Référence: {{ $article->reference }}</p>
    </div>
</div>
@endsection
