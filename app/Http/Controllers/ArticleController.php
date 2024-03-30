<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index(){
        $data = Article::latest()->paginate(5);

        return view('articles.index',['articles' => $data]);
    }
    public function detail($id){
        $data = Article::find($id);
        return view('articles.detail',['article' => $data]);
    }
    public function delete($id){
        $data = Article::find($id);
        $data->delete();

        return redirect('/pyaethiri')->with('info','Article deleted');
    }
    public function add(){
        $data = [
            ["id" => 1, "name" => "Pyae"],
            ["id" => 2, "name" => "Love"],
        ];
        return view('articles.add',['categories' => $data]);
    }
    public function create(){

        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/pyaethiri');
    }
    public function edit($id){
         $article = Article::find($id);
         $category = Category::all();

        return view('articles.edit', [ 'article' => $article,
             'categories' => $category
        ]);
    }
    public function update($id){
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id= request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles/update")->with('info', 'Article updated');
    }
}
