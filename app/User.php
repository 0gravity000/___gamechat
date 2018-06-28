<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Tag;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
      return $this->hasMany(Post::class);
    }

    public function publish(Post $post, $checkedTags)
    {
      //dd($checkedTags);
      //dd($post);

      $this->posts()->save($post);
//      Post::create([
//        'title' => request('title'),
//        'body' => request('body'),
//        'user_id' => auth()->id()
//      ]);

      //$post_tags = DB::table('post_tag')->get();
      //dd($post_tags);
      //dd($post);
      for ($i=0; $i < count($checkedTags); $i++) { 
        $post_tags = DB::table('post_tag')->insert([
          'post_id' => $post->id,
          'tag_id' => $checkedTags[$i],
        ]);
      }

    }    
    
}
