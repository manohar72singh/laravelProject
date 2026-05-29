<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'app_id',
        'name',
        'rating',
        'comment',
        'status',
    ];

    /**
     * Relationship: a review belongs to an App.
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Scope: only approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope: only pending reviews.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
