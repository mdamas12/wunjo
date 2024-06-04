<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the comments for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function package():HasMany
    {
        return $this->hasMany(Package::class, 'id');
    } 

    public function payment():HasMany
    {
        return $this->hasMany(Payment::class, 'id');
    } 
}
