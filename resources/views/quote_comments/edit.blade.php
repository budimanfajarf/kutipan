@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Comment</div>

                <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li> {{$error}} </li>
                        @endforeach
                    </div>
                    @endif                    

                    <form action="/quote_comments/{{ $quoteComment->id }}" method="POST">

                      <div class="form-group">
                        <textarea name="subject" class="form-control" rows="8">{{ old('subject') ? old('subject') : $quoteComment->subject}}</textarea>
                      </div>                      
 
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">

                      <div class="lead text-right">
                        <a class="btn btn-secondary" href="/quotes/{{ $quoteComment->quote->slug }}" >Cancel</a>                            
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                      </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
