@extends('layouts.app')

@section('title', 'Accueil - Pièces Auto Premium')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient min-h-screen flex items-center pt-20 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Text Content -->
            <div class="space-y-8">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm text-white/80">Plus de 50,000 références en stock</span>
                </div>

                <h1 class="font-display text-6xl lg:text-8xl leading-none">
                    PIÈCES AUTO
                    <span class="text-gradient block">PREMIUM</span>
                </h1>

                <p class="text-xl text-white/70 max-w-lg leading-relaxed">
                    Trouvez rapidement la pièce parfaite pour votre véhicule. 
                    Mercedes, Toyota, BMW, Audi et bien plus encore.
                </p>

                <!-- Search Bar -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-2 border border-white/20 max-w-xl">
                    <form class="flex items-center">
                        <div class="flex-1 flex items-center px-4">
                            <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" placeholder="Référence, nom de pièce, marque..." class="flex-1 bg-transparent border-none outline-none text-white placeholder-white/50 px-4 py-3">
                        </div>
                        <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-8 py-3 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                            Rechercher
                        </button>
                    </form>
                </div>

                <!-- Stats -->
                <div class="flex items-center space-x-8 pt-4">
                    <div>
                        <div class="text-3xl font-bold text-brand-500">50K+</div>
                        <div class="text-white/50 text-sm">Références</div>
                    </div>
                    <div class="w-px h-12 bg-white/20"></div>
                    <div>
                        <div class="text-3xl font-bold text-brand-500">15+</div>
                        <div class="text-white/50 text-sm">Marques</div>
                    </div>
                    <div class="w-px h-12 bg-white/20"></div>
                    <div>
                        <div class="text-3xl font-bold text-brand-500">24h</div>
                        <div class="text-white/50 text-sm">Livraison</div>
                    </div>
                </div>
            </div>

            <!-- Hero Image / 3D Element -->
            <div class="hidden lg:flex justify-center items-center relative">
                <div class="animate-float">
                    <div class="relative w-96 h-96">
                        <!-- Gear/Part Illustration -->
                        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/20 to-purple-500/20 rounded-full blur-3xl"></div>
                        <svg class="w-full h-full text-brand-500 drop-shadow-2xl" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.14 12.94c.04-.31.06-.63.06-.94 0-.31-.02-.63-.06-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands Section -->
<section id="brands" class="py-24 bg-dark-800">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="font-display text-5xl mb-4">NOS MARQUES <span class="text-gradient">PARTENAIRES</span></h2>
            <p class="text-white/60 max-w-2xl mx-auto">Des pièces d'origine et de qualité équivalente pour les plus grandes marques automobiles.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @php
                $defaultBrands = ['Mercedes-Benz', 'Toyota', 'BMW', 'Audi', 'Volkswagen', 'Peugeot'];
            @endphp

            @forelse($brands as $brand)
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 flex items-center justify-center hover:border-brand-500/50 hover:bg-white/10 transition-all duration-300 cursor-pointer group">
                    <span class="text-xl font-semibold text-white/70 group-hover:text-brand-500 transition">{{ $brand->name }}</span>
                </div>
            @empty
                @foreach($defaultBrands as $brandName)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 flex items-center justify-center hover:border-brand-500/50 hover:bg-white/10 transition-all duration-300 cursor-pointer group">
                        <span class="text-lg font-semibold text-white/70 group-hover:text-brand-500 transition">{{ $brandName }}</span>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-24 bg-dark-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
            <div>
                <h2 class="font-display text-5xl mb-4">PRODUITS <span class="text-gradient">POPULAIRES</span></h2>
                <p class="text-white/60">Les pièces les plus recherchées par nos clients professionnels.</p>
            </div>
            <a href="{{ route('catalog') }}" class="inline-flex items-center space-x-2 text-brand-500 hover:text-brand-400 font-semibold transition group">
                <span>Voir le catalogue complet</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredArticles as $article)
                <div class="bg-dark-800 border border-white/10 rounded-3xl overflow-hidden card-glow transition-all duration-500 group">
                    <div class="h-56 bg-gradient-to-br from-white/5 to-white/10 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-800 via-transparent to-transparent"></div>
                        <svg class="w-24 h-24 text-white/20 group-hover:text-brand-500/30 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.14 12.94c.04-.31.06-.63.06-.94 0-.31-.02-.63-.06-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="text-xs bg-brand-500/20 text-brand-400 px-3 py-1 rounded-full">{{ $article->brand->name }}</span>
                            <span class="text-xs bg-white/10 text-white/60 px-3 py-1 rounded-full">{{ $article->category->name }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-brand-500 transition">{{ $article->name }}</h3>
                        <p class="text-white/50 text-sm mb-4">Réf: {{ $article->reference }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-brand-500">{{ number_format($article->sale_price, 2, ',', ' ') }}</span>
                                <span class="text-white/50 text-sm ml-1">MAD</span>
                            </div>
                            <a href="{{ route('article.show', $article->slug) }}" class="bg-white/10 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl font-medium transition">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Demo Products -->
                @php
                    $demoProducts = [
                        ['name' => 'Filtre à huile', 'brand' => 'Mercedes', 'cat' => 'Filtration', 'ref' => 'MER-FL-001', 'price' => 2450],
                        ['name' => 'Plaquettes de frein avant', 'brand' => 'Toyota', 'cat' => 'Freinage', 'ref' => 'TOY-PF-042', 'price' => 8900],
                        ['name' => 'Courroie de distribution', 'brand' => 'BMW', 'cat' => 'Distribution', 'ref' => 'BMW-CD-156', 'price' => 15600],
                    ];
                @endphp
                @foreach($demoProducts as $product)
                    <div class="bg-dark-800 border border-white/10 rounded-3xl overflow-hidden card-glow transition-all duration-500 group">
                        <div class="h-56 bg-gradient-to-br from-white/5 to-white/10 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark-800 via-transparent to-transparent"></div>
                            <svg class="w-24 h-24 text-white/20 group-hover:text-brand-500/30 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.14 12.94c.04-.31.06-.63.06-.94 0-.31-.02-.63-.06-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58z"/>
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="text-xs bg-brand-500/20 text-brand-400 px-3 py-1 rounded-full">{{ $product['brand'] }}</span>
                                <span class="text-xs bg-white/10 text-white/60 px-3 py-1 rounded-full">{{ $product['cat'] }}</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 group-hover:text-brand-500 transition">{{ $product['name'] }}</h3>
                            <p class="text-white/50 text-sm mb-4">Réf: {{ $product['ref'] }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-brand-500">{{ number_format($product['price'], 2, ',', ' ') }}</span>
                                    <span class="text-white/50 text-sm ml-1">MAD</span>
                                </div>
                                <button class="bg-white/10 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl font-medium transition">
                                    Détails
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-r from-brand-600 via-brand-500 to-brand-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white rounded-full"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white rounded-full"></div>
    </div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="font-display text-5xl md:text-6xl mb-6 text-white">VOUS ÊTES PROFESSIONNEL ?</h2>
        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
            Accédez à des tarifs préférentiels, un suivi personnalisé et une livraison express pour votre garage.
        </p>
        <a href="{{ route('login') }}" class="inline-flex items-center space-x-3 bg-dark-900 hover:bg-dark-800 text-white px-10 py-4 rounded-2xl font-semibold text-lg transition shadow-2xl">
            <span>Créer un compte professionnel</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-24 bg-dark-800">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <h2 class="font-display text-5xl mb-6">CONTACTEZ-<span class="text-gradient">NOUS</span></h2>
                <p class="text-white/60 text-lg mb-10 leading-relaxed">
                    Une question ? Un besoin spécifique ? Notre équipe est disponible pour vous accompagner dans la recherche de vos pièces.
                </p>

                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-brand-500/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white/40 text-sm">Adresse</div>
                            <div class="text-white font-medium">Zone Industrielle, Alger, Algérie</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-brand-500/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white/40 text-sm">Téléphone</div>
                            <div class="text-white font-medium">+213 XX XX XX XX</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-brand-500/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white/40 text-sm">Horaires</div>
                            <div class="text-white font-medium">Dim - Jeu: 8h00 - 17h00</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-dark-900 border border-white/10 rounded-3xl p-8">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Nom complet</label>
                            <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-brand-500 focus:outline-none transition" placeholder="Votre nom">
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Email</label>
                            <input type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-brand-500 focus:outline-none transition" placeholder="votre@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-white/60 text-sm mb-2">Sujet</label>
                        <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-brand-500 focus:outline-none transition" placeholder="Demande de devis, question...">
                    </div>
                    <div>
                        <label class="block text-white/60 text-sm mb-2">Message</label>
                        <textarea rows="5" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:border-brand-500 focus:outline-none transition resize-none" placeholder="Décrivez votre besoin..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white py-4 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
