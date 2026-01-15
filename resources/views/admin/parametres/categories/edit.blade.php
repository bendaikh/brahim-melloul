@extends('admin.layouts.admin')

@section('title', 'Modifier la catégorie')
@section('page-title', 'Modifier la catégorie')
@section('page-description', 'Modifier les informations de la catégorie')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('admin.parametres.categories.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Retour à la liste</span>
    </a>

    <!-- Form Card -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Modifier: {{ $category->name }}</h2>
                <p class="text-sm text-white/50">Modifiez les informations ci-dessous</p>
            </div>
        </div>

        <form action="{{ route('admin.parametres.categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-white/70 mb-2">Nom de la catégorie <span class="text-red-400">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Ex: Filtres, Freins, Moteur...">
            </div>

            <div>
                <label for="parent_id" class="block text-sm font-medium text-white/70 mb-2">Catégorie parente</label>
                <select name="parent_id" id="parent_id"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                    <option value="">Aucune (catégorie principale)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white/70 mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition resize-none"
                    placeholder="Description de la catégorie...">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.parametres.categories.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
                    Annuler
                </a>
                <button type="submit" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Mettre à jour</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
