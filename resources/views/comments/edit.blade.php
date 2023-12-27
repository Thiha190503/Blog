@extends('layouts.app')
@section('content')
    <form action="{{ url('/comments/update') }}" method="post">
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
                <input name="comment_id" value="{{ $comment->id }}" type="text" class="form-control" hidden>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" class="form-control" id="comment" rows="2">{{ $comment->content }}
            </textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </form>
@endsection
