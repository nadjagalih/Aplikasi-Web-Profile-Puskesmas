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
        $menus = Menu::with(['children.page', 'page'])
            ->excludeStatic()
            ->whereNull('parent_id')
            ->ordered()
            ->get();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->excludeStatic()
            ->ordered()
            ->get();
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
        
        // Base validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
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
        
        $validator = Validator::make($request->all(), $rules);

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
            // URL already set from form input
            // Remove create_page flag for external links
            unset($data['create_page']);
        } else {
            // Internal link: auto-set URL from slug
            $data['url'] = '/' . $request->slug;
        }

        try {
            $menu = Menu::create($data);

            // Create associated page only for internal links
            if ($linkType === 'internal' && $request->input('create_page') == '1' && $menu->type === 'parent_only') {
                Page::create([
                    'menu_id' => $menu->id,
                    'title' => $menu->title,
                    'slug' => $menu->slug,
                    'content' => '<p>Konten untuk halaman ' . $menu->title . '</p>',
                    'is_active' => true
                ]);
            }

            return redirect()->route('menu.index')
                ->with('success', 'Menu berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan menu: ' . $e->getMessage());
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
            'url' => 'nullable|string|max:255',
            'type' => 'required|in:parent_only,parent_with_sub',
            'target' => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:menus,id',
            'icon' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'position' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? true : false;

        $menu->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil dihapus!');
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
