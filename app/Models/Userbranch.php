<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Userbranch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'userbranches';

    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function branch():BelongsTo
    {
        return $this->BelongsTo(Branch::class, 'branch_id');
    }
}
