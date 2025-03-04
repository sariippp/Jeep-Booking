<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jeep Adventure - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async src="//www.instagram.com/embed.js"></script>

    <style>
        :root {
            --silver: #c6c3baff;
            --timberwolf: #f0efe9;
            --sage: #a3b18aff;
            --fern-green: #588157ff;
            --hunter-green: #3a5a40ff;
            --brunswick-green: #344e41ff;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--fern-green);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--hunter-green);
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--timberwolf);
            padding-top: 60px;
        }

        /* Navbar Styling - Simplified */
        .navbar {
            background-color: var(--brunswick-green);
            padding: 0.6rem 1rem;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
            transition: color 0.3s;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: var(--sage) !important;
        }

        .nav-link.active {
            color: var(--sage) !important;
        }

        .nav-link.booking-link {
            background-color: var(--fern-green);
            border-radius: 25px;
            padding: 0.5rem 1.5rem !important;
        }

        .nav-link.booking-link:hover {
            background-color: var(--hunter-green);
        }

        /* Footer Styling */
        .footer {
            background-color: var(--brunswick-green);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sage), var(--fern-green), var(--hunter-green));
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: var(--sage);
            font-size: 1.1rem;
            position: relative;
            padding-bottom: 8px;
        }

        .footer h5:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--sage);
        }

        .footer p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        .footer .list-unstyled li {
            margin-bottom: 0.8rem;
        }

        .footer .list-unstyled a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            position: relative;
            padding-left: 15px;
        }

        .footer .list-unstyled a:before {
            content: "\f054";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            font-size: 0.7rem;
            color: var(--sage);
            transition: all 0.3s;
        }

        .footer .list-unstyled a:hover {
            color: var(--sage);
            padding-left: 20px;
        }

        .footer .list-unstyled a:hover:before {
            left: 5px;
        }

        .social-links a {
            display: inline-flex;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin-right: 12px;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            color: white !important;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .social-links a:hover {
            background-color: var(--fern-green);
            transform: translateY(-3px);
        }

        .copyright {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Jeep Adventure</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Hubungi Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link booking-link" href="{{ route('booking.form') }}">Pesan Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Jeep Adventure</h5>
                    <p>Rasakan sensasi petualangan tur jeep premium kami. Jelajahi kota surabaya bersama pemandu berpengalaman dan kendaraan yang terawat dengan baik.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('gallery') }}">Galeri</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                        <li><a href="{{ route('booking.form') }}">Pesan Sekarang</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Informasi Kontak</h5>
                    <p>Email: jeep@gmail.com</p>
                    <p>Telepon: (+62) 87778716996</p>
                    <p>Alamat: Jl. Rajawali Jl. Jembatan Merah, Kota Lama, Kec. Krembangan, Surabaya, Jawa Timur</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-2">Hubungi Kami</a>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            <div class="container">
                <p class="mb-0">&copy; {{ date('Y') }} Jeep Adventure. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>