<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment_method extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payment_methods';

   /**
     * Get all of the comments for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment():HasMany
    {
        return $this->hasMany(Payment::class, 'id');
    } 

}
