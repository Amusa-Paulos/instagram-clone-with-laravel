@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100" alt="">
        </div>
        <div class="col-4">
            <div class="">
                <div class="d-flex align-items-center mb-4">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" alt="img" 
                            class="w-100 rounded-circle" style="max-width: 25px;">
                    </div>
                    <div class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </div>
                    <div class="pl-3">
                        <a href="#">Follow</a>
                    </div>
                </div>
                
                <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
