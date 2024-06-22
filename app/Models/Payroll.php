<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Payroll extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payrolls';

    public function employee():BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    public function payroll_detail():HasMany
    {
        return $this->hasMany(Payment_detail::class, 'id');
    } 

    public function payroll_pay():HasMany
    {
        return $this->hasMany(Payroll_pay::class, 'id');
    } 

}
