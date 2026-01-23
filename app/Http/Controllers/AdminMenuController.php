<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get static parent menus that have children (Profil, Informasi)
        $staticMenus = Menu::with(['children.page', 'page'])
            ->whereNull('parent_id')
            ->whereIn('slug', ['profil', 'informasi'])
            ->ordered()
            ->get();
        
        // Get dynamic parent menus only
        $dynamicMenus = Menu::with(['children.page', 'page'])
            ->excludeStatic()
            ->whereNull('parent_id')
            ->ordered()
            ->get();
            
        return view('admin.menu.index', compact('staticMenus', 'dynamicMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Get all parent menus (static parent_with_sub + dynamic menus)
        $staticParents = Menu::whereNull('parent_id')
            ->where('type', 'parent_with_sub')
            ->whereIn('slug', ['profil', 'informasi'])
            ->ordered()
            ->get();
        
        $dynamicParents = Menu::whereNull('parent_id')
            ->excludeStatic()
            ->ordered()
            ->get();
        
        $parentMenus = $staticParents->concat($dynamicParents);
        $selectedParentId = $request->get('parent_id');
        
        return view('admin.menu.create', compact('parentMenus', 'selectedParentId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get link_type to adjust validation
        $linkType = $request->input('link_type', 'internal');
        
        // Auto-create parent menu jika belum ada (untuk menu statis: profil, informasi)
        $isSubmenuForStaticParent = false;
        if ($request->filled('auto_create_parent') && $request->auto_create_parent == '1') {
            $parentSlug = $request->parent_slug;
            $parentTitle = $request->parent_title;
            $parentUrl = $request->parent_url;
            $parentOrder = $request->parent_order ?? 0;
            
            // Cek apakah parent sudah ada
            $parentMenu = Menu::where('slug', $parentSlug)->first();
            
            if (!$parentMenu) {
                // Buat parent menu baru
                $parentMenu = Menu::create([
                    'title' => $parentTitle,
                    'slug' => $parentSlug,
                    'url' => $parentUrl,
                    'type' => 'parent_with_sub',
                    'target' => '_self',
                    'order' => $parentOrder,
                    'position' => 'header',
                    'is_active' => true,
                    'parent_id' => null
                ]);
            }
            
            // Set parent_id untuk submenu
            $request->merge(['parent_id' => $parentMenu->id]);
            $isSubmenuForStaticParent = true;
        } elseif ($request->filled('parent_id')) {
            $parentMenu = Menu::find($request->parent_id);
            if ($parentMenu && in_array($parentMenu->slug, ['profil', 'informasi'])) {
                $isSubmenuForStaticParent = true;
            }
        }
        
        // Base validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug',
            'type' => 'required|in:parent_only,parent_with_sub',
            'target' => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:menus,id',
            'icon' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'position' => 'required|in:header,footer,sidebar',
            'link_type' => 'nullable|in:internal,external',
            'is_active' => 'boolean'
        ];
        
        // URL is required for external links
        if ($linkType === 'external') {
            $rules['url'] = 'required|string|max:255|url';
        } else {
            $rules['url'] = 'nullable|string|max:255';
        }
        
        // If submenu for static parent, must be parent_only type
        if ($isSubmenuForStaticParent && $request->type !== 'parent_only') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Submenu untuk menu statis harus bertipe "Parent Only"');
        }
        
        $messages = [
            'slug.unique' => 'Slug "' . $request->slug . '" sudah digunakan oleh menu lain. Silakan gunakan judul yang berbeda atau ubah slug secara manual.'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal: ' . $validator->errors()->first());
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Handle based on link type
        if ($linkType === 'external') {
            // External link: use provided URL, no page creation
            unset($data['create_page']);
        } else {
            // Internal link: auto-set URL from slug
            $data['url'] = '/' . $request->slug;
        }

        try {
            $menu = Menu::create($data);

            // Create associated page automatically for:
            // 1. Submenu (yang punya parent_id) dengan link internal, atau
            // 2. Menu biasa dengan create_page checkbox = 1
            $shouldCreatePage = false;
            
            if ($linkType === 'internal' && $menu->type === 'parent_only') {
                if ($menu->parent_id) {
                    // Submenu: otomatis buat halaman
                    $shouldCreatePage = true;
                } elseif ($request->input('create_page') == '1') {
                    // Menu parent/single: buat halaman jika checkbox dicentang
                    $shouldCreatePage = true;
                }
            }
            
            if ($shouldCreatePage) {
                Page::create([
                    'menu_id' => $menu->id,
                    'title' => $menu->title,
                    'slug' => $menu->slug,
                    'content' => '<p>Konten untuk halaman ' . $menu->title . '</p>',
                    'is_active' => true
                ]);
            }

            $successMessage = $isSubmenuForStaticParent 
                ? 'Submenu "' . $menu->title . '" berhasil ditambahkan ke menu ' . $parentMenu->title . '!'
                : 'Menu "' . $menu->title . '" berhasil ditambahkan!';

            return redirect()->route('menu.index')
                ->with('success', $successMessage);
                
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle duplicate entry error
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Slug "' . $request->slug . '" sudah digunakan! Silakan gunakan slug yang berbeda.');
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan menu: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->excludeStatic()
            ->where('id', '!=', $menu->id)
            ->ordered()
            ->get();
        
        return view('admin.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug,' . $menu->id,
            'url' => 'nullable|string|max:255',
            'type' => 'required|in:parent_only,parent_with_sub',
            'target' => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:menus,id',
            'icon' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'position' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean'
        ], [
            'slug.unique' => 'Slug "' . $request->slug . '" sudah digunakan oleh menu lain. Silakan gunakan judul yang berbeda.'
        ]);

        // Auto-generate slug from title if not provided
        if (!$request->has('slug') || empty($request->slug)) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal: ' . $validator->errors()->first());
        }

        $data = $request->only(['title', 'slug', 'url', 'type', 'target', 'parent_id', 'icon', 'order', 'position']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            $menu->update($data);
            return redirect()->route('menu.index')
                ->with('success', 'Menu "' . $menu->title . '" berhasil diupdate!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Slug "' . $request->slug . '" sudah digunakan! Silakan gunakan judul yang berbeda.');
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal update menu: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menuTitle = $menu->title;
        
        // Prevent deletion of static menus
        $staticSlugs = ['beranda', 'profil', 'informasi',
                        'sambutan', 'profil-puskesmas', 'visi-misi', 'struktur-organisasi',
                        'berita', 'pengumuman', 'agenda', 'galeri'];
        
        if (in_array($menu->slug, $staticSlugs)) {
            return redirect()->back()
                ->with('error', 'Menu "' . $menuTitle . '" adalah menu statis dan tidak bisa dihapus!');
        }
        
        try {
            // Check if menu has children
            if ($menu->children()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Menu "' . $menuTitle . '" tidak bisa dihapus karena memiliki submenu!');
            }
            
            $menu->delete();
            
            return redirect()->route('menu.index')
                ->with('success', 'Menu "' . $menuTitle . '" berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }

    /**
     * Update menu order via AJAX.
     */
    public function reorder(Request $request)
    {
        $items = $request->input('items', []);

        foreach ($items as $item) {
            Menu::where('id', $item['id'])->update([
                'order' => $item['order'],
                'parent_id' => $item['parent_id'] ?? null
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan menu berhasil diupdate!']);
    }

    /**
     * Toggle menu status via AJAX.
     */
    public function toggleStatus(Menu $menu)
    {
        $menu->is_active = !$menu->is_active;
        $menu->save();

        return response()->json([
            'success' => true,
            'is_active' => $menu->is_active,
            'message' => 'Status menu berhasil diubah!'
        ]);
    }

    /**
     * Generate slug for menu.
     */
    public function slug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['slug' => $slug]);
    }
}
