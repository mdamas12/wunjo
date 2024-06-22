<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Payroll_detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payroll_details';

    public function payroll():BelongsTo
    {
        return $this->BelongsTo(Payroll::class);
    }

    public function consultation():BelongsTo
    {
        return $this->BelongsTo(Consultation::class);
    }
}
