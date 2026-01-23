<div class="section-form">
    <h2>Ajouter un nouvel Article</h2>
    
    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="code">Code Article</label>
                <input type="text" id="code" name="code" required value="{{ old('code') }}">
                @error('code')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="designation">Désignation</label>
                <input type="text" id="designation" name="designation" required value="{{ old('designation') }}">
                @error('designation')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="brand_id">Marque</label>
                <select id="brand_id" name="brand_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach(\App\Models\Brand::all() as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input type="number" id="price" name="price" step="0.01" required value="{{ old('price') }}">
                @error('price')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="quantity">Quantité</label>
                <input type="number" id="quantity" name="quantity" required value="{{ old('quantity') }}">
                @error('quantity')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter l'article
            </button>
            <button type="button" class="btn btn-secondary" onclick="app.showDashboardCards()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </form>

    <div class="section-tabs">
        <button class="section-tab active" onclick="app.loadModule('articles', 'Articles')">
            <i class="fas fa-plus"></i> Nouveau
        </button>
        <button class="section-tab" onclick="app.getModuleList('articles')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>
</div>
