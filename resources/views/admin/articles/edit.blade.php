@extends('admin.layouts.admin')

@section('title', 'Modifier l\'article')
@section('page-title', 'Modifier l\'article')
@section('page-description', 'Modifier les informations de l\'article')

@section('content')
<div class="max-w-4xl">
    <!-- Back Button -->
    <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
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
                <h2 class="text-lg font-semibold">Modifier: {{ $article->name }}</h2>
                <p class="text-sm text-white/50">Modifiez les informations ci-dessous</p>
            </div>
        </div>

        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Section: Informations de base -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-brand-500 uppercase tracking-wider">Informations de base</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="reference" class="block text-sm font-medium text-white/70 mb-2">Référence <span class="text-red-400">*</span></label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference', $article->reference) }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                            placeholder="Ex: REF-001">
                    </div>
                    <div>
                        <label for="code" class="block text-sm font-medium text-white/70 mb-2">Code</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $article->code) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                            placeholder="Code article">
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-white/70 mb-2">Nom de l'article <span class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $article->name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="Nom de l'article">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white/70 mb-2">Catégorie <span class="text-red-400">*</span></label>
                        <select name="category_id" id="category_id" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="car_logo_id" class="block text-sm font-medium text-white/70 mb-2">Logo de voiture</label>
                        <select name="car_logo_id" id="car_logo_id"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                            <option value="">Sélectionner une marque</option>
                            @foreach($carLogos as $carLogo)
                                <option value="{{ $carLogo->id }}" {{ old('car_logo_id', $article->car_logo_id) == $carLogo->id ? 'selected' : '' }}>
                                    {{ $carLogo->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="brand_id" class="block text-sm font-medium text-white/70 mb-2">Marque</label>
                        <select name="brand_id" id="brand_id"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                            <option value="">Sélectionner une marque</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $article->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section: Image -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-brand-500 uppercase tracking-wider">Image de l'article</h3>
                <div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-brand-500/50 transition bg-white/5">
                        <div id="image-preview" class="{{ $article->image ? '' : 'hidden' }}">
                            <img id="preview-img" src="{{ $article->image ? asset($article->image) : '' }}" alt="Preview" class="max-h-40 object-contain">
                        </div>
                        <div id="upload-placeholder" class="{{ $article->image ? 'hidden' : '' }} flex flex-col items-center">
                            <svg class="w-12 h-12 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-white/50 text-sm">Cliquez pour télécharger une image</p>
                            <p class="text-white/30 text-xs mt-1">PNG, JPG, GIF jusqu'à 2MB</p>
                        </div>
                    </label>
                </div>
                @if($article->image)
                    <p class="text-xs text-white/40">Image actuelle: {{ basename($article->image) }}</p>
                @endif
            </div>

            <!-- Section: Caractéristiques -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-brand-500 uppercase tracking-wider">Caractéristiques</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="classment" class="block text-sm font-medium text-white/70 mb-2">Classement</label>
                        <input type="text" name="classment" id="classment" value="{{ old('classment', $article->classment) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                            placeholder="Classement">
                    </div>
                    <div>
                        <label for="block" class="block text-sm font-medium text-white/70 mb-2">Block</label>
                        <input type="text" name="block" id="block" value="{{ old('block', $article->block) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                            placeholder="Block">
                    </div>
                    <div>
                        <label for="diametre" class="block text-sm font-medium text-white/70 mb-2">Diamètre</label>
                        <input type="text" name="diametre" id="diametre" value="{{ old('diametre', $article->diametre) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                            placeholder="Diamètre">
                    </div>
                </div>

                <div>
                    <label for="reference_equivalent" class="block text-sm font-medium text-white/70 mb-2">Référence équivalente</label>
                    <input type="text" name="reference_equivalent" id="reference_equivalent" value="{{ old('reference_equivalent', $article->reference_equivalent) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                        placeholder="Référence équivalente">
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-white/70">Désignations</label>
                        <button type="button" onclick="addDesignation()" class="flex items-center space-x-1 text-brand-500 hover:text-brand-400 transition text-sm font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Ajouter une désignation</span>
                        </button>
                    </div>
                    <div id="designations-container" class="space-y-3">
                        @php $designations = old('designations', $article->designation ?? []); @endphp
                        @if(empty($designations))
                            <div class="flex items-center gap-2">
                                <input type="text" name="designations[]" 
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                                    placeholder="Désignation de l'article">
                            </div>
                        @else
                            @foreach($designations as $des)
                                <div class="flex items-center gap-2">
                                    <input type="text" name="designations[]" value="{{ $des }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                                        placeholder="Désignation de l'article">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-500/10 rounded-xl transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section: Prix et Représentant -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-brand-500 uppercase tracking-wider">Prix et Représentant</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="prix_brut" class="block text-sm font-medium text-white/70 mb-2">Prix Brut</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="prix_brut" id="prix_brut" value="{{ old('prix_brut', $article->prix_brut) }}"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition pr-16"
                                placeholder="0.00" oninput="calculateNetPrice()">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">MAD</span>
                        </div>
                    </div>
                    <div>
                        <label for="remise" class="block text-sm font-medium text-white/70 mb-2">Remise (%)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="remise" id="remise" value="{{ old('remise', $article->remise) }}"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition pr-16"
                                placeholder="0.00" oninput="calculateNetPrice()">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">%</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="prix_net" class="block text-sm font-medium text-white/70 mb-2">Prix Net</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="prix_net" id="prix_net" value="{{ old('prix_net', $article->prix_net) }}"
                                class="w-full bg-white/10 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:outline-none transition pr-16"
                                placeholder="0.00" readonly>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">MAD</span>
                        </div>
                    </div>
                    <div>
                        <label for="prix_achat" class="block text-sm font-medium text-white/70 mb-2">Prix d'Achat</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="prix_achat" id="prix_achat" value="{{ old('prix_achat', $article->prix_achat) }}"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition pr-16"
                                placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">MAD</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="representant_prix" class="block text-sm font-medium text-white/70 mb-2">Prix Représentant</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="representant_prix" id="representant_prix" value="{{ old('representant_prix', $article->representant_prix) }}"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition pr-16"
                                placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40">MAD</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="representant_id" class="block text-sm font-medium text-white/70 mb-2">Représentant</label>
                    <select name="representant_id" id="representant_id"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-500 focus:outline-none transition">
                        <option value="">Sélectionner un représentant</option>
                        @foreach($representants as $representant)
                            <option value="{{ $representant->id }}" {{ old('representant_id', $article->representant_id) == $representant->id ? 'selected' : '' }}>
                                {{ $representant->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-white/10">
                <a href="{{ route('admin.articles.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
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

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const placeholder = document.getElementById('upload-placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addDesignation() {
    const container = document.getElementById('designations-container');
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <input type="text" name="designations[]" 
            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
            placeholder="Désignation de l'article">
        <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-500/10 rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function calculateNetPrice() {
    const brut = parseFloat(document.getElementById('prix_brut').value) || 0;
    const remise = parseFloat(document.getElementById('remise').value) || 0;
    const net = brut * (1 - remise / 100);
    document.getElementById('prix_net').value = net.toFixed(2);
}

// Calculate on load
document.addEventListener('DOMContentLoaded', calculateNetPrice);
</script>
@endsection
