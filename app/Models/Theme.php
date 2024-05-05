<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Theme extends Model
{
    protected $fillable = ['name', 'description', 'restaurant_name', 'is_active'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::updating(function ($theme) {
            // Check if 'is_active' is being set to true
            if ($theme->is_active && $theme->isDirty('is_active')) {
                // Deactivate all other themes for the same restaurant
                Theme::where('restaurant_name', $theme->restaurant_name)
                    ->where('id', '!=', $theme->id)
                    ->update(['is_active' => false]);
            }
        });
    }

    /**
     * Get the restaurant that owns the theme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_name', 'name');
    }

    /**
     * Activate this theme and deactivate others.
     */
    public function activate()
    {
        DB::transaction(function () {
            // Deactivate all other themes for this restaurant
            self::where('restaurant_name', $this->restaurant_name)
                ->where('id', '!=', $this->id)
                ->update(['is_active' => false]);

            // Activate this theme
            $this->is_active = true;
            $this->save();
        });
    }
}
