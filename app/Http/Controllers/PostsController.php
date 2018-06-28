<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['index', 'show']);
  }

  public function index()
  {
    //$posts = Post::orderBy('priority', 'asc')->get();
		$posts = Post::orderBy('created_at', 'desc')->get();
		//$posts = Post::latest()->get();
		//$posts = Post::all();
		return view('posts.index', compact('posts'));
  }

	public function show(Post $post) {
    //dd($post);
    $path = $post->body;
    $storagePath = ('/public/pages/');
    $storagePathName = $storagePath. $path .'.blade.php';
    $page = Storage::get($storagePathName);
    //dd($contents);

		return view('posts.show', compact('post', 'page'));
	}

	public function create() {
    $tags = Tag::all();    
		return view('posts.create', compact('tags'));
	}

  public function store() {
  	$this->validate(request(), [
  		'title' => 'required',
  		'body' => 'required',
  	]);

    //dd(request());
    $tags = Tag::all();
    $checkedTags = [];
    foreach ($tags as $tag) {
      $num = $tag->id;
      if(request()->$num){
        array_push($checkedTags, request()->$num);
      }
    }  	
    //dd($checkedTags);

  	auth()->user()->publish(
  		new Post(request(['title', 'body', 'priority']))
      ,$checkedTags
  	);
//      Post::create([
//        'title' => request('title'),
//        'body' => request('body'),
//      ]);
      //And then redirect.
      return redirect('/posts');
  }

  public function update(Post $post) {
    $tags = Tag::all();

    return view('posts.update', compact('tags', 'post'));
  }

  public function edit(Post $post) {
    //dd(request());
    $tags = Tag::all();
    foreach ($tags as $tag) {
      $num = $tag->id;
      //dd(request());
      $post_tag_count = DB::table('post_tag')->where('post_id', $post->id)
                                     ->where('tag_id', $num)
                                     ->count();
      $post_tag = DB::table('post_tag')->where('post_id', $post->id)
                                       ->where('tag_id', $num)
                                       ->get();

      if(request()->$num) { //タグにチェックありの場合
        //dd($post_tag_count);
        if ($post_tag_count){
          //tag_idがある場合は更新
          $post_tag->tag_id = $num;
        } else {
          //tag_idがない場合は追加
          $post_tag = DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => $num,
          ]);
        }
      } else {  //タグにチェックなしの場合
          if ($post_tag_count){
            //tag_idがある場合は削除
            DB::table('post_tag')->where('post_id', $post->id)
                               ->where('tag_id', $num)
                              ->delete();
          }
      }
    }

    $post->title = request()->title;
    $post->body = request()->body;
    $post->priority = request()->priority;
    $post->save();

    return redirect('/posts');
  }

}

