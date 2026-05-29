<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class App extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'icon_url',
        'download_url',
        'bonus_amount',
        'min_withdrawal',
        'rating',
        'votes',
        'size',
        'intro_text',
        'about_text',
        'features',
        'download_steps',
        'is_new',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'promo_code'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'features' => 'array',
        'download_steps' => 'array',
        'is_new' => 'boolean',
        'rating' => 'float'
    ];

    /**
     * Boot the model. Auto-generate slug on creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($app) {
            if (empty($app->slug)) {
                $app->slug = Str::slug($app->name);
            }
        });
    }

    /**
     * Scope a query to only include new games.
     */
    public function scopeNewGames($query)
    {
        return $query->where('is_new', true);
    }

    /**
     * Scope a query to only include other games.
     */
    public function scopeOtherGames($query)
    {
        return $query->where('is_new', false);
    }

    /**
     * Generate fallback initials for the game icon.
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return empty($initials) ? 'APP' : substr($initials, 0, 4);
    }

    /**
     * Dynamic fallback background color based on name hash.
     */
    public function getFallbackBgAttribute()
    {
        $colors = [
            '#4f46e5', // Indigo
            '#dc2626', // Red
            '#d97706', // Amber
            '#059669', // Emerald
            '#2563eb', // Blue
            '#7c3aed', // Violet
            '#db2777', // Pink
            '#0891b2'  // Cyan
        ];
        $hash = crc32($this->name);
        return $colors[abs($hash) % count($colors)];
    }
}
