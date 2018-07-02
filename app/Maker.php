<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    public function games()
    {
      return $this->hasMany(Game::class);
    }

}
