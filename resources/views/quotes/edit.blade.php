@extends('layouts.app')

@section('content')
<script src="{{ asset('js/tag.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kutipan</div>

                <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li> {{$error}} </li>
                        @endforeach
                    </div>
                    @endif 
                    @if (session('tag_error'))
                    <div class="alert alert-danger">
                        {{ session('tag_error') }}
                    </div>
                    @endif                                         

                    <form action="/quotes/{{ $quote->id }}" method="POST">

                      <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Judul kutipan" value="{{ old('title') ? old('title') : $quote->title}}">
                      </div>

                      <div class="form-group">
                        <label for="subject">Isi Kutipan</label>
                        <textarea name="subject" class="form-control" rows="8">{{ old('subject') ? old('subject') : $quote->subject}}</textarea>
                      </div> 
                      
                      <div class="input-group mb-3" id="wrapper">
                        <div class="input-group-prepend">
                            <a href="#" class="btn btn-outline-secondary" id="add_tag" >Add Tag</a>
                        </div>

                        @if (old('tags'))
                           @for ($i = 0; $i < count(old('tags')); $i++)
                                <select name="tags[]" id="tag_select" class="custom-select">
                                    <option value="0">-</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                            @if (old('tags.'.$i) == $tag->id)
                                                selected = "selected"
                                            @endif 
                                            >{{ $tag->name }}
                                        </option>                            
                                    @endforeach
                                </select>                                                                                  
                           @endfor 
                        @else
                            @foreach ($quote->tags as $tag_old)
                                <select name="tags[]" id="tag_select" class="custom-select">
                                    <option value="0">-</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                            @if ($tag->id == $tag_old->id)
                                                selected="selected"
                                            @endif
                                            >{{ $tag->name }}
                                        </option>                            
                                    @endforeach
                                </select>                                                    
                            @endforeach
                        @endif                        

                      </div>
                      
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">

                      <div class="lead text-right">
                        <a class="btn btn-secondary" href="/quotes" >Cancel</a>                            
                        <button type="submit" class="btn btn-primary">Update Kutipan</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
