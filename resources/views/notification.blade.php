@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notifications </div>
                <div class="card-body">
                  <div class="list-group">
                    @foreach ($notifications as $notification)
                      <a href="/quotes/{{ $notification->quote->slug }}" class="list-group-item list-group-item-action">
                        {{ $notification->subject }} di kutipan {{  $notification->quote->title }} 
                      </a>                        
                    @endforeach

                    @php
                        $notifModel::where('user_id', $user->id)->where('seen', 0)->update(['seen' => 1]);
                    @endphp
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
