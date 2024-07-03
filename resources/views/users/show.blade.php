@extends('layouts.layout')

@section('content')
<div class="container py-4">
    @include('shared.SuccessMessage')

    <div class="row">
        @include('shared.left-side-bar')

        <div class="col-6">
            <div class="mt-3">
                @include('users.userCard')
            </div>

            @include('shared.SubmitIdeas')

            <hr>

            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('shared.IdeaCard')
                </div>
            @empty
                <p>No result found</p>
            @endforelse

            <div class="mt-3">
                {{$ideas->withQueryString()->links()}}
            </div>
        </div>

        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
</div>
@endsection
