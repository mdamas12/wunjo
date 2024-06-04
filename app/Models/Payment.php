<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payments';

    /**
     * Get the user that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     public function payment_method():BelongsTo
     {
         return $this->BelongsTo(Payment_method::class);
     }
 
     public function patient():BelongsTo
     {
         return $this->BelongsTo(Patient::class);
     }

     public function consultation():BelongsTo
     {
         return $this->BelongsTo(Consultation::class);
     }

     public function package():BelongsTo
     {
         return $this->BelongsTo(Package::class);
     }
}
