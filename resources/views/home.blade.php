@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<style>
    /* Hero Section dengan Background Image */
    .hero-section {
        height: 100vh;
        width: 100%;
        background: linear-gradient(rgba(52, 78, 65, 0.7), rgba(52, 78, 65, 0.7)),
                    url('/images/jeep-hero.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .hero-content {
        text-align: center;
        color: white;
        max-width: 800px;
        padding: 0 20px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease forwards;
        position: relative;
        z-index: 10;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-btn {
        padding: 1rem 3rem;
        font-size: 1.25rem;
        transition: transform 0.3s ease, background-color 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .hero-btn:hover {
        transform: scale(1.05);
    }

    .hero-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .hero-btn:hover::after {
        transform: translateX(0);
    }

    .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        cursor: pointer;
        animation: bounce 2s infinite;
        z-index: 10;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-30px);
        }
        60% {
            transform: translateY(-15px);
        }
    }

    /* Pricing Section */
    .pricing-section {
        background-color: var(--brunswick-green, #344E41);
        color: white;
        padding: 5rem 0;
    }

    .pricing-card {
        background-color: var(--sage, #A3B18A);
        border-radius: 15px;
        padding: 3rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .pricing-card:hover {
        transform: translateY(-10px);
    }

    /* Immersive Experience Section */
    .immersive-section {
        padding: 0;
        position: relative;
        height: 80vh;
        overflow: hidden;
    }
    
    .parallax-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/jeep-hero.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        transform: translateZ(-1px) scale(2);
    }
    
    .immersive-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.7));
        display: flex;
        align-items: flex-end;
    }
    
    .immersive-content {
        width: 100%;
        padding: 3rem;
        color: white;
        transform: translateY(50px);
        transition: transform 0.5s ease 0.2s;
    }
    
    .immersive-section:hover .immersive-content {
        transform: translateY(0);
    }

    /* Gallery Section */
    .gallery-section {
        padding: 5rem 0;
        background-color: white;
        position: relative;
        overflow: hidden;
    }

    .gallery-section::before {
        content: '';
        position: absolute;
        top: -50px;
        left: 0;
        width: 100%;
        height: 100px;
        background-color: var(--brunswick-green, #344E41);
        clip-path: polygon(0 100%, 100% 0, 100% 100%);
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .photo-stack {
        position: relative;
        height: 400px;
        width: 100%;
        perspective: 1000px;
    }

    .photo-card {
        position: absolute;
        width: 80%;
        height: 300px;
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .photo-card-1 {
        transform: translateZ(0) rotate(-5deg);
        background-image: url('/images/jeep-hero.jpg');
        z-index: 3;
    }

    .photo-card-2 {
        transform: translateZ(-50px) translateX(40px) rotate(5deg);
        background-image: url('/images/jeep-hero.jpg');
        z-index: 2;
    }

    .photo-card-3 {
        transform: translateZ(-100px) translateX(80px) rotate(10deg);
        background-image: url('/images/jeep-hero.jpg');
        z-index: 1;
    }

    .photo-stack:hover .photo-card-1 {
        transform: translateZ(50px) rotate(0);
    }

    .photo-stack:hover .photo-card-2 {
        transform: translateZ(0) translateX(20px) rotate(0);
    }

    .photo-stack:hover .photo-card-3 {
        transform: translateZ(-50px) translateX(40px) rotate(0);
    }

    .gallery-content {
        padding: 2rem;
    }

    .gallery-btn {
        display: inline-block;
        background-color: var(--brunswick-green, #344E41);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 1rem;
    }

    .gallery-btn:hover {
        background-color: var(--fern-green, #588157);
        transform: translateY(-3px);
        color: white;
    }

    /* Wave separator */
    .wave-separator {
        height: 100px;
        width: 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23344E41' fill-opacity='1' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        transform: rotate(180deg);
    }

    /* Instagram Card Styles */
    .instagram-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
        margin-bottom: 20px;
    }
    
    .instagram-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .instagram-image-container {
        position: relative;
        padding-bottom: 100%; /* Square aspect ratio */
        overflow: hidden;
    }
    
    .instagram-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .instagram-card:hover .instagram-image {
        transform: scale(1.05);
    }
    
    .instagram-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: white;
    }
    
    .instagram-card:hover .instagram-overlay {
        opacity: 1;
    }
    
    .instagram-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .instagram-play-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: rgba(255,255,255,0.9);
    }
    
    .instagram-caption {
        padding: 0 15px;
        text-align: center;
        font-size: 0.9rem;
    }
    
    .instagram-info {
        display: flex;
        justify-content: space-between;
        padding: 12px 15px;
        font-size: 0.85rem;
        color: #555;
    }
    
    .instagram-date {
        font-weight: 500;
    }
    
    .instagram-type {
        color: #888;
    }

    /* Simple Animations */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0px);
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section dengan Background Image -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="display-3 mb-4">Nikmati Petualangan</h1>
        <p class="lead mb-4">Rasakan sensasi eksplorasi off-road dengan tur jeep premium kami</p>
        <a href="{{ route('booking.form') }}" class="btn btn-primary hero-btn">Pesan Sekarang</a>
    </div>
    <div class="scroll-down">
        <i class="fas fa-chevron-down fa-2x"></i>
    </div>
</div>

<!-- Pricing Section -->
<section class="pricing-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="pricing-card">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="mb-4" style="color: var(--brunswick-green, #344E41);">Wisata Jeep Adventure</h2>
                            <div class="pricing-detail mb-3">
                                <i class="fas fa-ticket-alt me-2" style="color: var(--brunswick-green, #344E41);"></i>
                                <span class="fw-bold">Harga: Rp 45.000</span>
                            </div>
                            <div class="pricing-detail mb-3">
                                <i class="fas fa-clock me-2" style="color: var(--brunswick-green, #344E41);"></i>
                                <span class="fw-bold">Jam Operasional: 08:00 - 19:00</span>
                            </div>
                            <div class="pricing-detail mb-3">
                                <i class="fas fa-calendar-alt me-2" style="color: var(--brunswick-green, #344E41);"></i>
                                <span class="fw-bold">Hari Buka: Sabtu & Minggu</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sessions-container">
                                <h4 class="mb-3" style="color: var(--brunswick-green, #344E41);">Sesi Tersedia</h4>
                                <div class="d-flex flex-wrap justify-content-center">
                                    @php $sessions = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'] @endphp
                                    @foreach($sessions as $session)
                                        <span class="badge bg-light text-dark m-1" style="
                                            background-color: white !important;
                                            color: var(--brunswick-green, #344E41) !important;
                                            padding: 0.5rem 0.75rem;
                                            font-size: 0.8rem;
                                            border-radius: 20px;
                                        ">{{ $session }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Immersive Experience Section with Parallax
    <section class="immersive-section">
        <div class="parallax-bg"></div>
        <div class="immersive-overlay">
            <div class="container immersive-content">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-4">Immersive Jeep Experience</h2>
                        <p class="lead">Feel the thrill of off-road adventure as you traverse through breathtaking landscapes and challenging terrains.</p>
                        <a href="{{ route('gallery') }}" class="btn btn-light mt-3">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<!-- Gallery Section with Stacked Photos -->
<section class="gallery-section">
    <div class="container">
        <div class="gallery-header">
            <h2>Abadikan Momen Anda</h2>
            <p class="lead">Lihat sekilas petualangan tak terlupakan bersama kami</p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="photo-stack">
                    <div class="photo-card photo-card-1"></div>
                    <div class="photo-card photo-card-2"></div>
                    <div class="photo-card photo-card-3"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="gallery-content">
                    <h3>Kesempatan Foto yang Menakjubkan</h3>
                    <p>Tur jeep kami membawa Anda melalui beberapa pemandangan paling menakjubkan yang memberikan kesempatan foto sempurna. Dari medan berbatu hingga hutan yang rimbun, setiap perjalanan adalah impian fotografer.</p>
                    <p>Galeri kami menampilkan momen yang diabadikan oleh para petualang selama perjalanan mereka. Setiap foto menceritakan kisah eksplorasi, sensasi, dan keindahan alam yang menanti Anda.</p>
                    <a href="{{ route('gallery') }}" class="gallery-btn">Lihat Lebih Banyak Foto <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instagram Feed Section (Using Embed) -->
<section class="instagram-section py-5" style="background-color: white;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Follow Our Adventures</h2>
            <p class="lead">Check out our latest posts on Instagram <a href="https://instagram.com/jeeptoursurabaya" target="_blank" class="text-decoration-none">@jeeptoursurabaya</a></p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <!-- Post/Reel 1 -->
                <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DFWvJzrSCwl/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                </blockquote>
            </div>
            <div class="col-md-4 mb-4">
                <!-- Post/Reel 2 -->
                <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DFU_BbbSdnK/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                </blockquote>
            </div>
            <div class="col-md-4 mb-4">
                <!-- Post/Reel 3 -->
                <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DCvCGr7SinU/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                </blockquote>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="https://instagram.com/jeeptoursurabaya" target="_blank" class="btn btn-outline-dark">
                <i class="fab fa-instagram me-2"></i> Follow Us on Instagram
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- Instagram Embed API -->
<script async src="//www.instagram.com/embed.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for the arrow down button
        document.querySelector('.scroll-down').addEventListener('click', function() {
            window.scrollTo({
                top: document.querySelector('.pricing-section').offsetTop,
                behavior: 'smooth'
            });
        });
        
        // Parallax effect for immersive section
        window.addEventListener('scroll', function() {
            const parallaxBg = document.querySelector('.parallax-bg');
            const scrollPosition = window.pageYOffset;
            if (parallaxBg) {
                parallaxBg.style.transform = `translateY(${scrollPosition * 0.5}px)`;
            }
        });
        
        // Animation for elements when they come into view
        const animatedElements = document.querySelectorAll('.photo-stack');
        
        const elementObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                    elementObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });
        
        animatedElements.forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            elementObserver.observe(element);
        });

        // Support for Instagram overlay on touch devices
        document.querySelectorAll('.instagram-item').forEach(item => {
            if (item) {
                item.addEventListener('touchstart', function() {
                    const overlay = this.querySelector('.instagram-overlay');
                    if (overlay) {
                        overlay.style.opacity = '1';
                        
                        // Hide overlay after 2 seconds
                        setTimeout(() => {
                            overlay.style.opacity = '0';
                        }, 2000);
                    }
                });
            }
        });
    });
</script>
@endsection