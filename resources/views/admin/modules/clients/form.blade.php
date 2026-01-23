<div class="section-form">
    <h2>Ajouter un nouveau Client</h2>
    
    <form method="POST" action="{{ route('admin.clients.store') }}">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="nom_client">Nom du Client</label>
                <input type="text" id="nom_client" name="nom_client" required value="{{ old('nom_client') }}">
                @error('nom_client')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="numero_client">Numéro Client</label>
                <input type="text" id="numero_client" name="numero_client" required value="{{ old('numero_client') }}">
                @error('numero_client')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}">
                @error('telephone')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="representant_id">Commercial</label>
                <select id="representant_id" name="representant_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach(\App\Models\Representant::all() as $rep)
                        <option value="{{ $rep->id }}" {{ old('representant_id') == $rep->id ? 'selected' : '' }}>
                            {{ $rep->name }}
                        </option>
                    @endforeach
                </select>
                @error('representant_id')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" value="{{ old('ville') }}">
                @error('ville')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="region">Région</label>
                <input type="text" id="region" name="region" value="{{ old('region') }}">
                @error('region')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="ice">ICE</label>
                <input type="text" id="ice" name="ice" value="{{ old('ice') }}">
                @error('ice')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">Adresse</label>
            <textarea id="address" name="address" rows="3">{{ old('address') }}</textarea>
            @error('address')<span style="color: red; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Ajouter le client
            </button>
            <button type="button" class="btn btn-secondary" onclick="app.showDashboardCards()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </form>

    <div class="section-tabs">
        <button class="section-tab active" onclick="app.loadModule('clients', 'Clients')">
            <i class="fas fa-plus"></i> Nouveau
        </button>
        <button class="section-tab" onclick="app.getModuleList('clients')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>
</div>
