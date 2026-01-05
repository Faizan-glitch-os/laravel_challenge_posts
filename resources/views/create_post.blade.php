<x-layout>
    <x-slot:title>
        Create Post
    </x-slot:title>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <!-- Card Header -->
                <div class="card-header gradient-bg text-white py-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-2 me-3"></i>
                        <div>
                            <h1 class="h3 mb-1">Create New Post</h1>
                            <p class="mb-0 opacity-75">Share your thoughts and ideas with the community</p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-5">
                    <form action="{{ route('create.post') }}" method="post" class="needs-validation" novalidate>
                        @csrf

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
                                   value="{{ old('title') }}"
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
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Publish Checkbox -->
                        <div class="mb-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="publish" 
                                       id="publish" 
                                       value="yes"
                                       {{ old('publish') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="publish">
                                    <i class="bi bi-send-check me-2"></i>Publish Now
                                </label>
                            </div>
                            <small class="text-muted ms-4 d-block">
                                If unchecked, your post will be saved as a draft
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-5 py-3">
                                <i class="bi bi-check-circle me-2"></i>
                                <span class="fw-semibold">Submit Post</span>
                            </button>
                            
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 py-3">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            
                            <button type="reset" class="btn btn-outline-danger px-4 py-3 ms-auto">
                                <i class="bi bi-x-circle me-2"></i>Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Validation Script -->
    <script>
        // Bootstrap form validation
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
                // Trigger once on load for any existing content
                textarea.dispatchEvent(new Event('input'));
            }
        });
    </script>
</x-layout>