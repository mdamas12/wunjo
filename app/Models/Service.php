<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function package():HasMany
    {
        return $this->hasMany(Package::class, 'id');
    } 

    public function consultation_detail():HasMany
    {
        return $this->hasMany(Consultation_detail::class, 'id');
    } 

    public function payment_detail():HasMany
    {
        return $this->hasMany(Payment_detail::class, 'id');
    } 
}
