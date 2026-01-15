<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AutoPart Pro</title>
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
        .card-stat {
            transition: all 0.3s ease;
        }
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
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

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-gradient w-72 min-h-screen flex flex-col border-r border-white/10 transition-all duration-300 ease-in-out relative">
            
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
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-sm truncate">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-brand-500 font-medium">Super Admin</div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-6 px-3 space-y-1 overflow-y-auto">
                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mb-3 transition-all duration-300">Menu Principal</div>
                
                <a href="#" class="nav-item active flex items-center space-x-3 px-4 py-3 rounded-xl relative group">
                    <svg class="nav-icon w-5 h-5 text-brand-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Tableau de bord</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Tableau de bord</div>
                </a>

                <div class="nav-text text-xs text-white/40 font-semibold uppercase tracking-wider px-4 mt-6 mb-3 transition-all duration-300">Gestion Commerciale</div>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Articles</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Articles</div>
                </a>

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                <a href="#" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white/70 hover:text-white relative group">
                    <svg class="nav-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="nav-text whitespace-nowrap transition-all duration-300">Paramètres</span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-dark-700 rounded-lg text-sm whitespace-nowrap">Paramètres</div>
                </a>
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
        <main class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <header class="sticky top-0 z-40 bg-dark-900/80 backdrop-blur-xl border-b border-white/10 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold">Tableau de Bord</h1>
                        <p class="text-white/50 text-sm">Bienvenue, voici un aperçu de votre activité</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 rounded-xl bg-white/5 hover:bg-white/10 transition">
                            <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-brand-500 rounded-full"></span>
                        </button>
                        <!-- Search -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" placeholder="Rechercher..." class="w-64 bg-white/5 border border-white/10 rounded-xl pl-10 pr-4 py-2 text-sm text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-green-400 bg-green-400/10 px-2 py-1 rounded-full">+12.5%</span>
                        </div>
                        <div class="text-white/50 text-sm mb-1">Ventes du jour</div>
                        <div class="text-2xl font-bold">128,450.00 <span class="text-sm font-normal text-white/50">DA</span></div>
                    </div>

                    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </div>
                            <span class="text-xs text-green-400 bg-green-400/10 px-2 py-1 rounded-full">En stock</span>
                        </div>
                        <div class="text-white/50 text-sm mb-1">Articles en stock</div>
                        <div class="text-2xl font-bold">1,452</div>
                    </div>

                    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-yellow-400 bg-yellow-400/10 px-2 py-1 rounded-full">En attente</span>
                        </div>
                        <div class="text-white/50 text-sm mb-1">Commandes en attente</div>
                        <div class="text-2xl font-bold">12</div>
                    </div>

                    <div class="card-stat bg-gradient-to-br from-dark-800 to-dark-700 rounded-2xl p-6 border border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <span class="text-xs text-red-400 bg-red-400/10 px-2 py-1 rounded-full">Urgent</span>
                        </div>
                        <div class="text-white/50 text-sm mb-1">Alertes Stock</div>
                        <div class="text-2xl font-bold">8</div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Recent Activity -->
                    <div class="lg:col-span-2 bg-dark-800 rounded-2xl border border-white/10 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-semibold">Activité Récente</h2>
                            <button class="text-sm text-brand-500 hover:text-brand-400 transition">Voir tout</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl">
                                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium">Nouvelle vente effectuée</div>
                                    <div class="text-sm text-white/50">Facture #FAC-2026-0042 - Client: Garage Atlas</div>
                                </div>
                                <div class="text-sm text-white/50">Il y a 2h</div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium">Stock mis à jour</div>
                                    <div class="text-sm text-white/50">+50 unités - Filtre à huile Mercedes</div>
                                </div>
                                <div class="text-sm text-white/50">Il y a 5h</div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl">
                                <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium">Alerte stock faible</div>
                                    <div class="text-sm text-white/50">Plaquettes frein Toyota - Seulement 3 en stock</div>
                                </div>
                                <div class="text-sm text-white/50">Il y a 8h</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
                        <h2 class="text-lg font-semibold mb-6">Actions Rapides</h2>
                        <div class="space-y-3">
                            <button class="w-full flex items-center space-x-3 p-4 bg-brand-500/10 hover:bg-brand-500/20 border border-brand-500/30 rounded-xl transition group">
                                <div class="w-10 h-10 bg-brand-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <span class="font-medium">Nouvelle vente</span>
                            </button>
                            <button class="w-full flex items-center space-x-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition group">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                </div>
                                <span class="font-medium">Ajouter client</span>
                            </button>
                            <button class="w-full flex items-center space-x-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition group">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <span class="font-medium">Inventaire</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('w-72');
            sidebar.classList.toggle('w-20');
        }
    </script>

</body>
</html>
