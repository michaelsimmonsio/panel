<?php

namespace Pterodactyl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }



    public static function getRules() {
        return [
            'name' => 'required|string|max:255',
            // Add other rules as needed
        ];
    }

    public static function getRulesForUpdate() {
        return [
            'name' => 'required|string|max:255',
            // Add other rules as needed
        ];
    }
}
