@extends('layouts.app')
@section('content')
    <form action="{{ url('/articles/update') }}" method="post">
        @csrf
        <div class="container">
            @if (session('info'))
                <div class="alert alert-info" role="alert">
                    {{ session('info') }}
                </div>
            @endif
            <div class="ml-2 my-3">
                <a href="#">
                    <i class="fa-solid fa-arrow-left text-dark fs-5" onclick="history.back()"></i>
                </a>
            </div>
            <div class="mb-3">
                <label for="user_name" class="form-label">User Name</label>
                <input name="article_id" value="{{ $article->id }}" type="text" class="form-control" hidden>
                <input value="{{ $article->user_name }}" type="text" class="form-control" id="user_name" disabled>
            </div>
            <div class="mb-3">
                <label for="article_title" class="form-label">Article Title</label>
                <textarea name="article_title" class="form-control" id="article_title" rows="2">{{ $article->title }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="article_body" class="form-label">Article Body</label>
                <textarea name="article_body" class="form-control" id="article_body" rows="4">{{ $article->body }}
                </textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </form>
@endsection
