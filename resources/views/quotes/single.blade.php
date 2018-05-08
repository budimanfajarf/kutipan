@extends('layouts.app')

@section('content')
<script src="{{ asset('js/quote.js') }}"></script>
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">{{ $quote->title }}</h1>
    <p class="display-4" style="font-size: 2.5rem">{{ $quote->subject }}</p>
    <p class="lead" >
      @foreach ($quote->tags as $tag)
        <a href="/quotes/tag/{{$tag->name}}">#{{$tag->name}}</a>
      @endforeach
    </p>
    <hr class="my-4">
    <p class="lead">Writen by <strong><a href="/profile/{{ $quote->user->id }}">{{ $quote->user->name }}</a></strong></p>
    <div class="lead row">
      <div class="col-md-12">
        <div class="float-right">
          @if ($quote->isQuoteOwner())
            <a class="btn btn-primary btn-lg" href="/quotes/{{ $quote->id }}/edit" role="button">Edit</a> 
            <form action="/quotes/{{ $quote->id }}" method="POST" style="display:inline">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">              
              <button type="submit" class="btn btn-danger btn-lg" href="/quotes" role="button">Delete</button>                                    
            </form>           
          @endif
          <a class="btn btn-secondary btn-lg" href="/quotes" role="button">Back to Quotes</a>
        </div>
        <div class="wrapper-like">
          <div class="btn btn-outline-primary btn-lg disabled" style="opacity: 1">
            Likes 
            <span class="badge badge-dark total-like" style="background-color: #007bff; font-size: 100%;">{{ $quote->likes->count() }}</span>
          </div>&nbsp;
          @if (Auth::check())
            <button class="btn btn-lg 
              {{ $quote->isLiked() ? 'btn-danger btn-unlike' : 'btn-primary btn-like' }}" 
              data-type="1" 
              data-likeable-id="{{ $quote->id }}"
              data-container="body" data-toggle="popover" data-placement="right" data-content="Kasian amat gaada yg Like sampe mau Like punya sendiri wkwkwk JustKidding ;p">
              {{ $quote->isLiked() ? 'Unlike' : 'Like' }}
            </button>
          @endif
        </div>        
      </div>
    </div>
  </div>
  <div class="col-md-12">
    @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
          <li> {{$error}} </li>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>       
    @endif  
    @if (session('msg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>       
    @endif
    <form action="/quote_comments" method="POST">
      <div class="form-group row">
        <div class="col-md-10">
          <input class="form-control" type="text" name="subject" value="{{ old('subject') }}" placeholder="Isi Komentar">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        {{ csrf_field() }}
      </div>
      <input type="hidden" name="quote_id" value="{{ $quote->id }}">
    </form>
  </div>
  <br>
  <div class="col-md-12">
    @foreach ($quote->quoteComments as $quoteComment)
      <div class="card">
        <div class="card-body">
          <div class="card-text">
            <a href="/profile/{{ $quoteComment->user->id }}">{{ $quoteComment->user->name }}</a> &nbsp;&nbsp;
            {{ $quoteComment->subject }}
          </div>
          <small> {{ $quoteComment->updated_at }} </small> &nbsp;&nbsp;  
          <div class="wrapper-like" style="display: inline">
            <div class="btn btn-primary btn-sm disabled">
              Likes 
              <span class="badge badge-dark total-like" style=" font-size: 100%;">{{ $quoteComment->likes->count() }}</span>
            </div>&nbsp;
            @if (Auth::check())
              <button class="btn btn-sm 
                {{ $quoteComment->isLiked() ? 'btn-outline-danger btn-comment-unlike' : 'btn-outline-primary btn-comment-like' }}" 
                data-type="2" 
                data-likeable-id="{{ $quoteComment->id }}"
                data-container="body" data-toggle="popover" data-placement="right" data-content="Kasian amat gaada yg Like sampe mau Like punya sendiri wkwkwk JustKidding ;p" >
                {{ $quoteComment->isLiked() ? 'Unlike' : 'Like' }}
              </button>
            @endif
          </div> &nbsp;&nbsp;&nbsp; 
          <div class="float-right">
          @if ($quoteComment->isCommentOwner())
            <a class="btn btn-outline-primary btn-sm" href="/quote_comments/{{ $quoteComment->id }}/edit" role="button">Edit</a> 
            <form action="/quote_comments/{{ $quoteComment->id }}" method="POST" style="display:inline">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">              
              <button type="submit" class="btn btn-outline-danger btn-sm" href="/quotes" role="button">Delete</button>                                    
            </form>           
          @endif                
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
