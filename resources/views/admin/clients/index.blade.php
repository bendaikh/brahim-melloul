@extends('admin.layouts.admin')

@section('title', 'Clients')
@section('breadcrumb-title', 'Clients')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Liste des clients</h2>
                <p class="text-sm text-white/50">{{ $clients->count() }} client(s) au total</p>
            </div>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Nouveau client</span>
        </a>
    </div>

    <!-- Clients Table -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Client</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Numéro</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Contact</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Localisation</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-white/70">Représentant</th>
                    <th class="text-right px-6 py-4 text-sm font-semibold text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($clients as $client)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($client->nom_client, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-medium">{{ $client->nom_client }}</div>
                                    @if($client->ice)
                                        <div class="text-xs text-white/40">ICE: {{ $client->ice }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-white/70">{{ $client->numero_client }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                @if($client->telephone)
                                    <div class="flex items-center space-x-2 text-sm text-white/60">
                                        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $client->telephone }}</span>
                                    </div>
                                @endif
                                @if($client->address)
                                    <div class="text-xs text-white/40 truncate max-w-[200px]">{{ $client->address }}</div>
                                @endif
                                @if(!$client->telephone && !$client->address)
                                    <span class="text-white/40">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                @if($client->ville)
                                    <div class="text-sm text-white/70">{{ $client->ville }}</div>
                                @endif
                                @if($client->region)
                                    <div class="text-xs text-white/40">{{ $client->region }}</div>
                                @endif
                                @if(!$client->ville && !$client->region)
                                    <span class="text-white/40">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($client->representant)
                                <span class="inline-flex items-center px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm font-medium">
                                    {{ $client->representant->name }}
                                </span>
                            @else
                                <span class="text-white/40">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.clients.edit', $client) }}" class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition" title="Modifier">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <p class="text-white/50 mb-4">Aucun client trouvé</p>
                                <a href="{{ route('admin.clients.create') }}" class="text-brand-500 hover:text-brand-400 font-medium">
                                    Ajouter votre premier client
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
