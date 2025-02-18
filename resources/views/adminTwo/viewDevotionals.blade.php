@extends('adminTwo.dashboard')

@section('content')
<div class="container mt-4">
    <!-- Page Title -->
    <div class="text-center">
        <h1 class="display-4 mb-4 text-purple">Devotionals</h1>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Devotional Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-purple text-white">
            <h5 class="mb-0">Devotional Library</h5>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered border-purple align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Subscription Type</th>
                            <th>Level (For Build His Temple)</th>
                            <th>Created At</th>
                            <th>Document</th> <!-- New Column for Document -->
                            <th>Actions</th> <!-- New Column for actions -->
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($devotionals as $index => $devotional)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $devotional->title }}</td>
                                <td>{{ Str::limit($devotional->content, 50) }}</td> <!-- Display a short snippet of content -->
                                <td>
                                    @if($devotional->subscription_type == 'personal_training')
                                        Personal Training
                                    @elseif($devotional->subscription_type == 'build_his_temple')
                                        Build His Temple
                                        @elseif($devotional->subscription_type == 'free_trial')
                                        Free Trial
                                        @elseif($devotional->subscription_type == 'challenge')
                                        Challenge
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($devotional->subscription_type == 'build_his_temple')
                                        Level {{ $devotional->level }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $devotional->created_at->format('d M, Y') }}</td>

                                <!-- Add a link to view document content -->
                                <td>
                                    @if($devotional->document_content)
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#documentModal" onclick="showDocumentContent('{{ addslashes($devotional->document_content) }}')">View Document</button>
                                    @else
                                        <span>No document</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.editDevotional', $devotional->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.deleteDevotional', $devotional->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this devotional?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-folder-x fs-4"></i>
                                    <p class="mt-2">No devotionals uploaded yet.</p>
                                    <a href="{{ route('admin.uploadDevotional') }}" class="btn btn-primary mt-3">Upload Your First Devotional</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>



                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="documentContent">
                <!-- Content will be dynamically populated -->
            </div>
        </div>
    </div>
</div>

<script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    function showDocumentContent(content) {
        document.getElementById('documentContent').innerText = content;
    }

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</script>

@endsection
