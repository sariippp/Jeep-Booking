@extends('layouts.app')

@section('title', 'Gallery')

@section('styles')
<style>
    .gallery-header {
        background: linear-gradient(to right, var(--hunter-green), var(--fern-green));
        padding: 4rem 0 2rem;
        margin-bottom: 3rem;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-align: center;
        color: white;
        position: relative;
    }
    
    .gallery-header h1 {
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .gallery-header .lead {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }
    


    .gallery-carousel {
        margin-bottom: 3rem;
    }
    
    .gallery-carousel .carousel-item img {
        height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .carousel-caption {
        display: none;
    }

    .gallery-grid .gallery-item {
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .gallery-grid .gallery-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-grid .gallery-item:hover img {
        transform: scale(1.05);
    }
    
    .gallery-item .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        padding: 1rem;
        color: white;
        opacity: 0;
        transition: all 0.3s;
    }
    
    .gallery-item:hover .overlay {
        opacity: 1;
    }
    
    .gallery-item .overlay h5 {
        margin-bottom: 0.3rem;
        font-weight: 600;
    }
    
    .gallery-item .overlay p {
        font-size: 0.9rem;
        margin-bottom: 0;
        opacity: 0.9;
    }
    
    /* Section Titles Styling */
    .photo-collection h2,
    .video-gallery h2,
    .instagram-gallery h2 {
        margin-bottom: 2rem;
        color: var(--brunswick-green);
        position: relative;
        display: inline-block;
        text-align: center;
    }
    
    .photo-collection h2:after,
    .video-gallery h2:after,
    .instagram-gallery h2:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background-color: var(--sage);
        bottom: -10px;
        left: 25%;
    }
    
    .photo-collection,
    .video-gallery,
    .instagram-gallery {
        margin-bottom: 4rem;
        text-align: center;
    }
    

</style>
@endsection

@section('content')
<div class="gallery-header">
    <div class="container">
        <h1>Our Adventure Gallery</h1>
        <p class="lead">Explore moments from our exciting jeep tours through mountains, forests, and rivers</p>
    </div>
</div>

<div class="container">
    <!-- Photo Collection -->
    <div class="photo-collection">
        <h2>Photo Collection</h2>
    </div>

    <!-- Featured Carousel -->
    <div class="row mb-5">
        <div class="col-12">
            <div id="galleryCarousel" class="carousel slide gallery-carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep Mountain Tour">
                    </div>
                    <div class="carousel-item">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep Forest Tour">
                    </div>
                    <div class="carousel-item">
                        <img src="/images/jeep-hero.jpg" class="d-block w-100" alt="Jeep River Tour">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Photo Gallery Grid -->
    <div class="row gallery-grid">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Mountain Trail">
                <div class="overlay">
                    <h5>Mountain Trail</h5>
                    <p>Navigating rocky paths on our mountain expedition</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Forest Expedition">
                <div class="overlay">
                    <h5>Forest Expedition</h5>
                    <p>Exploring the dense forest vegetation</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="River Crossing">
                <div class="overlay">
                    <h5>River Crossing</h5>
                    <p>Testing our jeeps through challenging waterways</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Scenic Viewpoint">
                <div class="overlay">
                    <h5>Scenic Viewpoint</h5>
                    <p>Stopping to admire the breathtaking panorama</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Group Tour">
                <div class="overlay">
                    <h5>Group Tour</h5>
                    <p>Making memories with fellow adventure enthusiasts</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="gallery-item">
                <img src="/images/jeep-hero.jpg" alt="Sunset Drive">
                <div class="overlay">
                    <h5>Sunset Drive</h5>
                    <p>Enjoying the golden hour during our expedition</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Spacing -->
    <div class="mb-5"></div>
    
    <!-- Video Gallery Section -->
    <div class="video-gallery">
        <h2>Video Highlights</h2>
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Instagram Feed -->
    <div class="instagram-gallery">
        <h2>Follow Our Adventures</h2>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p>Check out more photos and videos on our Instagram</p>
                <a href="#" class="btn btn-primary">
                    <i class="fab fa-instagram me-2"></i> Follow @JeepAdventure
                </a>
            </div>
        </div>
    </div>
</div>

@endsection