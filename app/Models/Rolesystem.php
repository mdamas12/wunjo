<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rolesystem extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'roles';


    public function roleuser():HasMany
    {
        return $this->hasMany(Roleuser::class, 'id');
    } 
}
