<div class="section-form">
    <h2>Ajouter un nouveau Commercial</h2>
    
    <form method="POST" action="{{ route('admin.representants.store') }}">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">
                @error('name')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
                @error('email')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                @error('phone')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}">
                @error('address')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter le commercial
            </button>
            <button type="button" class="btn btn-secondary" onclick="app.showDashboardCards()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </form>

    <div class="section-tabs">
        <button class="section-tab active" onclick="app.loadModule('representants', 'Commerciaux')">
            <i class="fas fa-plus"></i> Nouveau
        </button>
        <button class="section-tab" onclick="app.getModuleList('representants')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>
</div>
