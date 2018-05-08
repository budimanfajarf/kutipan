@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>

                <div class="card-body">
                    @if ($user->quotes->count() == 0)
                        <p class="lead">
                            Kamu belum buat kutipan! Buat kutipan pertamamu sekarang!
                            <a href="/quotes/create">Create Quote</a>         
                        </p>
                        <p class="lead">
                            Lihat kutipan-kutipan dari user lain
                            <a href="/quotes">Quotes</a>        
                        </p>
                    @else 
                        <p class="lead">
                            Ini daftar kutipan yang sudah kamu buat
                        </p>
                    @endif                    
                    <div class="list-group">
                    @foreach ($user->quotes as $quote)
                        <a href="/quotes/{{ $quote->slug }}" class="list-group-item list-group-item-action">{{ $quote->title }}</a>                        
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

