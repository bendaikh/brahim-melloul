@extends('admin.layouts.admin')

@section('title', 'Nouveau représentant')
@section('page-title', 'Nouveau représentant')
@section('page-description', 'Ajouter un nouveau représentant commercial')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('admin.representants.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Retour à la liste</span>
    </a>

    <!-- Form Card -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Ajouter un représentant</h2>
                <p class="text-sm text-white/50">Remplissez les informations ci-dessous</p>
            </div>
        </div>

        <form action="{{ route('admin.representants.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white/70 mb-2">Nom complet <span class="text-red-400">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Nom du représentant">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-white/70 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="email@exemple.com">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-white/70 mb-2">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="+213 XX XX XX XX">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-white/70 mb-2">Adresse</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition resize-none"
                    placeholder="Adresse complète du représentant">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="commission_rate" class="block text-sm font-medium text-white/70 mb-2">Taux de commission (%)</label>
                <div class="relative">
                    <input type="number" step="0.01" min="0" max="100" name="commission_rate" id="commission_rate" value="{{ old('commission_rate', 0) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition pr-12"
                        placeholder="0.00">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">%</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                    class="w-5 h-5 rounded bg-white/5 border-white/20 text-brand-500 focus:ring-brand-500 focus:ring-offset-0">
                <label for="is_active" class="text-sm font-medium text-white/70">Représentant actif</label>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.representants.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
                    Annuler
                </a>
                <button type="submit" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Créer le représentant</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
