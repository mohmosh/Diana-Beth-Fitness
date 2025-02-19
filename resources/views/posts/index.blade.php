@extends('layouts.app')

@section('content')

    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center pt-70">
                            <h2>FitFam Community</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container mt-5">
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-md-4">
                        <div class="badge-post shadow-sm p-3 rounded mb-4 text-center">
                            <img src="{{ $post->user->profile_picture ?? asset('default-avatar.png') }}" class="rounded-circle avatar" alt="User Avatar">

                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                <h5 class="text-dark fw-bold">{{ Str::limit($post->title, 30) }}</h5>
                                <p class="text-muted small">{{ Str::limit($post->content, 50) }}</p>
                                <p class="text-primary small fw-bold">By {{ $post->user?->name ?? 'Unknown' }}</p>
                            </a>



                            <!-- Like Button -->
                            <button class="btn btn-sm like-btn" data-id="{{ $post->id }}">
                                ❤️ <span id="like-count-{{ $post->id }}">{{ $post->likes_count ?? 0 }}</span> Likes
                            </button>

                            <!-- Comment Button -->
                            <button class="btn btn-sm btn-secondary comment-btn" data-id="{{ $post->id }}">
                                💬 Comments
                            </button>

                            <!-- Comment Section (Initially Hidden) -->
                            <div class="comments-section mt-3" id="comments-{{ $post->id }}" style="display: none;">
                                <div id="comment-list-{{ $post->id }}">
                                    @foreach ($post->comments as $comment)
                                        <p class="text-muted small">{{ $comment->user->name }}: {{ $comment->content }}</p>
                                    @endforeach
                                </div>

                                <textarea class="form-control mt-2" id="comment-text-{{ $post->id }}" rows="2" placeholder="Write a comment..."></textarea>
                                <button class="btn btn-sm btn-success mt-2 submit-comment" data-id="{{ $post->id }}">Post</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No posts available. Start the discussion!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary shadow-sm">Create A Post</a>
            </div>
        </div>
    </main>

    @push('styles')
    <style>
        .badge-post {
            background: white;
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            min-height: 150px;
        }
        .badge-post:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: purple;
            color: whitesmoke;
        }
    </style>

    <!-- JavaScript for Likes and Comments -->
    @push('scripts')

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Like Button Click
            $(".like-btn").click(function () {
                var postId = $(this).data("id");
                var likeCount = $("#like-count-" + postId);

                $.ajax({
                    url: "/posts/" + postId + "/like",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        likeCount.text(response.likes);
                    }
                });
            });

            // Show/Hide Comment Section
            $(".comment-btn").click(function () {
                var postId = $(this).data("id");
                $("#comments-" + postId).toggle();
            });

            // Submit Comment
            $(".submit-comment").click(function () {
                var postId = $(this).data("id");
                var commentText = $("#comment-text-" + postId).val();

                if (commentText.trim() === "") return;

                $.ajax({
                    url: "/posts/" + postId + "/comment",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: commentText
                    },
                    success: function (response) {
                        $("#comment-list-" + postId).append(`<p class="text-muted small">${response.user}: ${response.content}</p>`);
                        $("#comment-text-" + postId).val("");
                    }
                });
            });
        });
    </script>

@endsection

