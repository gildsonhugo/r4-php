@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{route('storeComment')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="commentArea">New Comment</label>
                            <textarea id="commentArea" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="5"
                                      placeholder="What you are thinking about now?"></textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-success">Post new comment</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth

        @forelse($comments as $comment)
             <div class="row justify-content-center row-comment">
                 <div class="col-md-8">
                     <div class="card">
                         <div class="card-header d-flex align-items-center justify-content-between">
                             <div class="d-flex align-items-center">
                                <span class="user-photo">
                                    <img src="{{ $comment->user->getPhotoUrl() }}" alt="User image">
                                </span>
                                {{$comment->user->name}}
                             </div>
                             @auth
                                 @if(Auth::user()->isAdmin() || $comment->user_id == Auth::user()->id)
                                     <div class="block-actions">
                                         @if($comment->user_id == Auth::user()->id)
                                            <a class="btn btn-primary" href="{{route('editComment', $comment->id)}}">Edit</a>
                                         @endif
                                         <a class="btn btn-danger" href="{{route('deleteComment', $comment->id)}}" onclick="return confirm('Do you really want to delete this comment?')">Delete</a>
                                     </div>
                                 @endif
                             @endauth
                         </div>
                         <div class="card-body">
                             <p class="font-weight-light text-posted">Posted on {{DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('d/m/Y H:i:s')}}, Last modification on {{DateTime::createFromFormat('Y-m-d H:i:s', $comment->updated_at)->format('d/m/Y H:i:s')}}</p>
                             <p class="card-text"> - {{$comment->comment}}</p>
                         </div>
                     </div>
                 </div>
             </div>
        @empty

                <div class="row justify-content-center row-comment">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-text text-center">No comments yet</h3>
                            </div>
                        </div>
                    </div>
                </div>

        @endforelse
    </div>
@endsection
