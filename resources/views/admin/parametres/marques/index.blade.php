@extends('admin.layouts.admin')

@section('title', 'Marques')
@section('page-title', 'Marques')
@section('page-description', 'Gérez les marques des articles')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white">Liste des marques</h2>
            <p class="text-white/50 text-sm">Total: {{ $brands->count() }} marques</p>
        </div>
        <a href="{{ route('admin.parametres.marques.create') }}" class="inline-flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-4 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Ajouter une marque</span>
        </a>
    </div>

    <!-- Brands Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($brands as $brand)
            <div class="bg-dark-800 border border-white/10 rounded-2xl overflow-hidden group hover:border-brand-500/50 transition">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-white/5 rounded-xl flex items-center justify-center p-2">
                            @if($brand->logo)
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" class="max-w-full max-h-full object-contain">
                            @else
                                <svg class="w-8 h-8 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.parametres.marques.edit', $brand) }}" class="p-2 bg-white/5 text-white/60 hover:text-brand-500 hover:bg-brand-500/10 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.parametres.marques.destroy', $brand) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette marque ?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white/5 text-white/60 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-lg">{{ $brand->name }}</h3>
                        <p class="text-white/50 text-sm mt-1">{{ $brand->articles_count }} articles associés</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($brands->isEmpty())
        <div class="bg-dark-800 border border-white/10 rounded-2xl p-12 text-center">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 class="text-white font-semibold text-lg">Aucune marque trouvée</h3>
            <p class="text-white/50 mb-6">Commencez par ajouter votre première marque.</p>
            <a href="{{ route('admin.parametres.marques.create') }}" class="inline-flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Ajouter une marque</span>
            </a>
        </div>
    @endif
</div>
@endsection
