@extends('layouts.app')

@section('content')
<link href="{{ asset('css/my.css') }}" rel="stylesheet">

<div class="container">
    <form action="/quotes" method="get">
      <div class="form-group row">
        <div class="col-md-12">
          <input name="search" class="form-control btn-lg" type="search" placeholder="Search" aria-label="Search" 
              style="border-radius: 20px; text-align: center"
              value="{{ $search_q }}">
        </div>
        {{-- <div class="col-md-2">
          <button class="btn btn-primary btn-block" type="submit">Search</button>
        </div> --}}
      </div>
    </form>
  @if (session('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('msg') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>    
  @endif
  <br>

  <div class="row justify-content-center">
    @foreach ($quotes as $quote)
    {{-- <div class="col-{{ mt_rand(8,12) }} col-sm-{{ mt_rand(6,12) }} col-md-{{ mt_rand(4,6) }} col-lg-{{ mt_rand(4,5) }}">             --}}
    <div class="  col-{{ mt_rand(8,12) }} 
                  col-sm-{{ mt_rand(6,12) }} 
                  col-md-{{ mt_rand(4,6) }} 
                  col-lg-{{ mt_rand(3,5) }}
    ">                  
      <div class="card border-secondary mb-4 my-card">
        <div class="card-body my-card-body">
          <h4 class="card-title"> {{ $quote->title }} </h4>          
          <blockquote class="blockquote mb-0">
            <p> {{ $quote->subject }} </p>
            <p>
              @foreach ($quote->tags as $tag)
                  <a href="/quotes/tag/{{$tag->name}}">#{{$tag->name}}</a> 
              @endforeach                  
            </p>
            <footer class="blockquote-footer">Writen by <strong> <a href="/profile/{{ $quote->user->id }}" >{{ $quote->user->name }}</a></strong></footer>
          </blockquote>
          <br>
          <div class="row">
            <div class="col-8">
                <div class="btn btn-outline-primary disabled" style="opacity: 1">L
                    <span class="badge badge-dark total-like" style="background-color: #007bff; font-size: 100%;">
                      {{ $quote->likes->count() }}
                    </span>
                </div>
                <div class="btn btn-outline-primary disabled" style="opacity: 1">C
                    <span class="badge badge-dark total-like" style="background-color: #007bff; font-size: 100%;">
                      {{ $quote->quoteComments->count() }}
                    </span>
                </div>                
            </div>
            <div class="col-4 text-right">
                <a href="/quotes/{{$quote->slug}}" class="btn btn-secondary">View ></a>
            </div>
          </div>
        </div>
      </div>              
    </div>  
    @endforeach
  </div>

  <br>
  <div class="row">
    <div class="col-md-12 lead">
      @foreach ($tags as $tag)
        <a href="/quotes/tag/{{$tag->name}}" style="font-weight: 600">#{{$tag->name}}</a> &nbsp;          
      @endforeach
    </div>
  </div>
  <br><br><br>

  <div class="fixed-bottom" style="margin: 30px;">
    <a class="btn btn-dark btn-lg float-left" href="/quotes/random" role="button">Random</a>
    <a class="btn btn-dark btn-lg float-right" href="/quotes/create" role="button">Create</a>
  </div>

  {{-- <div class="float-right">Float right on all viewport sizes</div><br> --}}

</div>
@endsection
