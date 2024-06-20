<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment_check extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payment_checks'; 

    public function payment():BelongsTo
    {
        return $this->BelongsTo(Payment::class);
    }

    public function payment_method():BelongsTo
    {
        return $this->BelongsTo(Payment_method::class);
    }


}
