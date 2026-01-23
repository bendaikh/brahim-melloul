<div class="section-form">
    <h2>Ajouter une nouvelle Marque</h2>
    
    <form method="POST" action="{{ route('admin.parametres.marques.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Nom de la Marque</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}">
            @error('name')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter la marque
            </button>
            <button type="button" class="btn btn-secondary" onclick="app.showDashboardCards()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </form>

    <div class="section-tabs">
        <button class="section-tab active" onclick="app.loadModule('brands', 'Marques')">
            <i class="fas fa-plus"></i> Nouveau
        </button>
        <button class="section-tab" onclick="app.getModuleList('brands')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>
</div>
