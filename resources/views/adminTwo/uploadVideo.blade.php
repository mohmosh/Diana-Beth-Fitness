@extends('adminTwo.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Upload Media')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <style>
        body {
            background-color: white;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #6c757d;
        }

        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }

        .form-control {
            border-color: #6c757d;
        }

        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 8px rgba(108, 117, 125, 0.25);
        }

        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-primary:focus {
            box-shadow: 0 0 8px rgba(108, 117, 125, 0.5);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1/resumable.js"></script>

</head>

<main>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Upload Video</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.storeVideo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <!-- <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="editor" class="form-control"></textarea>
            </div> -->

            <!-- <div class="mb-3">
                    <label for="url" class="form-label">Video URL</label>
                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}">
                </div> -->

            <!-- <div class="mb-3">
                <label for="subscription_type" class="form-label">Subscription Type</label>
                <select name="subscription_type" id="subscription_type" class="form-select" required>
                    <option value="personal_training">Personal Training</option>
                    <option value="build_his_temple">Build His Temple</option>
                    <option value="free_trial">Free Trial</option>
                    <option value="challenge">Challenges</option>
                </select>
            </div> -->

            <div class="mb-3">
                <label for="subscription_plan" class="form-label">Type of Plan</label>
                <select name="plan_id" id="plan_id" class="form-select" required>
                    @foreach($plans as $plan)
                    <option value="{{ $plan->id }}"> {{ $plan->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level (For Build His Temple)</label>
                <input type="number" name="level" id="level" class="form-control" min="1">
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Upload Video:</label>
                <input type="file" id="fileInput" class="form-control" />
                <input type="hidden" name="video" id="video">
                <div id="progress"></div>
            </div>

            <!-- Devotional Upload Field -->
            {{-- <div class="mb-3">
                    <label for="devotional_content" class="form-label">Devotional Text (Optional):</label>
                    <textarea name="devotional_content" id="devotional_content" class="form-control"></textarea>
                </div> --}}

            <div class="mb-3">
                <label for="devotional_file" class="form-label">Upload Devotional File (Optional):</label>
                <input type="file" id="devotional_file" name="devotional_file" class="form-control">
                <small class="text-muted">You can either upload a file or enter devotional text. If both are provided,
                    the text will take priority.</small>
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

        ClassicEditor
            .create(document.querySelector('#devotional_text'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const r = new Resumable({
            target: '/upload-chunked',
            query: {
                _token: '{{ csrf_token() }}'
            },
            chunkSize: 1 * 1024 * 1024,
            testChunks: false
        });

        r.assignBrowse(document.getElementById('fileInput'));

        r.on('fileAdded', function(file) {
            r.upload();
        });

        r.on('fileSuccess', function(file, response) {
            const res = JSON.parse(response);
            console.log("Response is -->> ", res)
            document.getElementById('video').value = res.path;
            alert("Upload complete! Now submit the form.");
        });

        r.on('fileError', function(file, message) {
            alert("Error uploading file: " + message);
        });

        r.on('fileProgress', function(file) {
            document.getElementById('progress').innerText = `Progress: ${Math.floor(file.progress() * 100)}%`;
        });
    </script>
    </script>
</main>

</html>
@endsection