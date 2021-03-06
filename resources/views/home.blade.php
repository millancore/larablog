@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="posts/create" class="btn btn-primary mb-2">New Post</a>
            @foreach ($posts as $post)
            <post-component slug="{{ $post->slug }}">
                <template v-slot:title>{{ $post->title }}</template>
                {{ $post->description }}
                <template v-slot:published>{{ $post->publication_date }}</template>
            </post-component>
            @endforeach

            <pagination-component>
                {{ $posts->links() }}
            </pagination-component>
        </div>
    </div>
</div>
@endsection