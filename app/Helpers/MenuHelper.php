<?php

namespace App\Helpers;

use App\Models\Menu;
use Illuminate\Support\Facades\Request;

class MenuHelper
{
    /**
     * Get menus by position
     */
    public static function getMenus($position = 'header')
    {
        return Menu::active()
            ->excludeStatic()
            ->position($position)
            ->parent()
            ->ordered()
            ->with('activeChildren')
            ->get();
    }

    /**
     * Render menu HTML for Bootstrap navbar
     */
    public static function renderMenu($position = 'header', $classes = 'navbar-nav')
    {
        $menus = self::getMenus($position);
        
        if ($menus->isEmpty()) {
            return '';
        }

        $html = '<ul class="' . $classes . '">';
        
        foreach ($menus as $menu) {
            $html .= self::renderMenuItem($menu);
        }
        
        $html .= '</ul>';
        
        return $html;
    }

    /**
     * Render single menu item
     */
    private static function renderMenuItem($menu)
    {
        $hasChildren = $menu->activeChildren->count() > 0;
        $currentUrl = Request::path();
        $menuUrl = ltrim($menu->full_url, '/');
        $isActive = ($currentUrl === $menuUrl) ? 'active' : '';
        
        $liClass = 'nav-item' . ($hasChildren ? ' dropdown' : '');
        if ($isActive) {
            $liClass .= ' active';
        }
        
        $html = '<li class="' . $liClass . '">';
        
        if ($hasChildren) {
            // Menu with dropdown
            $html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            if ($menu->icon) {
                $html .= '<i class="' . $menu->icon . '"></i> ';
            }
            $html .= $menu->title;
            $html .= '</a>';
            
            $html .= '<ul class="dropdown-menu">';
            foreach ($menu->activeChildren as $child) {
                $html .= self::renderChildMenuItem($child);
            }
            $html .= '</ul>';
        } else {
            // Single menu item
            $html .= '<a class="nav-link ' . $isActive . '" href="' . url($menu->full_url) . '" target="' . $menu->target . '">';
            if ($menu->icon) {
                $html .= '<i class="' . $menu->icon . '"></i> ';
            }
            $html .= $menu->title;
            $html .= '</a>';
        }
        
        $html .= '</li>';
        
        return $html;
    }

    /**
     * Render child menu item (dropdown item)
     */
    private static function renderChildMenuItem($menu)
    {
        $currentUrl = Request::path();
        $menuUrl = ltrim($menu->full_url, '/');
        $isActive = ($currentUrl === $menuUrl) ? 'active' : '';
        
        $html = '<li>';
        $html .= '<a class="dropdown-item ' . $isActive . '" href="' . url($menu->full_url) . '" target="' . $menu->target . '">';
        if ($menu->icon) {
            $html .= '<i class="' . $menu->icon . '"></i> ';
        }
        $html .= $menu->title;
        $html .= '</a>';
        $html .= '</li>';
        
        return $html;
    }

    /**
     * Render footer menu (simple list)
     */
    public static function renderFooterMenu($position = 'footer', $classes = 'list-unstyled')
    {
        $menus = self::getMenus($position);
        
        if ($menus->isEmpty()) {
            return '';
        }

        $html = '<ul class="' . $classes . '">';
        
        foreach ($menus as $menu) {
            $html .= '<li class="mb-2">';
            $html .= '<a href="' . url($menu->full_url) . '" target="' . $menu->target . '" class="text-decoration-none">';
            if ($menu->icon) {
                $html .= '<i class="' . $menu->icon . '"></i> ';
            }
            $html .= $menu->title;
            $html .= '</a>';
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        
        return $html;
    }

    /**
     * Check if menu is active
     */
    public static function isActive($url)
    {
        $currentUrl = Request::path();
        $menuUrl = ltrim($url, '/');
        
        return $currentUrl === $menuUrl;
    }

    /**
     * Get breadcrumb from menu
     */
    public static function getBreadcrumb()
    {
        $currentUrl = '/' . Request::path();
        $breadcrumb = [];
        
        // Find current menu
        $currentMenu = Menu::where('url', $currentUrl)
            ->orWhere('url', Request::path())
            ->first();
        
        if ($currentMenu) {
            $breadcrumb[] = [
                'title' => $currentMenu->title,
                'url' => $currentMenu->full_url
            ];
            
            // If has parent, add parent to breadcrumb
            if ($currentMenu->parent) {
                array_unshift($breadcrumb, [
                    'title' => $currentMenu->parent->title,
                    'url' => $currentMenu->parent->full_url
                ]);
            }
        }
        
        // Always add home
        array_unshift($breadcrumb, [
            'title' => 'Beranda',
            'url' => '/'
        ]);
        
        return $breadcrumb;
    }

    /**
     * Get custom submenu untuk parent statis tertentu (profil, informasi)
     * 
     * @param string $parentSlug - 'profil' atau 'informasi'
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCustomSubmenu($parentSlug)
    {
        // Ambil submenu dari tabel menus untuk parent statis (profil, informasi)
        $parentMenu = Menu::where('slug', $parentSlug)->first();
        
        if ($parentMenu) {
            return Menu::where('parent_id', $parentMenu->id)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        }
        
        return collect();
    }

    /**
     * Get menu dinamis yang parent-nya NULL (menu baru di level teratas)
     * Exclude menu statis: beranda, profil, informasi
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCustomParentMenus()
    {
        return Menu::whereNull('parent_id')
            ->where('is_active', true)
            ->excludeStatic()
            ->orderBy('order')
            ->with('activeChildren')
            ->get();
    }
}
