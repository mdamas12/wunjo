<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment_detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payment_details';

    public function payment():BelongsTo
    {
        return $this->BelongsTo(Payment::class);
    }

    public function service():BelongsTo
    {
        return $this->BelongsTo(Service::class);
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
