@extends('admin.layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de Bord')
@section('page-description', 'Bienvenue, voici un aperçu de votre activité')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <span class="text-xs text-brand-400 bg-brand-400/10 px-2 py-1 rounded-full">Total</span>
        </div>
        <div class="text-white/50 text-sm mb-1">Articles</div>
        <div class="text-2xl font-bold">{{ $stats['articles_count'] ?? 0 }}</div>
    </div>

    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <span class="text-xs text-green-400 bg-green-400/10 px-2 py-1 rounded-full">Actif</span>
        </div>
        <div class="text-white/50 text-sm mb-1">Catégories</div>
        <div class="text-2xl font-bold">{{ $stats['categories_count'] ?? 0 }}</div>
    </div>

    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                </svg>
            </div>
            <span class="text-xs text-yellow-400 bg-yellow-400/10 px-2 py-1 rounded-full">Marques</span>
        </div>
        <div class="text-white/50 text-sm mb-1">Logos de voiture</div>
        <div class="text-2xl font-bold">{{ $stats['car_logos_count'] ?? 0 }}</div>
    </div>

    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <span class="text-xs text-purple-400 bg-purple-400/10 px-2 py-1 rounded-full">Équipe</span>
        </div>
        <div class="text-white/50 text-sm mb-1">Représentants</div>
        <div class="text-2xl font-bold">{{ $stats['representants_count'] ?? 0 }}</div>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Quick Actions -->
    <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-6">Actions Rapides</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.articles.create') }}" class="w-full flex items-center space-x-3 p-4 bg-brand-500/10 hover:bg-brand-500/20 border border-brand-500/30 rounded-xl transition group">
                <div class="w-10 h-10 bg-brand-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <span class="font-medium">Nouvel article</span>
            </a>
            <a href="{{ route('admin.parametres.categories.create') }}" class="w-full flex items-center space-x-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition group">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <span class="font-medium">Nouvelle catégorie</span>
            </a>
            <a href="{{ route('admin.parametres.car-logos.create') }}" class="w-full flex items-center space-x-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition group">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <span class="font-medium">Nouveau logo</span>
            </a>
            <a href="{{ route('admin.representants.create') }}" class="w-full flex items-center space-x-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition group">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <span class="font-medium">Nouveau représentant</span>
            </a>
        </div>
    </div>

    <!-- Navigation Rapide -->
    <div class="lg:col-span-2 bg-dark-800 rounded-2xl border border-white/10 p-6">
        <h2 class="text-lg font-semibold mb-6">Navigation Rapide</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-4 bg-white/5 hover:bg-brand-500/10 border border-white/10 hover:border-brand-500/30 rounded-xl text-center transition group">
                <div class="w-12 h-12 bg-brand-500/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">Articles</span>
            </a>
            <a href="{{ route('admin.representants.index') }}" class="p-4 bg-white/5 hover:bg-brand-500/10 border border-white/10 hover:border-brand-500/30 rounded-xl text-center transition group">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">Représentants</span>
            </a>
            <a href="{{ route('admin.parametres.categories.index') }}" class="p-4 bg-white/5 hover:bg-brand-500/10 border border-white/10 hover:border-brand-500/30 rounded-xl text-center transition group">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">Catégories</span>
            </a>
            <a href="{{ route('admin.parametres.car-logos.index') }}" class="p-4 bg-white/5 hover:bg-brand-500/10 border border-white/10 hover:border-brand-500/30 rounded-xl text-center transition group">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">Logos</span>
            </a>
        </div>

        <!-- Info Section -->
        <div class="mt-6 p-4 bg-brand-500/10 border border-brand-500/30 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-brand-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-brand-400 mb-1">Bienvenue dans votre espace d'administration</h3>
                    <p class="text-xs text-white/60">Utilisez le menu latéral pour naviguer entre les différentes sections. Commencez par créer des catégories et des logos de voiture avant d'ajouter des articles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
