<x-layout>
    <x-slot:title>
        Edit Post
    </x-slot:title>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <!-- Card Header -->
                <div class="card-header gradient-bg text-white py-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-2 me-3"></i>
                        <div>
                            <h1 class="h3 mb-1">Edit Post</h1>
                            <p class="mb-0 opacity-75">Update your post: <strong>"{{ Str::limit($post->title, 50) }}"</strong></p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5">
                    <form action="{{ route('edit.post', $id) }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        @method('put')

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="bi bi-card-heading me-2"></i>Post Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   placeholder="Enter a catchy title for your post"
                                   value="{{ old('title', $post->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Content Field -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph me-2"></i>Content
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      class="form-control @error('content') is-invalid @enderror" 
                                      rows="8"
                                      placeholder="Write your amazing content here..."
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Publish Status -->
                        <div class="mb-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="publish" 
                                       id="publish" 
                                       value="yes"
                                       {{ old('publish', $post->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="publish">
                                    <i class="bi bi-send-check me-2"></i>Publish Now
                                </label>
                            </div>
                            <div class="ms-4 mt-2">
                                <small class="text-muted d-block">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Current status: 
                                    <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </small>
                                <small class="text-muted d-block">
                                    Last updated: {{ $post->updated_at->format('M d, Y \a\t h:i A') }}
                                </small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-5 py-3">
                                <i class="bi bi-check-circle me-2"></i>
                                <span class="fw-semibold">Update Post</span>
                            </button>
                            
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 py-3">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            
                            <!-- Delete Button (Optional) -->
                            <button type="button" 
                                    class="btn btn-outline-danger px-4 py-3 ms-auto"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Delete
                            </button>
                            
                        </div>
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-muted small">
                                <i class="bi bi-calendar-event me-1"></i>
                                Created: {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-info">
                                <i class="bi bi-eye me-1"></i>
                                Post ID: {{ $post->id }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this post?</p>
                    <p class="fw-semibold">"{{ $post->title }}"</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </button>
                    <form action="{{ route('delete.post', $id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Validation Script -->
    <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    <!-- Auto-resize textarea -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('content');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
                // Trigger once on load
                textarea.dispatchEvent(new Event('input'));
            }
        });
    </script>
</x-layout>