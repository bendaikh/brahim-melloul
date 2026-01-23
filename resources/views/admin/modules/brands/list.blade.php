<div class="section-list" style="padding: 20px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Liste des Marques</h2>
        <button class="btn btn-primary" onclick="app.loadModule('brands', 'Marques')" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-plus"></i> Nouvelle Marque
        </button>
    </div>

    @if($items->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e0e0e0; background: #f5f5f5;">
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Nom</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Logo</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Description</th>
                    <th style="text-align: center; padding: 12px; font-weight: 600; color: #333;">Nombre d'Articles</th>
                    <th style="text-align: right; padding: 12px; font-weight: 600; color: #333;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $brand)
                <tr style="border-bottom: 1px solid #e0e0e0;">
                    <td style="padding: 12px; color: #333; font-weight: 500;">{{ $brand->name }}</td>
                    <td style="padding: 12px;">
                        @if($brand->logo)
                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" style="height: 40px; max-width: 100px; object-fit: contain;">
                        @else
                            <span style="color: #999;">-</span>
                        @endif
                    </td>
                    <td style="padding: 12px; color: #666; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $brand->description ?? '-' }}
                    </td>
                    <td style="padding: 12px; text-align: center; color: #666;">
                        <span style="display: inline-block; padding: 4px 8px; background: #f0f0f0; border-radius: 4px; font-weight: 600;">
                            {{ $brand->articles_count ?? 0 }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.parametres.marques.edit', $brand) }}" style="display: inline-block; padding: 6px 12px; background: #e3f2fd; color: #1976d2; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 4px;">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('admin.parametres.marques.destroy', $brand) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Êtes-vous sûr ?');">
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
        <p>Aucune marque trouvée</p>
        <button class="btn btn-primary" onclick="app.loadModule('brands', 'Marques')" style="margin-top: 16px;">
            <i class="fas fa-plus"></i> Créer une marque
        </button>
    </div>
    @endif
</div>
