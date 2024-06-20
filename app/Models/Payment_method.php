<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function method_type():BelongsTo
    {
        return $this->BelongsTo(Method_type::class);
    }

    public function payment_check():HasMany
    {
        return $this->hasMany(Payment_check::class, 'id');
    } 
     
    
}
