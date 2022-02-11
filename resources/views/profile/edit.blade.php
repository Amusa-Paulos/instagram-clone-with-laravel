@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label pl-0">Title</label>

                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                     name="title" value="{{ old('title') ?? $user->profile->title }}" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="discription" class="col-md-4 col-form-label pl-0">Discription</label>

                    <input id="discription" type="text" class="form-control @error('discription') is-invalid @enderror"
                     name="discription" value="{{ old('discription') ?? $user->profile->discription }}" autofocus>

                    @error('discription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label pl-0">Url</label>

                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" 
                        value="{{ old('url') ?? $user->profile->url }}" autofocus>

                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    @error('image')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </div>


    </form>
</div>
@endsection
