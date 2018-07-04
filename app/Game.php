<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  public function gamealises()
  {
    return $this->hasMany(Gamealias::class);
  }

  public function gamekeywords()
  {
    return $this->hasMany(Gamekeyword::class);
  }

  public function classifications()
  {
    return $this->belongsToMany(Classification::class, 'game_classification');
  }

  public function platforms()
  {
    return $this->belongsToMany(Platform::class);
  }

  public function maker()
  {
    return $this->belongsTo(Maker::class);
  }

}
