<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - AutoPart Pro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            50: '#fef7ee',
                            100: '#fdedd6',
                            200: '#fad7ac',
                            300: '#f7ba77',
                            400: '#f39340',
                            500: '#f0751a',
                            600: '#e15a10',
                            700: '#ba4310',
                            800: '#943615',
                            900: '#782f14',
                        },
                        'dark': {
                            700: '#232336',
                            800: '#1a1a2e',
                            900: '#0f0f1a',
                        }
                    },
                    fontFamily: {
                        'display': ['Bebas Neue', 'sans-serif'],
                        'body': ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .sidebar-gradient {
            background: linear-gradient(180deg, #1a1a2e 0%, #0f0f1a 100%);
        }
        .nav-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-item:hover {
            background: rgba(240, 117, 26, 0.1);
            transform: translateX(4px);
        }
        .nav-item.active {
            background: linear-gradient(90deg, rgba(240, 117, 26, 0.2) 0%, transparent 100%);
            border-left: 3px solid #f0751a;
        }
        .nav-item.active .nav-icon {
            color: #f0751a;
        }
        .sub-nav {
            display: none;
        }
        .nav-group.expanded .sub-nav {
            display: block;
        }
        .nav-group.expanded .arrow-icon {
            transform: rotate(180deg);
        }
        .sidebar-collapsed .nav-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        .sidebar-collapsed .nav-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        .sidebar-collapsed .sidebar-header span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        .sidebar-collapsed .sidebar-footer span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        .sidebar-collapsed .user-info {
            display: none;
        }
        .sidebar-collapsed .toggle-btn {
            transform: rotate(180deg);
        }
        .sidebar-collapsed .sub-nav {
            display: none !important;
        }
        .card-stat {
            transition: all 0.3s ease;
        }
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        select option {
            background-color: #1a1a2e;
            color: white;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s ease;
        }
        .sidebar-collapsed .nav-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-dark-900 text-white min-h-screen">

    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-gradient w-72 min-h-screen flex flex-col border-r border-white/10 transition-all duration-300 ease-in-out fixed left-0 top-0 bottom-0 z-50">
            
            <!-- Toggle Button -->
            <button onclick="toggleSidebar()" class="toggle-btn absolute -right-3 top-8 w-6 h-6 bg-brand-500 rounded-full flex items-center justify-center shadow-lg shadow-brand-500/30 hover:bg-brand-600 transition-all duration-300 z-50">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="sidebar-header p-6 border-b border-white/10">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-brand-500/20">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <span class="nav-text font-display text-xl tracking-wider whitespace-nowrap transition-all duration-300">AUTOPART <span class="text-brand-500">PRO</span></span>
                </a>
            </div>

            <!-- User Info -->
            <div class="user-info p-4 mx-4 mt-4 bg-white/5 rounded-2xl border border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center font-bold text-sm">
                        {{ substr(auth()->user()->name ?? 'AD', 0, 2) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-sm truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-xs text-brand-500 font-medium">Super Admin</div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-6 px-3 space-y-1 overflow-y-auto">
                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mb-3 transition-all duration-300">Menu Principal</div>
                
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl relative group">
                    <svg class="nav-icon w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-brand-500' : 'text-white/70' }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-white/70' }}">Tableau de bord</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Tableau de bord</div>
                </a>

                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mt-6 mb-3 transition-all duration-300">Gestion Commerciale</div>

                <!-- Articles -->
                <a href="{{ route('admin.articles.index') }}" class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.articles.*') ? 'text-brand-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Articles</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Articles</div>
                </a>

                <!-- Representants -->
                <a href="{{ route('admin.representants.index') }}" class="nav-item {{ request()->routeIs('admin.representants.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.representants.*') ? 'text-brand-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Représentants</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Représentants</div>
                </a>

                <!-- Clients -->
                <a href="{{ route('admin.clients.index') }}" class="nav-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.clients.*') ? 'text-brand-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Clients</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Clients</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Fournisseurs</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Fournisseurs</div>
                </a>

                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mt-6 mb-3 transition-all duration-300">Ventes & Achats</div>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Bons de commande</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Bons de commande</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Bons de livraison</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Bons de livraison</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Factures</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Factures</div>
                </a>

                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mt-6 mb-3 transition-all duration-300">Stock & Finance</div>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Stock & Inventaire</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Stock & Inventaire</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Règlements</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Règlements</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Rapports</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Rapports</div>
                </a>

                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mt-6 mb-3 transition-all duration-300">Système</div>

                <!-- Paramètres avec sous-menus -->
                <div class="nav-group {{ request()->routeIs('admin.parametres.*') ? 'expanded' : '' }}">
                    <button onclick="toggleNavGroup(this)" class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-xl text-white/70 hover:text-white relative group {{ request()->routeIs('admin.parametres.*') ? 'active' : '' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="nav-icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.parametres.*') ? 'text-brand-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="nav-text whitespace-nowrap transition-all duration-300">Paramètres</span>
                        </div>
                        <svg class="arrow-icon w-4 h-4 transition-transform duration-300 nav-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="sub-nav pl-12 space-y-1 mt-1">
                        <a href="{{ route('admin.parametres.categories.index') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.parametres.categories.*') ? 'text-brand-500 bg-brand-500/10' : 'text-white/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span>Catégories d'articles</span>
                        </a>
                        <a href="{{ route('admin.parametres.car-logos.index') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.parametres.car-logos.*') ? 'text-brand-500 bg-brand-500/10' : 'text-white/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                            </svg>
                            <span>Logo de voiture</span>
                        </a>
                        <a href="{{ route('admin.parametres.marques.index') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.parametres.marques.*') ? 'text-brand-500 bg-brand-500/10' : 'text-white/60 hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span>Marques</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Footer -->
            <div class="sidebar-footer p-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-red-400 hover:text-red-300 hover:bg-red-500/10 relative group">
                        <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="nav-text whitespace-nowrap transition-all duration-300">Déconnexion</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Déconnexion</div>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-72 transition-all duration-300 min-h-screen" id="main-content">
            <!-- Top Breadcrumb Bar -->
            <div class="sticky top-0 z-40 bg-white border-b border-gray-200 px-8 py-3 shadow-sm">
                <div class="flex items-center space-x-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="text-dark-700 hover:text-brand-500 transition-colors" title="Accueil">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h6a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.707.707a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-dark-700 font-medium">@yield('breadcrumb-title', 'Accueil')</span>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-20');
            mainContent.classList.toggle('ml-72');
            mainContent.classList.toggle('ml-20');
        }

        function toggleNavGroup(button) {
            const group = button.closest('.nav-group');
            group.classList.toggle('expanded');
        }
    </script>
</body>
</html>
