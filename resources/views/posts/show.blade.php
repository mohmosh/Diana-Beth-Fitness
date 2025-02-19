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
        <!-- Post Widget -->
        <div class="post-widget p-4">
            <!-- Post Header (Avatar, Name, Role, Date) -->
            <div class="post-header d-flex align-items-center mb-3">
                <img src="{{ $post->user->profile_picture ?? asset('default-avatar.png') }}" class="rounded-circle avatar" alt="User Avatar">
                <div class="ms-3">
                    <h5 class="mb-0">By {{ $post->user?->name ?? 'Unknown' }}</h5>

                    <small class="text-muted">

                        {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y \a\t g:i A') }}

                    </small>

                </div>
            </div>

            <h1 class="text-center">{{ $post->title }}</h1>
            <p class="lead">{{ $post->content }}</p>

            <!-- Small Like Button at Bottom -->
            <div class="text-end mt-3">
                <button id="like-btn" class="btn btn-sm btn-secondary">
                    👍 Like <span id="likes-count">{{ $post->likes->count() }}</span>
                </button>
            </div>
        </div>

        <hr>

        <h2>Comments</h2>
        <div id="comments-section">
            @forelse ($post->comments as $comment)
                <div class="comment-box">
                    <p>{{ $comment->content }}</p>
                    <small>By {{ $comment->user?->name ?? 'Unknown' }} - {{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>

        @auth
            <div class="mt-4">
                <h3>Add a Comment</h3>
                <form id="comment-form">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" name="content" id="comment-content" rows="4" required></textarea>
                    </div>
                    <button class="btn btn-secondary w-100" type="submit">Post Comment</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-2 w-100">Cancel</a>
                </form>
            </div>
        @endauth
    </div>
</main>

<!-- JavaScript for Likes and Comments -->
@push('scripts')


<!-- Bootstrap JS and Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
document.getElementById('like-btn').addEventListener('click', function() {
    fetch("{{ route('posts.like', $post->id) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('likes-count').innerText = data.likes;
    });
});

// Handle Comment Submission
document.getElementById('comment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let commentContent = document.getElementById('comment-content').value;

    fetch("{{ route('posts.comment', $post->id) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: commentContent })
    })
    .then(response => response.json())
    .then(data => {
        let newComment = `<div class="comment-box">
                            <p>${data.content}</p>
                            <small>By ${data.user} - Just now</small>
                          </div>`;
        document.getElementById('comments-section').insertAdjacentHTML('afterbegin', newComment);

        document.getElementById('comment-content').value = ''; // Clear textarea
    });
});
</script>
@endpush

@push('styles')
<style>
    .post-widget {
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        word-wrap: break-word;
    }

    .post-header {
        display: flex;
        align-items: center;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .comment-box {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .btn-sm {
        font-size: 14px;
        padding: 4px 8px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@endpush
@endsection
