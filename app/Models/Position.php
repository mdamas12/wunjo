<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'positions';

    /**
     * Get all of the comments for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employee():HasMany
    {
        return $this->hasMany(Employee::class, 'id');
    } 
 
}
