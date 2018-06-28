<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;
//use App\CategoryTag;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
  public function index(Tag $tag)
  {
    $posts = $tag->posts;
    return view('posts.index', compact('posts'));
  }

	public function create() {
		return view('tags.create');
	}

	public function store() {
		$tags = Tag::all();
    $validatedData = $this->validate(request(), [
    	'name' => 'required|unique:tags',
    ]);
		$tag = new Tag(request(['name', 'priority']));
		//dd($tag);
		$tag->save();

		$category_tag = DB::table('category_tag')->insert([
			'category_id' => 0,
			'tag_id' => $tag->id,
		]);
		//dd($category_tag);
		/*
		$category_tag = new CategoryTag;
		$category_tag->category_id = 0;
		$category_tag->tag_id = $tag->id;
		$category_tag->save();
		*/

		return back();
		//return view('tags.create');
	}

	public function update() {
		$tags = Tag::orderBy('priority', 'asc')->get();
		return view('tags.update', compact('tags'));
	}

	public function rename() {
		$tags = Tag::all();
		foreach ($tags as $tag) {
			$num = $tag->id;
			$priority = 'priority_'. $num;
			//dd(request());
			if(request()->$num) {
				$tag->name = request()->$num;
				$tag->priority = request()->$priority;
				$tag->save();
			}
		}

		return back();
	}

	public function create_category() {
		/*
		$categories = Category::all();
		$category = $categories->first();
		//カテゴリーに何も登録がない場合は、自動的にid:1:未分類を作成する
		if (!$category) {
			//dd('foo');
			$category = new Category([
				'name' => '未分類',
			]);
			$category->save();
		}
		//dd($category);
		*/
		return view('categories.create');
	}

	public function store_category() {
		$categories = Category::all();
    $validatedData = $this->validate(request(), [
    	'name' => 'required|unique:categories',
    ]);
		$category = new Category(request(['name', 'priority']));
		$category->save();
		return back();
		//return view('tags.create');
	}

	public function show_category() {
		$tags = Tag::all();
		$categories = Category::all();
		$category_tags = DB::table('category_tag')->get();
		//$category_tags = CategoryTag::all();
		//dd($categories->find(1)->tags()->first());
		//dd($tags->find(1)->categories()->first());
		//dd($categories->find(2)->unSelectedTags($categories->find(2)));

		return view('categories.show', compact('tags', 'categories', 'category_tags'));
	}

	public function change_category() {
		$tags = Tag::all();
		$categories = Category::all();
		$category_tags = DB::table('category_tag')->get();
		//$category_tags = CategoryTag::all();

		foreach ($categories as $category) {
			$target = 'tag_'.$category->id;
			if (request()->$target) {
				//$tags = $category->tags;				
				$tagname = request()->$target;
				//dd($tagname);
				$tagid = $tags->where('name', $tagname)->first()->id;
				//dd(request());
				if (request()->action == "add") {
					//追加
					$category_tag = DB::table('category_tag')->insert([
						'category_id' => $category->id,
						'tag_id' => $tagid,
					]);
					/*
					$category_tag = new CategoryTag;
					$category_tag->category_id = $category->id;
					$category_tag->tag_id = $tagid;
					$category_tag->save();
					*/
					//対象タグでcategory_id=0のものがあれば削除する
					DB::table('category_tag')->where('category_id', 0)
												->where('tag_id', $tagid)
												->delete();
					/*
					$category_tags = $category_tags->where('category_id', 0);
					$category_tag = $category_tags->where('tag_id', $tagid)->first();
					if ($category_tag) {
						$category_tag->delete();
					}
					*/
				} else {
					//削除	
					DB::table('category_tag')->where('category_id', $category->id)
												->where('tag_id', $tagid)
												->delete();
					/*
					$category_tags = $category_tags->where('category_id', $category->id);
					$category_tag = $category_tags->where('tag_id', $tagid)->first();
					//dd($category_tag);
					if ($category_tag) {
						$category_tag->delete();
					}
					*/
					//対象タグがいずれのカテゴリーにも属さなくなる場合はcategory_id=0として追加する
					//$category_tags = $category_tags->where('category_id', 0);
					$category_tags = DB::table('category_tag')->get();
					//$category_tags = CategoryTag::all();
					$category_tags = $category_tags->where('tag_id', $tagid);
					//dd($category_tags);
					$insertflag = true;
					if ($category_tags != null) {
						foreach ($category_tags as $category_tag) {
							//dd($category_tags);
							if (($category_tag->category_id) != 0) {
								$insertflag = false;
							}
						}
					}
					//var_dump($insertflag);
					//dd($insertflag);
					//$category_tags = $category_tags->where('category_id', 0)->first();
					if ($insertflag == true) {
						//dd($insertflag);
					$category_tag = DB::table('category_tag')->insert([
						'category_id' => 0,
						'tag_id' => $tagid,
					]);
						/*
						$category_tag = new CategoryTag;
						$category_tag->category_id = 0;
						$category_tag->tag_id = $tagid;
						$category_tag->save();
						*/
					}
				}
			}

		}

		
		return back();
	}

	public function update_category() {
		//dd(request());
		$categories = Category::all();
		return view('categories.update', compact('categories'));
	}

	public function rename_category() {
		$categories = Category::all();
		foreach ($categories as $category) {
			$num = $category->id;
			$priority = 'priority_'. $num;
			if(request()->$num) {
				$category->name = request()->$num;
				$category->priority = request()->$priority;
				$category->save();
			}
		}

		return back();
	}

}
