<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'consultations';


    /**
     * Get the user that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function patient():BelongsTo
    {
        return $this->BelongsTo(Patient::class);
    }

    public function employee():BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    public function branch():BelongsTo
    {
        return $this->BelongsTo(Branch::class);
    }

    public function payment():HasMany
    {
        return $this->hasMany(Payment::class, 'id');
    } 
}
