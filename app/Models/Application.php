<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function links(): HasMany
    {
        return $this->hasMany(ApplicationPhotoLink::class);
    }

    public function mainLink(): HasOne
    {
        return $this->hasOne(ApplicationPhotoLink::class)->where('is_main', true);
    }
}
