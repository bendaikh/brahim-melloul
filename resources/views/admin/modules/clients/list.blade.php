<div class="section-list" style="padding: 20px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Liste des Clients</h2>
        <button class="btn btn-primary" onclick="app.loadModule('clients', 'Clients')" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-plus"></i> Nouveau Client
        </button>
    </div>

    @if($items->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e0e0e0; background: #f5f5f5;">
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Nom Client</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Numéro</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Téléphone</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Ville</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Région</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Représentant</th>
                    <th style="text-align: right; padding: 12px; font-weight: 600; color: #333;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $client)
                <tr style="border-bottom: 1px solid #e0e0e0;">
                    <td style="padding: 12px; color: #333; font-weight: 500;">{{ $client->nom_client }}</td>
                    <td style="padding: 12px; color: #666;">{{ $client->numero_client }}</td>
                    <td style="padding: 12px; color: #666;">{{ $client->telephone ?? '-' }}</td>
                    <td style="padding: 12px; color: #666;">{{ $client->ville ?? '-' }}</td>
                    <td style="padding: 12px; color: #666;">{{ $client->region ?? '-' }}</td>
                    <td style="padding: 12px; color: #666;">{{ $client->representant->name ?? '-' }}</td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.clients.edit', $client) }}" style="display: inline-block; padding: 6px 12px; background: #e3f2fd; color: #1976d2; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 4px;">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Êtes-vous sûr ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 6px 12px; background: #ffebee; color: #d32f2f; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
    <div style="margin-top: 20px; display: flex; justify-content: center; gap: 8px;">
        {{ $items->links() }}
    </div>
    @endif

    @else
    <div style="text-align: center; padding: 40px; color: #999;">
        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
        <p>Aucun client trouvé</p>
        <button class="btn btn-primary" onclick="app.loadModule('clients', 'Clients')" style="margin-top: 16px;">
            <i class="fas fa-plus"></i> Créer un client
        </button>
    </div>
    @endif
</div>
