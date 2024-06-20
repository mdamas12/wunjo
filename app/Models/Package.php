<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'packages';

    public function patient():BelongsTo
    {
        return $this->BelongsTo(Patient::class);
    }

    public function service():BelongsTo
    {
        return $this->BelongsTo(Service::class);
    }

    public function payment():HasMany
    {
        return $this->hasMany(Payment::class, 'id');
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
