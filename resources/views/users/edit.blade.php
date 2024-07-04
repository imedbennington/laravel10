<div class="card">
                    <div class="px-3 pt-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">
                                <div>
                                        <input name="name" type="text" value="{{$user->name}}" class="form-control">
                                        @error('name')
                                            <span class="text-danger fs-6">{{$message}}</span>
                                        @enderror
                                </div>
                            </div>
                            @auth
                                @if(Auth()->id() == $user->id)
                            <div>
                                <a href="{{route('users.edit',$user->id)}}">Edit</a>
                            </div>
                            @endif
                            @endauth
                        </div>
                        <div class="mt-4">
                            <label for="name">Profile picture</label>
                            <input type="file" name="image" class="form-control" >
                        </div>
                        <div class="px-2 mt-4">
                        <h5 class="fs-5"> About : </h5>
                                    <textarea name="bio" id="bio" class="form-control" rows="3"></textarea>
                                    @error('bio')
                                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                                    @enderror
                            <div>

                                <button class="btn btn-dark btn-sm mt-3">Save</button>
                            </div>
                            <div class="d-flex justify-content-start">
                                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                                    </span> 0 </a>
                                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                                    </span> {{$user->ideas()->count()}} </a>
                                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                                    </span> {{$user->comments()->count()}} </a>
                            </div>
                            @auth

                            @if(Auth()->id() !== $user->id)
                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm"> Follow </button>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <hr>