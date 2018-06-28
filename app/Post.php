<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function tags()
  {
    // 1 post may have many tags
    // Any tag may be applied to many posts
    return $this->belongsToMany(Tag::class);
  }

  public function game()
  {
    return $this->belongsTo(Game::class);
  }

  public function character()
  {
    return $this->belongsTo(Character::class);
  }

  public function addComment($body)
  {
    //dd($this->comments());
    //$this->comments()->create(compact('body')); //Why?:This is Not work
    Comment::create([
      'body' => $body,
      'post_id' => $this->id,
      'user_id' => $this->user_id,
    ]);
  }
    //protected $guarded = [];
    //protected $fillable = ['title', 'body'];
    public function scopeFilter($query, $filters)
    {
        if($month = $filters['month']){
          $query->whereMonth('created_at', Carbon::parse($month)->month); //March => 3, May => 5
        }
        if($year = $filters['year']){
          $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
      return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }
}
