<div class="mb-3">
    <form action="{{ route('ideas.comments.store', $idea->id) }}" method="post">
        @csrf
        <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
        <div class="mt-2">
            <button class="btn btn-primary btn-sm">Post Comment</button>
        </div>
    </form>
    <hr>
</div>

@foreach ($idea->comments as $comment)
    <div class="d-flex align-items-start mb-3">
        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
             src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi" alt="Luigi Avatar">
        <div class="d-flex flex-column">
            <p class="fs-6 mt-1 fw-light mb-0">
                {{ $comment->content }}
            </p>
            <small class="fs-6 mt-1 fw-light text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
        </div>
    </div>
@endforeach

