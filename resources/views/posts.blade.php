<x-layout>
    <x-slot:title>
        Posts
    </x-slot>

    <div class="container py-5">
        <!-- Page Header -->
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="display-5 fw-bold mb-2">
                        <i class="bi bi-journal-text text-primary me-2"></i>
                        All Posts
                    </h1>
                    <p class="lead text-muted">
                        {{ $published->count() + $unPublished->count() }} total posts
                    </p>
                </div>
                <a href="{{ route('show.create') }}" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-plus-circle me-2"></i>
                    Create New
                </a>
            </div>
            
            <!-- Stats Cards -->
            <div class="row g-3 mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-gradient bg-success bg-opacity-10">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-25 p-3 rounded-circle me-4">
                                    <i class="bi bi-globe fs-3 text-success"></i>
                                </div>
                                <div>
                                    <h2 class="mb-0 fw-bold">{{ $published->count() }}</h2>
                                    <p class="text-muted mb-0">Published Posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-gradient bg-secondary bg-opacity-10">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-25 p-3 rounded-circle me-4">
                                    <i class="bi bi-file-earmark fs-3 text-secondary"></i>
                                </div>
                                <div>
                                    <h2 class="mb-0 fw-bold">{{ $unPublished->count() }}</h2>
                                    <p class="text-muted mb-0">Draft Posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        @if ($published->isEmpty() && $unPublished->isEmpty())
            <div class="text-center py-5 my-5">
                <div class="mb-4">
                    <i class="bi bi-journal-x display-1 text-muted"></i>
                </div>
                <h3 class="fw-bold mb-3">No Posts Found</h3>
                <p class="text-muted mb-4">Start by creating your first post!</p>
                <a href="{{ route('show.create') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-plus-circle me-2"></i>
                    Create Your First Post
                </a>
            </div>
        @endif

        <!-- Published Posts Section -->
        @if (!$published->isEmpty())
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-globe fs-4 text-success"></i>
                    </div>
                    <div>
                        <h2 class="h3 fw-bold mb-1">Published Posts</h2>
                        <p class="text-muted mb-0">Visible to everyone</p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($published as $post)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm hover-shadow-lg transition-all duration-300">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-globe me-1"></i> Published
                                        </span>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" type="button" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical fs-5"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('edit.post', $post->id) }}">
                                                        <i class="bi bi-pencil me-2"></i> Edit
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('delete.post', $post->id) }}" method="POST" 
                                                          class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" 
                                                                class="dropdown-item text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <i class="bi bi-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <h3 class="h5 fw-bold mb-3 text-truncate" title="{{ $post->title }}">
                                        {{ $post->title }}
                                    </h3>
                                    
                                    <p class="card-text text-muted mb-4" style="max-height: 100px; overflow: hidden;">
                                        {{ Str::limit($post->content, 120) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $post->created_at->format('M d, Y') }}
                                            </small>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('edit.post', $post->id) }}" 
                                                   class="btn btn-outline-primary">
                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-outline-danger"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $post->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal for this post -->
                            <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title text-danger">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                Delete Post
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this published post?</p>
                                            <div class="alert alert-warning">
                                                <i class="bi bi-info-circle me-2"></i>
                                                <strong>"{{ $post->title }}"</strong>
                                            </div>
                                            <p class="text-muted small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <form action="{{ route('delete.post', $post->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Delete Post
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Unpublished Posts Section -->
        @if (!$unPublished->isEmpty())
            <div class="mt-5 pt-5 border-top">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-secondary bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="bi bi-file-earmark fs-4 text-secondary"></i>
                    </div>
                    <div>
                        <h2 class="h3 fw-bold mb-1">Draft Posts</h2>
                        <p class="text-muted mb-0">Only visible to you</p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($unPublished as $post)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm hover-shadow-lg transition-all duration-300 border-start border-3 border-warning">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-file-earmark me-1"></i> Draft
                                        </span>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" type="button" 
                                                    data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical fs-5"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('edit.post', $post->id) }}">
                                                        <i class="bi bi-pencil me-2"></i> Edit & Publish
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('delete.post', $post->id) }}" method="POST" 
                                                          class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" 
                                                                class="dropdown-item text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this draft?')">
                                                            <i class="bi bi-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <h3 class="h5 fw-bold mb-3 text-truncate" title="{{ $post->title }}">
                                        {{ $post->title }}
                                    </h3>
                                    
                                    <p class="card-text text-muted mb-4" style="max-height: 100px; overflow: hidden;">
                                        {{ Str::limit($post->content, 120) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                Created {{ $post->created_at->diffForHumans() }}
                                            </small>
                                            <div>
                                                <a href="{{ route('edit.post', $post->id) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil me-1"></i> Edit Draft
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- JavaScript for Dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Confirm delete with custom modal
            const deleteForms = document.querySelectorAll('form[action*="delete"]');
            deleteForms.forEach(form => {
                const originalSubmit = form.submit;
                form.submit = function(e) {
                    if (e && !confirm('Are you sure you want to delete this post?')) {
                        e.preventDefault();
                        return false;
                    }
                    return originalSubmit.call(this);
                };
            });
        });
    </script>
</x-layout>