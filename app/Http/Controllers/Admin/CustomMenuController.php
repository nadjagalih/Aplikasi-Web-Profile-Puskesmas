<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CustomMenuController extends Controller
{
    /**
     * Display a listing of the custom menus.
     */
    public function index()
    {
        $menus = CustomMenu::with('parent', 'children')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();
        
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new custom menu.
     */
    public function create()
    {
        $parentMenus = CustomMenu::whereNull('parent_id')
            ->orderBy('order')
            ->get();
        
        return view('admin.menu.create', compact('parentMenus'));
    }

    /**
     * Store a newly created custom menu in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_slug' => 'nullable|in:profil,informasi',
            'parent_id' => 'nullable|exists:custom_menus,id',
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'type' => 'required|in:internal,external',
            'icon' => 'nullable|max:100',
            'order' => 'required|integer|min:0',
        ]);

        // Auto generate slug from title
        $validated['slug'] = Str::slug($validated['title']);
        
        // Auto set target based on type
        $validated['target'] = $validated['type'] === 'external' ? '_blank' : '_self';
        
        // Set is_active (checkbox returns null when unchecked)
        $validated['is_active'] = $request->has('is_active') ? true : false;
        
        // If parent_slug is empty string, set to null
        if (empty($validated['parent_slug'])) {
            $validated['parent_slug'] = null;
        }
        
        // If parent_id is empty, set to null
        if (empty($validated['parent_id'])) {
            $validated['parent_id'] = null;
        }

        $customMenu = CustomMenu::create($validated);

        // Auto create page for internal type menus
        if ($validated['type'] === 'internal') {
            // Check if page doesn't exist yet
            $pageExists = \App\Models\Page::where('slug', $validated['slug'])->exists();
            
            if (!$pageExists) {
                \App\Models\Page::create([
                    'title' => $validated['title'],
                    'slug' => $validated['slug'],
                    'content' => '<p>Konten untuk halaman ' . $validated['title'] . '</p>',
                    'is_published' => true,
                    'meta_description' => $validated['title'],
                ]);
            }
        }

        return redirect()->route('menu.index')
            ->with('success', 'Menu custom berhasil ditambahkan!' . ($validated['type'] === 'internal' ? ' Halaman otomatis dibuat.' : ''));
    }

    /**
     * Show the form for editing the specified custom menu.
     */
    public function edit(CustomMenu $customMenu)
    {
        $parentMenus = CustomMenu::whereNull('parent_id')
            ->where('id', '!=', $customMenu->id)
            ->orderBy('order')
            ->get();
        
        return view('admin.custom-menus.edit', compact('customMenu', 'parentMenus'));
    }

    /**
     * Update the specified custom menu in storage.
     */
    public function update(Request $request, CustomMenu $customMenu)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'type' => 'required|in:internal,external',
            'icon' => 'nullable|max:100',
            'order' => 'required|integer|min:0',
        ]);

        // Auto set target based on type
        $validated['target'] = $validated['type'] === 'external' ? '_blank' : '_self';
        
        // Set is_active (checkbox returns null when unchecked)
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $customMenu->update($validated);

        return redirect()->route('menu.index')
            ->with('success', 'Menu custom berhasil diupdate!');
    }

    /**
     * Remove the specified custom menu from storage.
     */
    public function destroy(CustomMenu $customMenu)
    {
        $customMenu->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu custom berhasil dihapus!');
    }

    /**
     * Toggle active status of custom menu.
     */
    public function toggleActive(CustomMenu $customMenu)
    {
        $customMenu->update([
            'is_active' => !$customMenu->is_active
        ]);

        return back()->with('success', 'Status menu berhasil diubah!');
    }
}
