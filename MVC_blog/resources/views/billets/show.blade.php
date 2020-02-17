@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">Billet number :{{ $billet->id }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">

                                    <strong>User that create the billet:</strong>
                                    {{ $billet->user->username }}
                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">

                                    <strong>Title:</strong>

                                    {{ $billet->title }}

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">

                                    <strong>Content:</strong>

                                    {{ $billet->content }}

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">

                                    <strong>Comments :</strong>

                                    <ul class="list-group">
                                        @foreach($comments as $comment)
                                        <li class="list-group-item justify-content-left">{{$comment->comment}}
                                            <p>created by {{ $comment->user->username }} the {{$comment->created_at}}</p>
                                            <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">



                                                @csrf

                                                @method('DELETE')



                                                <button type="submit" class="btn btn-danger">Delete</button>

                                            </form>
                                        </li>
                                        @endforeach
                                    </ul>

                                </div>

                            </div>

                            {{ $comments->links() }}

                            <div class="card-body">
                                <form method="POST" action="{{ route('CreateComment', $billet->id) }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="comment" class="col-md-4 col-form-label text-md-right">Add a
                                            comment</label>

                                        <div class="col-md-8">
                                            <textarea id="comment" rows="5"
                                                class="form-control @error('comment') is-invalid @enderror"
                                                name="comment" required autocomplete="comment" autofocus></textarea>
                                            @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('create') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
