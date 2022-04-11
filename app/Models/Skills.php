<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'skills';

  public function character()
  {
    return $this->belongsToMany(Character::class)
      ->withPivot('character_skill_stats')
      ->withTimestamps();
  }

}
