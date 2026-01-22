<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomMenu extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'parent_slug',
        'parent_id',
        'title',
        'slug',
        'url',
        'type',
        'target',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the parent custom menu.
     */
    public function parent()
    {
        return $this->belongsTo(CustomMenu::class, 'parent_id');
    }

    /**
     * Get the child custom menus.
     */
    public function children()
    {
        return $this->hasMany(CustomMenu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Get active children menus.
     */
    public function activeChildren()
    {
        return $this->hasMany(CustomMenu::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Get full URL based on menu type
     */
    public function getFullUrlAttribute()
    {
        if ($this->type === 'external') {
            return $this->url; // https://example.com
        }
        
        // Internal: /sambutan, /berita, dll
        return $this->url ?? '/' . $this->slug;
    }

    /**
     * Scope a query to only include active menus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to get menus for specific parent slug
     */
    public function scopeForParent($query, $parentSlug)
    {
        return $query->where('parent_slug', $parentSlug);
    }

    /**
     * Scope a query to get only parent menus (parent_slug and parent_id are null)
     */
    public function scopeParentMenus($query)
    {
        return $query->whereNull('parent_slug')
                    ->whereNull('parent_id');
    }

    /**
     * Scope to order by order column
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
