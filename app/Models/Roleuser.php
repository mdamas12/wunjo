<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roleuser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'model_has_roles';

    public function rolesystem():BelongsTo
    {
        return $this->BelongsTo(Rolesystem::class, 'role_id');
    }

    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class, 'model_id');
    }
}
