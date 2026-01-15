<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\CarLogo;
use App\Models\Representant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'articles_count' => Article::count(),
            'categories_count' => Category::count(),
            'car_logos_count' => CarLogo::count(),
            'representants_count' => Representant::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    // ==================== CATEGORIES ====================
    public function categoriesIndex()
    {
        $categories = Category::withCount('articles')->orderBy('name')->get();
        return view('admin.parametres.categories.index', compact('categories'));
    }

    public function categoriesCreate()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.parametres.categories.create', compact('parentCategories'));
    }

    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.parametres.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function categoriesEdit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();
        return view('admin.parametres.categories.edit', compact('category', 'parentCategories'));
    }

    public function categoriesUpdate(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.parametres.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function categoriesDestroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.parametres.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    // ==================== CAR LOGOS ====================
    public function carLogosIndex()
    {
        $carLogos = CarLogo::withCount('articles')->orderBy('name')->get();
        return view('admin.parametres.car-logos.index', compact('carLogos'));
    }

    public function carLogosCreate()
    {
        return view('admin.parametres.car-logos.create');
    }

    public function carLogosStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->name) . '-' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/car-logos'), $imageName);
            $data['image'] = 'uploads/car-logos/' . $imageName;
        }

        CarLogo::create($data);

        return redirect()->route('admin.parametres.car-logos.index')
            ->with('success', 'Logo de voiture créé avec succès.');
    }

    public function carLogosEdit(CarLogo $carLogo)
    {
        return view('admin.parametres.car-logos.edit', compact('carLogo'));
    }

    public function carLogosUpdate(Request $request, CarLogo $carLogo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($carLogo->image && file_exists(public_path($carLogo->image))) {
                unlink(public_path($carLogo->image));
            }
            
            $image = $request->file('image');
            $imageName = Str::slug($request->name) . '-' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/car-logos'), $imageName);
            $data['image'] = 'uploads/car-logos/' . $imageName;
        }

        $carLogo->update($data);

        return redirect()->route('admin.parametres.car-logos.index')
            ->with('success', 'Logo de voiture mis à jour avec succès.');
    }

    public function carLogosDestroy(CarLogo $carLogo)
    {
        if ($carLogo->image && file_exists(public_path($carLogo->image))) {
            unlink(public_path($carLogo->image));
        }
        $carLogo->delete();
        
        return redirect()->route('admin.parametres.car-logos.index')
            ->with('success', 'Logo de voiture supprimé avec succès.');
    }

    // ==================== ARTICLES ====================
    public function articlesIndex()
    {
        $articles = Article::with(['category', 'carLogo', 'representant'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function articlesCreate()
    {
        $categories = Category::orderBy('name')->get();
        $carLogos = CarLogo::where('is_active', true)->orderBy('name')->get();
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.articles.create', compact('categories', 'carLogos', 'representants'));
    }

    public function articlesStore(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:articles',
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'car_logo_id' => 'nullable|exists:car_logos,id',
            'representant_id' => 'nullable|exists:representants,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classment' => 'nullable|string|max:255',
            'prix_brut' => 'nullable|numeric|min:0',
            'block' => 'nullable|string|max:255',
            'diametre' => 'nullable|string|max:255',
            'representant_prix' => 'nullable|numeric|min:0',
            'reference_equivalent' => 'nullable|string|max:255',
            'designation' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name . '-' . $request->reference);
        $data['is_active'] = true;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->reference) . '-' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/articles'), $imageName);
            $data['image'] = 'uploads/articles/' . $imageName;
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function articlesEdit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        $carLogos = CarLogo::where('is_active', true)->orderBy('name')->get();
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.articles.edit', compact('article', 'categories', 'carLogos', 'representants'));
    }

    public function articlesUpdate(Request $request, Article $article)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:articles,reference,' . $article->id,
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'car_logo_id' => 'nullable|exists:car_logos,id',
            'representant_id' => 'nullable|exists:representants,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classment' => 'nullable|string|max:255',
            'prix_brut' => 'nullable|numeric|min:0',
            'block' => 'nullable|string|max:255',
            'diametre' => 'nullable|string|max:255',
            'representant_prix' => 'nullable|numeric|min:0',
            'reference_equivalent' => 'nullable|string|max:255',
            'designation' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name . '-' . $request->reference);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }
            
            $image = $request->file('image');
            $imageName = Str::slug($request->reference) . '-' . time() . '.' . $image->extension();
            $image->move(public_path('uploads/articles'), $imageName);
            $data['image'] = 'uploads/articles/' . $imageName;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function articlesDestroy(Article $article)
    {
        if ($article->image && file_exists(public_path($article->image))) {
            unlink(public_path($article->image));
        }
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }

    // ==================== REPRESENTANTS ====================
    public function representantsIndex()
    {
        $representants = Representant::withCount('articles')->orderBy('name')->get();
        return view('admin.representants.index', compact('representants'));
    }

    public function representantsCreate()
    {
        return view('admin.representants.create');
    }

    public function representantsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        Representant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'commission_rate' => $request->commission_rate ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.representants.index')
            ->with('success', 'Représentant créé avec succès.');
    }

    public function representantsEdit(Representant $representant)
    {
        return view('admin.representants.edit', compact('representant'));
    }

    public function representantsUpdate(Request $request, Representant $representant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        $representant->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'commission_rate' => $request->commission_rate ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.representants.index')
            ->with('success', 'Représentant mis à jour avec succès.');
    }

    public function representantsDestroy(Representant $representant)
    {
        $representant->delete();
        return redirect()->route('admin.representants.index')
            ->with('success', 'Représentant supprimé avec succès.');
    }
}
