<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HumanResource extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public function pendidikan_formal(): HasMany
    {
        return $this->hasMany(FormalEducation::class, 'id_sdm', 'id_sdm');
    }
}
