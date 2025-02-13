@extends('layouts.app')

@section('title', 'Gallery')

@section('styles')
<style>
    .gallery-header {
        background-color: var(--sage);
        padding: 1rem 0;
        margin-bottom: 3rem;
        border-radius: 15px;
        padding-top: 100px;
    }

    .gallery-carousel .carousel-item img {
        height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }

    .gallery-grid .gallery-item {
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .gallery-grid .gallery-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-grid .gallery-item:hover img {
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<div class="gallery-header text-center">
    <div class="container">
        <h1>Our Adventure Gallery</h1>
        <p class="lead">Explore moments from our exciting jeep tours</p>
    </div>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-12">
            <div id="galleryCarousel" class="carousel slide gallery-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep Tour 1">
                    </div>
                    <div class="carousel-item">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep Tour 2">
                    </div>
                    <div class="carousel-item">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep Tour 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>

    <div class="row gallery-grid">
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Mountain Trail">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Forest Expedition">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="River Crossing">
            </div>
        </div>
    </div>
</div>
@endsection