<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Posts" }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --bs-primary: #4e54c8;
            --bs-secondary: #8f94fb;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3);
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(78, 84, 200, 0.1) 0%, rgba(143, 148, 251, 0.1) 100%);
            border-radius: 20px;
            padding: 3rem;
        }
        
        .post-meta {
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        }
        
        .footer {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fs-3" href="/">
                <i class="bi bi-journal-text me-2"></i>
                {{ $title ?? "Posts" }}
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        {{ $slot }}
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>