<div class="section-list" style="padding: 20px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Liste des Articles</h2>
        <button class="btn btn-primary" onclick="app.loadModule('articles', 'Articles')" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-plus"></i> Nouvel Article
        </button>
    </div>

    @if($items->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e0e0e0; background: #f5f5f5;">
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Article</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Référence</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Catégorie</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Marque</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Prix Brut</th>
                    <th style="text-align: left; padding: 12px; font-weight: 600; color: #333;">Représentant</th>
                    <th style="text-align: right; padding: 12px; font-weight: 600; color: #333;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $article)
                <tr style="border-bottom: 1px solid #e0e0e0; transition: background 0.2s;">
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" alt="{{ $article->name }}" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                            @else
                                <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="color: #999; font-size: 16px;"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $article->name }}</strong>
                                @if($article->code)
                                    <div style="font-size: 12px; color: #999;">Code: {{ $article->code }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px; color: #666;">{{ $article->reference }}</td>
                    <td style="padding: 12px; color: #666;">{{ $article->category->name ?? '-' }}</td>
                    <td style="padding: 12px; color: #666;">
                        @if($article->brand)
                            <div style="display: flex; align-items: center; gap: 6px;">
                                @if($article->brand->logo)
                                    <img src="{{ asset($article->brand->logo) }}" alt="{{ $article->brand->name }}" style="width: 24px; height: 24px; object-fit: contain;">
                                @endif
                                {{ $article->brand->name }}
                            </div>
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding: 12px; color: #666; font-weight: 600;">
                        {{ number_format($article->prix_brut, 2, ',', ' ') }} MAD
                    </td>
                    <td style="padding: 12px; color: #666;">{{ $article->representant->name ?? '-' }}</td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.articles.edit', $article) }}" style="display: inline-block; padding: 6px 12px; background: #e3f2fd; color: #1976d2; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 4px;">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Êtes-vous sûr ?');">
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
        <p>Aucun article trouvé</p>
        <button class="btn btn-primary" onclick="app.loadModule('articles', 'Articles')" style="margin-top: 16px;">
            <i class="fas fa-plus"></i> Créer un article
        </button>
    </div>
    @endif
</div>
