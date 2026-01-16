@extends('admin.layouts.admin')

@section('title', 'Nouvelle marque')
@section('page-title', 'Nouvelle marque')
@section('page-description', 'Créer une nouvelle marque pour vos articles')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('admin.parametres.marques.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Créer une marque</h2>
                <p class="text-sm text-white/50">Remplissez les informations de la marque</p>
            </div>
        </div>

        <form action="{{ route('admin.parametres.marques.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white/70 mb-2">Nom de la marque <span class="text-red-400">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Ex: Bosch, NGK, etc.">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white/70 mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition resize-none"
                    placeholder="Description de la marque">{{ old('description') }}</textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-white/70 mb-2">Logo de la marque</label>
                <input type="file" name="logo" id="logo" accept="image/*" class="hidden" onchange="previewImage(this)">
                <label for="logo" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-brand-500/50 transition bg-white/5">
                    <div id="image-preview" class="hidden">
                        <img id="preview-img" src="" alt="Preview" class="max-h-40 object-contain">
                    </div>
                    <div id="upload-placeholder" class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-white/50 text-sm">Cliquez pour télécharger un logo</p>
                        <p class="text-white/30 text-xs mt-1">PNG, JPG, SVG jusqu'à 2MB</p>
                    </div>
                </label>
                @error('logo')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-white/10">
                <a href="{{ route('admin.parametres.marques.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
                    Annuler
                </a>
                <button type="submit" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Créer la marque</span>
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
</script>
@endsection
