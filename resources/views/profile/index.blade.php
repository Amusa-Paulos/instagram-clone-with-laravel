@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!-- *****************************************
        *****************************************
        ******** IMPORTANT KEYWORDS *************
        *** LARAVEL TELESCOPE
        *** BOOT METHOD
        *** SERVICE PROVIDER
        *****************************************
        ***************************************** -->
            
            <div class="row">
            <div class="col-3">
                <img src="{{ $user->profile->profileImage() }}" style="width: 100%;" class="rounded-circle" alt="">
            </div>
            <div class="col-8 offset-1">
                <div class="mt-2 d-flex justify-content-between align-items-baseline">
                    <div>
                        <div class="d-flex align-items-center">
                            <h1>{{ $user->username }}</h1>
                            <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        </div>
                        @can('update', $user->profile)
                        <a href="/profile/{{ $user->id }}/edit">
                            edit profile
                        </a>
                        @endcan
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create">
                            Add New Post
                        </a>
                    @endcan
                </div>
                <div class="d-flex">
                    <div class="pr-4"><strong> {{ $postsCount }} </strong> posts</div>
                    <div class="pr-4"><strong>{{ $followersCount }} </strong> followers</div>
                    <div class="pr-4"><strong>{{ $followingCount }} </strong> following</div>
                </div>
                <div class="mt-2 font-weight-bold">{{ $user->profile->title }}</div>
                <div class="">{{ $user->profile->discription }}</div>
                <div class=""><a href="#">{{ $user->profile->url }}</a></div>
            </div>
            </div>
            
            <div class="row pt-5">
                @foreach($posts as $post)
                    <div class="col-4 pb-4">
                        <a href="/p/{{ $post->id }}">
                            <img src="/storage/{{$post->image}}" alt="" class="w-100">
                        </a>
                    </div>
                @endforeach
                
                
            </div>
        </div>
    </div>
</div>
@endsection
