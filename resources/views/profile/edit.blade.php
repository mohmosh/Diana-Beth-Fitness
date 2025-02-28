<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="profile-card">
            <!-- Back Link -->
            <a href="{{ route('dashboard.user') }}" class="back-link">
                &larr; Back to Dashboard
            </a>



            <div class="profile-header">Your Profile</div>

            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Profile Picture -->
                {{-- <div class="text-center">
                    <img src="{{ $user->profile_picture ? asset('storage/profile_pictures/' . $user->profile_picture) : asset('assets/img/default-avatar.png') }}"
                        alt="Profile Picture" class="profile-picture">
                </div> --}}

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control"
                            value="{{ old('email', $user->phone_number) }}" required>
                    </div>




                    <!-- Profile Picture -->
                    <div class="text-center">
                        <img id="profileAvatar"
                        src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) . '?' . time() : asset('assets/img/default-avatar.png') }}"
                        alt="Profile Picture" class="profile-picture">


                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="mb-3">
                        <label class="form-label">Update Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelector('input[name="profile_picture"]').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileAvatar').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>



</body>

</html>

<style>
    body {
        background-color: #f8f9fa;
    }

    .profile-card {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 20px;
    }

    .profile-header {
        background: purple;
        color: #fff;
        text-align: center;
        padding: 20px;
        font-size: 24px;
        font-weight: bold;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        display: block;
        margin: 10px auto 20px auto;
        background: #ddd;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-primary {
        width: 100%;
        background-color: purple;
    }

    .back-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        font-size: 16px;
        color: purple;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .back-link i {
        margin-right: 5px;
    }
</style>
