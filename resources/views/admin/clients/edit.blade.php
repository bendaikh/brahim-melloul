@extends('admin.layouts.admin')

@section('title', 'Modifier le client')
@section('page-title', 'Modifier le client')
@section('page-description', 'Modifier les informations du client')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
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
                <h2 class="text-lg font-semibold">Modifier: {{ $client->nom_client }}</h2>
                <p class="text-sm text-white/50">Modifiez les informations ci-dessous</p>
            </div>
        </div>

        <form action="{{ route('admin.clients.update', $client) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nom_client" class="block text-sm font-medium text-white/70 mb-2">Nom du client <span class="text-red-400">*</span></label>
                <input type="text" name="nom_client" id="nom_client" value="{{ old('nom_client', $client->nom_client) }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Nom du client">
            </div>

            <div>
                <label for="numero_client" class="block text-sm font-medium text-white/70 mb-2">Numéro client <span class="text-red-400">*</span></label>
                <input type="text" name="numero_client" id="numero_client" value="{{ old('numero_client', $client->numero_client) }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Numéro unique du client">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="telephone" class="block text-sm font-medium text-white/70 mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $client->telephone) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="+213 XX XX XX XX">
                </div>
                <div>
                    <label for="ice" class="block text-sm font-medium text-white/70 mb-2">ICE</label>
                    <input type="text" name="ice" id="ice" value="{{ old('ice', $client->ice) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="Identifiant Commun de l'Entreprise">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="ville" class="block text-sm font-medium text-white/70 mb-2">Ville</label>
                    <input type="text" name="ville" id="ville" value="{{ old('ville', $client->ville) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="Ville">
                </div>
                <div>
                    <label for="region" class="block text-sm font-medium text-white/70 mb-2">Région</label>
                    <input type="text" name="region" id="region" value="{{ old('region', $client->region) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="Région">
                </div>
            </div>

            <div>
                <label for="representant_id" class="block text-sm font-medium text-white/70 mb-2">Représentant</label>
                <select name="representant_id" id="representant_id"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                    <option value="">Sélectionner un représentant</option>
                    @foreach($representants as $representant)
                        <option value="{{ $representant->id }}" {{ old('representant_id', $client->representant_id) == $representant->id ? 'selected' : '' }}>
                            {{ $representant->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-white/70 mb-2">Adresse</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition resize-none"
                    placeholder="Adresse complète du client">{{ old('address', $client->address) }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.clients.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
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
