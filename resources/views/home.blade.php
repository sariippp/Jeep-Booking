@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<style>
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
    }

    .hero-btn {
        padding: 1rem 3rem;
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }

    .hero-btn:hover {
        transform: scale(1.05);
    }

    .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        cursor: pointer;
        animation: bounce 2s infinite;
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

    .feature-section {
        padding: 5rem 0;
        background-color: white;
    }

    .feature-card {
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--fern-green);
        margin-bottom: 1.5rem;
    }

    .testimonial-section {
        background-color: var(--sage);
        padding: 5rem 0;
    }

    .testimonial-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        margin: 1rem;
    }

    .testimonial-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }


    .stats-section {
        padding: 5rem 0;
        background-color: var(--brunswick-green);
        color: white;
    }

    .stat-item {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    .pricing-section {
        background-color: var(--timberwolf);
        padding: 5rem 0;
    }

    .pricing-card {
        background-color: white;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="hero-section">
    <div class="hero-content">
        <h1 class="display-3 mb-4">Experience Adventure</h1>
        <p class="lead mb-4">Discover the thrill of off-road exploration with our premium jeep tours</p>
        <a href="{{ route('booking') }}" class="btn btn-primary hero-btn">Book Now
        </a>
    </div>
    <div class="scroll-down">
        <i class="fas fa-chevron-down fa-2x"></i>
    </div>
</div>

<section class="pricing-section" style="background-color: var(--brunswick-green); color: white; padding: 5rem 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="pricing-card" style="
                    background-color: var(--sage);
                    border-radius: 15px;
                    padding: 3rem;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                    position: relative;
                    overflow: hidden;
                ">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="mb-4" style="color: var(--brunswick-green);">Jeep Adventure Tour</h2>
                            <div class="pricing-detail mb-3">
                                <i class="fas fa-ticket-alt me-2" style="color: var(--brunswick-green);"></i>
                                <span class="fw-bold">Price: Rp 45,000</span>
                            </div>
                            <div class="pricing-detail mb-3">
                                <i class="fas fa-clock me-2" style="color: var(--brunswick-green);"></i>
                                <span class="fw-bold">Hours: 08:00 - 19:00</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sessions-container">
                                <h4 class="mb-3" style="color: var(--brunswick-green);">Availability Sessions</h4>
                                <div class="d-flex flex-wrap justify-content-center">
                                    @php $sessions = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'] @endphp
                                    @foreach($sessions as $session)
                                        <span class="badge bg-light text-dark m-1" style="
                                            background-color: white !important;
                                            color: var(--brunswick-green) !important;
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

<section class="feature-section">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Us</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-map-marked-alt feature-icon"></i>
                    <h3>Expert Guides</h3>
                    <p>Professional guides with years of experience and local knowledge</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-car feature-icon"></i>
                    <h3>Modern Fleet</h3>
                    <p>Well-maintained vehicles equipped with safety features</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-mountain feature-icon"></i>
                    <h3>Scenic Routes</h3>
                    <p>Carefully selected trails with breathtaking views</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-section">
    <div class="container">
        <h2 class="text-center mb-5">What Our Adventurers Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial-card">
                    <p class="mb-3">"An unforgettable experience! The guides were knowledgeable and friendly."</p>
                    <strong>- John Doe</strong>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial-card">
                    <p class="mb-3">"Best adventure tour I've ever been on. Will definitely come back!"</p>
                    <strong>- Jane Smith</strong>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial-card">
                    <p class="mb-3">"Amazing views and professional service. Highly recommended!"</p>
                    <strong>- Mike Johnson</strong>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection