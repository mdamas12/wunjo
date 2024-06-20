<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation_detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'consultation_details';

    public function consultation():BelongsTo
    {
        return $this->BelongsTo(Consultation::class);
    }

    public function package():BelongsTo
    {
        return $this->BelongsTo(Package::class);
    }

    public function service():BelongsTo
    {
        return $this->BelongsTo(Service::class);
    }

    
}
