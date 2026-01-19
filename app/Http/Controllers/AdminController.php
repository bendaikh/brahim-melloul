<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CarLogo;
use App\Models\Representant;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'articles_count' => Article::count(),
            'categories_count' => Category::count(),
            'brands_count' => Brand::count(),
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

    // ==================== BRANDS (MARQUES) ====================
    public function brandsIndex()
    {
        $brands = Brand::withCount('articles')->orderBy('name')->get();
        return view('admin.parametres.marques.index', compact('brands'));
    }

    public function brandsCreate()
    {
        return view('admin.parametres.marques.create');
    }

    public function brandsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = Str::slug($request->name) . '-' . time() . '.' . $logo->extension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $data['logo'] = 'uploads/brands/' . $logoName;
        }

        Brand::create($data);

        return redirect()->route('admin.parametres.marques.index')
            ->with('success', 'Marque créée avec succès.');
    }

    public function brandsEdit(Brand $brand)
    {
        return view('admin.parametres.marques.edit', compact('brand'));
    }

    public function brandsUpdate(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ];

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }
            
            $logo = $request->file('logo');
            $logoName = Str::slug($request->name) . '-' . time() . '.' . $logo->extension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $data['logo'] = 'uploads/brands/' . $logoName;
        }

        $brand->update($data);

        return redirect()->route('admin.parametres.marques.index')
            ->with('success', 'Marque mise à jour avec succès.');
    }

    public function brandsDestroy(Brand $brand)
    {
        if ($brand->logo && file_exists(public_path($brand->logo))) {
            unlink(public_path($brand->logo));
        }
        $brand->delete();
        
        return redirect()->route('admin.parametres.marques.index')
            ->with('success', 'Marque supprimée avec succès.');
    }

    // ==================== ARTICLES ====================
    public function articlesIndex()
    {
        $articles = Article::with(['category', 'brand', 'carLogo', 'representant'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function articlesCreate()
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $carLogos = CarLogo::where('is_active', true)->orderBy('name')->get();
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.articles.create', compact('categories', 'brands', 'carLogos', 'representants'));
    }

    public function articlesStore(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:articles',
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'car_logo_id' => 'nullable|exists:car_logos,id',
            'representant_id' => 'nullable|exists:representants,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classment' => 'nullable|string|max:255',
            'prix_brut' => 'nullable|numeric|min:0',
            'remise' => 'nullable|numeric|min:0|max:100',
            'prix_net' => 'nullable|numeric|min:0',
            'prix_achat' => 'nullable|numeric|min:0',
            'block' => 'nullable|string|max:255',
            'diametre' => 'nullable|string|max:255',
            'representant_prix' => 'nullable|numeric|min:0',
            'reference_equivalent' => 'nullable|string|max:255',
            'designations' => 'nullable|array',
            'designations.*' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'designations']);
        $data['designation'] = array_filter($request->designations ?? []);
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
        $brands = Brand::orderBy('name')->get();
        $carLogos = CarLogo::where('is_active', true)->orderBy('name')->get();
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.articles.edit', compact('article', 'categories', 'brands', 'carLogos', 'representants'));
    }

    public function articlesUpdate(Request $request, Article $article)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:articles,reference,' . $article->id,
            'code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'car_logo_id' => 'nullable|exists:car_logos,id',
            'representant_id' => 'nullable|exists:representants,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classment' => 'nullable|string|max:255',
            'prix_brut' => 'nullable|numeric|min:0',
            'remise' => 'nullable|numeric|min:0|max:100',
            'prix_net' => 'nullable|numeric|min:0',
            'prix_achat' => 'nullable|numeric|min:0',
            'block' => 'nullable|string|max:255',
            'diametre' => 'nullable|string|max:255',
            'representant_prix' => 'nullable|numeric|min:0',
            'reference_equivalent' => 'nullable|string|max:255',
            'designations' => 'nullable|array',
            'designations.*' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'designations']);
        $data['designation'] = array_filter($request->designations ?? []);
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

    // ==================== CLIENTS ====================
    public function clientsIndex()
    {
        $clients = Client::with('representant')->orderBy('nom_client')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function clientsCreate()
    {
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        return view('admin.clients.create', compact('representants'));
    }

    public function clientsStore(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'numero_client' => 'required|string|max:255|unique:clients',
            'telephone' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'representant_id' => 'nullable|exists:representants,id',
            'ice' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        Client::create([
            'nom_client' => $request->nom_client,
            'numero_client' => $request->numero_client,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'region' => $request->region,
            'representant_id' => $request->representant_id,
            'ice' => $request->ice,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client créé avec succès.');
    }

    public function clientsEdit(Client $client)
    {
        $representants = Representant::where('is_active', true)->orderBy('name')->get();
        return view('admin.clients.edit', compact('client', 'representants'));
    }

    public function clientsUpdate(Request $request, Client $client)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'numero_client' => 'required|string|max:255|unique:clients,numero_client,' . $client->id,
            'telephone' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'representant_id' => 'nullable|exists:representants,id',
            'ice' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $client->update([
            'nom_client' => $request->nom_client,
            'numero_client' => $request->numero_client,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'region' => $request->region,
            'representant_id' => $request->representant_id,
            'ice' => $request->ice,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    public function clientsDestroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
