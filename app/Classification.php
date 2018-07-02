<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
  public function games()
  {
    return $this->belongsToMany(Game::class, 'game_classification');
  }

}
