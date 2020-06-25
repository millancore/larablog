@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        @foreach ($posts as $post)
        <post-component class="w-25 mr-3" slug="{{ $post->slug }}">
            <template v-slot:title>{{ $post->title }}</template>
            {{ $post->description }}
            <template v-slot:published>{{ $post->publication_date }}</template>
        </post-component>
        @endforeach
    </div>
    <div>
        <pagination-component>
            {{ $posts->links() }}
        </pagination-component>
    </div>
</div>
@endsection