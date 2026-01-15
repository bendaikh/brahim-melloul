@extends('admin.layouts.admin')

@section('title', 'Articles')
@section('page-title', 'Articles')
@section('page-description', 'Gérez votre catalogue d\'articles')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Liste des articles</h2>
                <p class="text-sm text-white/50">{{ $articles->total() }} article(s) au total</p>
            </div>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Nouvel article</span>
        </a>
    </div>

    <!-- Articles Table -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Article</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Référence</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Catégorie</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Marque</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Prix Brut</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Représentant</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-white/70">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($articles as $article)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if($article->image)
                                        <img src="{{ asset($article->image) }}" alt="{{ $article->name }}" class="w-12 h-12 rounded-lg object-cover bg-white/10">
                                    @else
                                        <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium">{{ $article->name }}</div>
                                        @if($article->code)
                                            <div class="text-xs text-white/40">Code: {{ $article->code }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm text-brand-400">{{ $article->reference }}</span>
                            </td>
                            <td class="px-6 py-4 text-white/60">
                                {{ $article->category->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($article->carLogo)
                                    <div class="flex items-center space-x-2">
                                        @if($article->carLogo->image)
                                            <img src="{{ asset($article->carLogo->image) }}" alt="{{ $article->carLogo->name }}" class="w-6 h-6 object-contain">
                                        @endif
                                        <span class="text-white/60">{{ $article->carLogo->name }}</span>
                                    </div>
                                @else
                                    <span class="text-white/40">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ number_format($article->prix_brut, 2, ',', ' ') }}</span>
                                <span class="text-white/40 text-sm">MAD</span>
                            </td>
                            <td class="px-6 py-4 text-white/60">
                                {{ $article->representant->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition" title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <p class="text-white/50 mb-4">Aucun article trouvé</p>
                                    <a href="{{ route('admin.articles.create') }}" class="text-brand-500 hover:text-brand-400 font-medium">
                                        Créer votre premier article
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="px-6 py-4 border-t border-white/10">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
