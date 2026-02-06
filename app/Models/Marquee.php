<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Marquee extends Model
{
    protected $fillable = [
        'title','message','status','position','starts_at','ends_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // Active scope: status=1 + (schedule ok)
    public function scopeActive(Builder $q): Builder
    {
        $now = now();

        return $q->where('status', true)
            ->where(function ($qq) use ($now) {
                $qq->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($qq) use ($now) {
                $qq->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }
}
