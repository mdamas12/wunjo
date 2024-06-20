<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Method_type extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'method_types';

    public function payment_method():HasMany
    {
        return $this->hasMany(Payment_method::class, 'id');
    }
}
