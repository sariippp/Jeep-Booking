<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeep Adventure - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --silver: #c6c3baff;
            --timberwolf: #dad7cdff;
            --sage: #a3b18aff;
            --fern-green: #588157ff;
            --hunter-green: #3a5a40ff;
            --brunswick-green: #344e41ff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--timberwolf);
        }

        .navbar {
            background-color: var(--brunswick-green);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: var(--timberwolf) !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--timberwolf) !important;
            transition: color 0.3s ease;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
        }

        .nav-link:hover {
            color: var(--sage) !important;
        }

        .nav-link.booking-link {
            background-color: var(--fern-green);
            border-radius: 25px;
            padding: 0.5rem 1.5rem !important;
        }

        .nav-link.booking-link:hover {
            background-color: var(--hunter-green);
            color: white !important;
        }

        .footer {
            background-color: var(--brunswick-green);
            color: var(--timberwolf);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .btn-primary {
            background-color: var(--fern-green);
            border-color: var(--fern-green);
        }

        .btn-primary:hover {
            background-color: var(--hunter-green);
            border-color: var(--hunter-green);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    @yield('styles')
    
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Jeep Adventure</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link booking-link" href="{{ route('booking') }}">Book Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Jeep Adventure</h5>
                    <p>Experience the thrill of off-road adventure with our premium jeep tours.</p>
                    <div class="social-links mt-3">
                        <a href="" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-light">Gallery</a></li>
                        <li><a href="{{ route('faq') }}" class="text-light">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-light">Contact Us</a></li>
                        <li><a href="{{ route('booking') }}" class="text-light">Book Now</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-envelope me-2"></i> jeep@gmail.com</p>
                    <p><i class="fas fa-phone me-2"></i> (+62) 87778716996 </p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Rajawali Jl. Jembatan Merah, Kota Lama, Kec. Krembangan, Surabaya, Jawa Timur</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>