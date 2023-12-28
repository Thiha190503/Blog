<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    // auth
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    // show home page
    public function index()
    {
        $data = Article::select('articles.*', 'users.name as user_name')
        ->leftJoin('users', 'users.id', 'articles.user_id')
        ->latest()
        ->paginate(5);

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    // show detail
    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data
        ]);
    }

    // add category
    public function add()
    {
        $data = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
        ];
        return view('articles.add', [
            'categories' => $data
        ]);
    }

    // create article
    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    // delete article
    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::denies('article-delete', $article)) {
            return back()->with('error', 'Unauthorize');
        }
        $article->delete();
        return redirect('/articles')->with('info', 'Article deleted');
    }

    // direct to edit page
    public function edit($id)
    {
        $data =Article::select('articles.*', 'users.name as user_name')
        ->leftJoin('users', 'users.id', 'articles.user_id')
        ->find($id);

        return view('articles.edit', [
            'article' => $data
        ]);
    }

    // update article
    public function update(Request $request)
    {
        $validator = validator($request->all(), [
            'article_title' => 'required',
            'article_body' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = [
            'title' => $request->article_title,
            'body' => $request->article_body,
        ];

        Article::where('id',$request->article_id)->update($data);

        return back()->with('info', 'Article Updated');
    }

}
