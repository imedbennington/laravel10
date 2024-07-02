@extends('layouts.layout')
@section('content')
<div class="container py-4">
@include('shared.SuccessMessage')
    <div class="row">
            @include('shared.left-side-bar')
        <div class="col-6">
            @include('shared.SubmitIdeas')
            <hr>
            @foreach ($ideas as $idea)
            <div class="mt-3">
                @include('shared.IdeaCard')
            </div>
            @endforeach
            <div class="mt-3">
            {{$ideas->links()}}
            </div>
            
        </div>
        <div class="col-3">
            
        @include('shared.search-bar')
        @include('shared.follow-box')
        </div>
    </div>
</div>
@endsection
