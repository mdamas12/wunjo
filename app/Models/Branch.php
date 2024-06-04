<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the comments for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultation():HasMany
    {
        return $this->hasMany(Consultation::class, 'id');
    } 
}
