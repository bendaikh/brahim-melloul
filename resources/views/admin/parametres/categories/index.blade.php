@extends('admin.layouts.admin')

@section('title', 'Catégories d\'articles')
@section('page-title', 'Catégories d\'articles')
@section('page-description', 'Gérez les catégories de vos articles')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Liste des catégories</h2>
                <p class="text-sm text-white/50">{{ $categories->count() }} catégorie(s) au total</p>
            </div>
        </div>
        <a href="{{ route('admin.parametres.categories.create') }}" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Nouvelle catégorie</span>
        </a>
    </div>

    <!-- Categories Table -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Nom</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Catégorie parente</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Description</th>
                    <th class="text-center px-6 py-4 text-sm font-semibold text-white/70">Articles</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($categories as $category)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-brand-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <span class="font-medium">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-white/60">
                            {{ $category->parent ? $category->parent->name : '-' }}
                        </td>
                        <td class="px-6 py-4 text-white/60 max-w-xs truncate">
                            {{ $category->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[2rem] px-2 py-1 bg-brand-500/20 text-brand-500 rounded-full text-sm font-medium">
                                {{ $category->articles_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.parametres.categories.edit', $category) }}" class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.parametres.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="text-white/50 mb-4">Aucune catégorie trouvée</p>
                                <a href="{{ route('admin.parametres.categories.create') }}" class="text-brand-500 hover:text-brand-400 font-medium">
                                    Créer votre première catégorie
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
