@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @if (auth()->user()->id == $article->user_id)
                    <a class="btn btn-info" href="{{ url("/articles/edit/$article->id") }}">
                        Edit
                    </a>

                    <a class="btn btn-danger" href="{{ url("/articles/delete/$article->id") }}">
                        Delete
                    </a>
                @endif
            </div>
        </div>

        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>Comment ({{ count($article->comments) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @if (auth()->user()->id == $comment->user_id)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="text-dark float-end ms-3">
                            <i class="fa-solid fa-trash"></i>
                        </a>

                        <a href="{{ url("/comments/edit/$comment->id") }}" class="text-dark float-end">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    @endif
                    {{ $comment->content }}

                    <div class="small mt-2">
                        By <b>{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ url('/comments/add') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection
