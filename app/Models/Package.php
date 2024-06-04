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
}
