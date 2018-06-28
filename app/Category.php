<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Category extends Model
{
  public function tags()
  {
    // 1 post may have many tags
    // Any tag may be applied to many posts
    return $this->belongsToMany(Tag::class);
  }

  public function unSelectedTags(Category $category)
  {
  	//dd('stop');
  	$tags = $category->tags;
		$Tags = Tag::all();
		$removeids = [];
  	foreach ($Tags as $Tag) {
	  	foreach ($tags as $tag) {
		  	//dd($tags);
		  	//dd($Tag);
	  		if ($tag->id == $Tag->id) {
	  			array_push($removeids, $tag->id);
	  		}
	  	}
  	}
  	//dd($removeids);
  	//$Tags = Tag::all();
		$Tags = Tag::whereNotIn('id', $removeids)->get();
  	//dd($Tags);
		//$Tag->save();
  	return $Tags;
	}  
}
