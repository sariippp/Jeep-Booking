@extends('layouts.app')

@section('title', 'Contact')

@section('styles')
<style>
    .contact-header {
        background-color: var(--sage);
        padding: 1rem 0;
        margin-bottom: 3rem;
        border-radius: 15px;
        padding-top: 100px;
    }

    .contact-info {
        background-color: var(--timberwolf);
        padding: 2rem;
        border-radius: 10px;
        height: 100%;
    }

    .contact-form .form-control:focus {
        border-color: var(--fern-green);
        box-shadow: 0 0 0 0.25rem rgba(88, 129, 87, 0.25);
    }
</style>
@endsection

@section('content')
<div class="contact-header text-center">
    <h1>Contact Us</h1>
    <p class="lead">Feedback akan dibalas paling lambat 3x24 jam via email.</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-body contact-form">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="contact-info">
                <h3>Our Information</h3>
        
                <p><strong><i class="fas fa-map-marker-alt"></i> Address:</strong><br>
                Jl. Rajawali Jl. Jembatan Merah, Kota Lama,<br>
                Kec. Krembangan, Surabaya, Jawa Timur</p>
        
                <p><strong><i class="fas fa-phone"></i> Phone:</strong><br>
                (+62) 87778716996</p>
        
                <p><strong><i class="fas fa-envelope"></i> Email:</strong><br>
                jeep@gmail.com</p>
        
                <p><strong><i class="fas fa-clock"></i> Business Hours:</strong><br>
                Monday - Sunday: 8:00 AM - 6:00 PM</p>
            </div>
        </div>
    </div>
</div>
@endsection