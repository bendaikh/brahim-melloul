@extends('admin.layouts.admin')

@section('title', 'Nouveau logo de voiture')
@section('breadcrumb-title', 'Logos Voitures')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <a href="{{ route('admin.parametres.car-logos.index') }}" class="inline-flex items-center space-x-2 text-white/60 hover:text-white mb-6 transition">
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
                <h2 class="text-lg font-semibold">Ajouter un logo</h2>
                <p class="text-sm text-white/50">Remplissez les informations ci-dessous</p>
            </div>
        </div>

        <form action="{{ route('admin.parametres.car-logos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white/70 mb-2">Nom de la marque <span class="text-red-400">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:border-brand-500 focus:outline-none transition"
                    placeholder="Ex: Mercedes, Toyota, BMW...">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-white/70 mb-2">Logo (Image)</label>
                <div class="relative">
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-brand-500/50 transition bg-white/5">
                        <div id="image-preview" class="hidden">
                            <img id="preview-img" src="" alt="Preview" class="max-h-40 object-contain">
                        </div>
                        <div id="upload-placeholder" class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-white/50 text-sm">Cliquez pour télécharger une image</p>
                            <p class="text-white/30 text-xs mt-1">PNG, JPG, GIF, SVG jusqu'à 2MB</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                    class="w-5 h-5 rounded bg-white/5 border-white/20 text-brand-500 focus:ring-brand-500 focus:ring-offset-0">
                <label for="is_active" class="text-sm font-medium text-white/70">Logo actif</label>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-white/10">
                <a href="{{ route('admin.parametres.car-logos.index') }}" class="px-6 py-2.5 rounded-xl text-white/70 hover:text-white transition">
                    Annuler
                </a>
                <button type="submit" class="flex items-center space-x-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-brand-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Ajouter le logo</span>
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
