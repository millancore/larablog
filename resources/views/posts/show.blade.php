@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <post-component slug="{{ $post->slug }}">
                <template v-slot:title>{{ $post->title }}</template>
                {{ $post->description }}
                <template v-slot:published>{{ $post->publication_date }}</template>
            </post-component>
        </div>
    </div>
</div>
@endsection