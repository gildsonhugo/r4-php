@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('actionEditComment')}}" method="post">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <div class="form-group">
                        <label for="commentArea">Edit Comment</label>
                        <textarea id="commentArea" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="5"
                                  placeholder="What you are thinking about now?">{{$comment->comment}}</textarea>
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-success">Save and return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
