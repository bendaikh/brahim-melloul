<div class="section-form">
    <h2>Ajouter une nouvelle Catégorie</h2>
    
    <form method="POST" action="{{ route('admin.parametres.categories.store') }}">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">
                @error('name')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="parent_id">Catégorie Parent</label>
                <select id="parent_id" name="parent_id">
                    <option value="">-- Aucune (Catégorie principale) --</option>
                    @foreach(\App\Models\Category::whereNull('parent_id')->get() as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter la catégorie
            </button>
            <button type="button" class="btn btn-secondary" onclick="app.showDashboardCards()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </form>

    <div class="section-tabs">
        <button class="section-tab active" onclick="app.loadModule('categories', 'Catégories')">
            <i class="fas fa-plus"></i> Nouveau
        </button>
        <button class="section-tab" onclick="app.getModuleList('categories')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>
</div>
