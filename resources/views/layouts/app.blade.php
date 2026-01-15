<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPart Pro - @yield('title', 'Pièces Auto de Qualité')</title>
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
        .hero-gradient {
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 50%, #2d1f3d 100%);
        }
        .card-glow:hover {
            box-shadow: 0 0 40px rgba(240, 117, 26, 0.15);
        }
        .text-gradient {
            background: linear-gradient(135deg, #f0751a, #f39340);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .nav-blur {
            backdrop-filter: blur(12px);
            background: rgba(15, 15, 26, 0.85);
        }
    </style>
</head>
<body class="bg-dark-900 text-white antialiased">

    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 nav-blur border-b border-white/10">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-display text-2xl tracking-wider">AUTOPART</span>
                        <span class="font-display text-2xl tracking-wider text-brand-500">PRO</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white/80 hover:text-brand-500 transition font-medium">Accueil</a>
                    <a href="{{ route('catalog') }}" class="text-white/80 hover:text-brand-500 transition font-medium">Catalogue</a>
                    <a href="#brands" class="text-white/80 hover:text-brand-500 transition font-medium">Marques</a>
                    <a href="#contact" class="text-white/80 hover:text-brand-500 transition font-medium">Contact</a>
                </div>

                <!-- CTA -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-lg font-semibold transition shadow-lg shadow-brand-500/25">
                            Administration
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-white/80 hover:text-white transition font-medium">
                            Connexion
                        </a>
                        <a href="{{ route('login') }}" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-lg font-semibold transition shadow-lg shadow-brand-500/25">
                            Espace Pro
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-800 border-t border-white/10 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                        </div>
                        <span class="font-display text-xl tracking-wider">AUTOPART PRO</span>
                    </div>
                    <p class="text-white/60 leading-relaxed">
                        Votre partenaire de confiance pour les pièces détachées automobiles de qualité.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-lg mb-6">Navigation</h4>
                    <ul class="space-y-3 text-white/60">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-500 transition">Accueil</a></li>
                        <li><a href="{{ route('catalog') }}" class="hover:text-brand-500 transition">Catalogue</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Nos Marques</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">À Propos</a></li>
                    </ul>
                </div>

                <!-- Marques -->
                <div>
                    <h4 class="font-semibold text-lg mb-6">Marques Populaires</h4>
                    <ul class="space-y-3 text-white/60">
                        <li><a href="#" class="hover:text-brand-500 transition">Mercedes-Benz</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Toyota</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">BMW</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Audi</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold text-lg mb-6">Contact</h4>
                    <ul class="space-y-3 text-white/60">
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>contact@autopartpro.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+213 XX XX XX XX</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 mt-12 pt-8 text-center text-white/40">
                <p>&copy; 2026 AutoPart Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

</body>
</html>
