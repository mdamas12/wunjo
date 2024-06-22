<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Payroll_pay extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payroll_pays';

    public function payroll():BelongsTo
    {
        return $this->BelongsTo(Payroll::class);
    }

    public function payment_method():BelongsTo
    {
        return $this->BelongsTo(Payment_method::class);
    }
}
