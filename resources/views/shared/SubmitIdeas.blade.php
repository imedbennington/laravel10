    @auth()
        <h4>Share your ideas</h4>
            <div class="row">
                <form action="{{route('ideas.create')}}" method="post">
                @csrf
                <div class="mb-3">
                    <textarea name="input_idea" class="form-control" id="idea" rows="3"></textarea>
                </div>
                @error('input_idea')
                <span>{{$message}}</span>
                @enderror
                <div>
                    <button class="btn btn-dark" type="submit">Share</button>
                </div>
                </form>
            </div>
    @endauth()

    @guest()
        <h1>Log in to share</h1>
    @endguest()