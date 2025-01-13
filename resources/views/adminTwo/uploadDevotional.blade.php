@extends('adminTwo.dashboard')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <h1 class="text-center mb-4">Upload a Devotional</h1>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Ensure the main form includes enctype for file uploads -->
            <form action="{{ route('admin.storeDevotional') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea id="editor" name="content" class="form-control" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="subscription_type" class="form-label">Subscription Type</label>
                    <select name="subscription_type" id="subscription_type" class="form-select" required>
                        <option value="personal_training">Personal Training</option>
                        <option value="build_his_temple">Build His Temple</option>
                    </select>
                </div>

                <div id="level-container" class="mb-3" style="display: none;">
                    <label for="level" class="form-label">Level (For Build His Temple)</label>
                    <input type="number" name="level" id="level" class="form-control" min="1">
                </div>

                <div class="mb-3">
                    <label for="document" class="form-label">Attach Document (Optional)</label>
                    <input type="file" id="document" name="document" class="form-control" accept=".pdf,.doc,.docx,.txt">
                    <!-- accept attribute added to specify the file types -->
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

            document.getElementById('subscription_type').addEventListener('change', function () {
                var levelContainer = document.getElementById('level-container');
                if (this.value === 'build_his_temple') {
                    levelContainer.style.display = 'block';
                } else {
                    levelContainer.style.display = 'none';
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </main>
@endsection
