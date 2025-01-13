@include('adminTwo.dashboard');



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Upload Media')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <main>
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
</head>

<body>

<div class="container mt-4">
    <h1>Create a New Subscription Plan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Plan Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>



        <!-- Subscription Type Selection -->
        <div class="form-group">
            <label for="subscription_type">Subscription Type</label>
            <select id="subscription_type" name="subscription_type" class="form-control" required>
                <option value="personal_training">Personal Training</option>
                <option value="build_his_temple">Build His Temple</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Plan</button>
    </form>
</div>


<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</main>


</html>
