<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  public function classifications()
  {
    return $this->belongsToMany(Classification::class);
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
