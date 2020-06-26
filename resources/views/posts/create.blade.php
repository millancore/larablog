@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="/posts">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold" for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ $title ?? '' }}"  required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="description">Body</label>
                    <textarea class="form-control" name="description" id="description" rows="10" required>
                        {{ $description ?? '' }}
                    </textarea>
                </div>
                <input class="btn btn-success" type="submit" value="Create">
            </form>
        </div>
    </div>
</div>
@endsection