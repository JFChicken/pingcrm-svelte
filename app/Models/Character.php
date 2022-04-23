<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Character extends Model
{
    use HasFactory;


  protected $fillable = ['name','stats'];


  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'stats' => 'array',
  ];

  public function skill()
  {
    return $this->belongsToMany(Skills::class)
      ->withPivot('character_skill_stats')
      ->withTimestamps();
  }

}
