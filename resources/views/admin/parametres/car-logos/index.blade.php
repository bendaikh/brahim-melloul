@extends('admin.layouts.admin')

@section('title', 'Logo de voiture')
@section('page-title', 'Logo de voiture')
@section('page-description', 'Gérez les logos des marques de voitures')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Liste des logos</h2>
                <p class="text-sm text-white/50">{{ $carLogos->count() }} logo(s) au total</p>
            </div>
        </div>
        <a href="{{ route('admin.parametres.car-logos.create') }}" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Nouveau logo</span>
        </a>
    </div>

    <!-- Car Logos Grid -->
    @if($carLogos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($carLogos as $carLogo)
                <div class="bg-dark-800 rounded-2xl border border-white/10 overflow-hidden hover:border-brand-500/50 transition group">
                    <!-- Logo Image -->
                    <div class="aspect-square bg-white/5 flex items-center justify-center p-6">
                        @if($carLogo->image)
                            <img src="{{ asset($carLogo->image) }}" alt="{{ $carLogo->name }}" class="max-w-full max-h-full object-contain">
                        @else
                            <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Logo Info -->
                    <div class="p-4 border-t border-white/10">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-lg">{{ $carLogo->name }}</h3>
                            @if($carLogo->is_active)
                                <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">Actif</span>
                            @else
                                <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded-full text-xs font-medium">Inactif</span>
                            @endif
                        </div>
                        <p class="text-sm text-white/50 mb-4">{{ $carLogo->articles_count }} article(s) associé(s)</p>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.parametres.car-logos.edit', $carLogo) }}" class="flex-1 flex items-center justify-center space-x-2 p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="text-sm">Modifier</span>
                            </a>
                            <form action="{{ route('admin.parametres.car-logos.destroy', $carLogo) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce logo ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition" title="Supprimer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-12 text-center">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                </svg>
            </div>
            <p class="text-white/50 mb-4">Aucun logo de voiture trouvé</p>
            <a href="{{ route('admin.parametres.car-logos.create') }}" class="text-brand-500 hover:text-brand-400 font-medium">
                Ajouter votre premier logo
            </a>
        </div>
    @endif
</div>
@endsection
