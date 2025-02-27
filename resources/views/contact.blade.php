@extends('layouts.app')

@section('title', 'Contact')

@section('styles')
<style>
    .contact-header {
        background: linear-gradient(to right, var(--hunter-green), var(--fern-green));
        padding: 4rem 0 2rem;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        margin-bottom: 3rem;
        text-align: center;
        color: white;
    }
    
    .contact-header h1 {
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .contact-header .lead {
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    .contact-section h2 {
        margin-bottom: 2rem;
        color: var(--brunswick-green);
        position: relative;
        display: inline-block;
    }
    
    .contact-section h2:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background-color: var(--sage);
        bottom: -10px;
        left: 25%;
    }
    
    .contact-section {
        text-align: center;
        margin-bottom: 3rem;
    }

    .contact-info {
        background-color: white;
        padding: 2rem;
        border-radius: 10px;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--fern-green);
    }
    
    .contact-info h3 {
        color: var(--brunswick-green);
        margin-bottom: 1.5rem;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }
    
    .contact-info h3:after {
        content: '';
        position: absolute;
        width: 40px;
        height: 2px;
        background-color: var(--sage);
        bottom: 0;
        left: 0;
    }

    .contact-info p {
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
    }
    
    .contact-info i {
        margin-right: 15px;
        background-color: var(--sage);
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 3px;
    }
    
    .contact-info strong {
        color: var(--brunswick-green);
        display: block;
        margin-bottom: 5px;
    }

    .contact-form {
        background-color: white;
        padding: 2.5rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .contact-form .form-label {
        color: var(--brunswick-green);
        font-weight: 500;
    }
    
    .contact-form .form-control {
        padding: 0.8rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }
    
    .contact-form .form-control:focus {
        border-color: var(--fern-green);
        box-shadow: 0 0 0 0.25rem rgba(88, 129, 87, 0.25);
    }
    
    .contact-form .btn-primary {
        padding: 0.8rem 2rem;
        font-weight: 500;
        margin-top: 1rem;
    }
    
    .map-container {
        height: 400px;
        margin-top: 4rem;
        margin-bottom: 0;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<!-- Contact Header -->
<div class="contact-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p class="lead">Feedback akan dibalas paling lambat 3x24 jam via email.</p>
    </div>
</div>

<div class="container">
    <!-- Contact Section Title -->
    <div class="contact-section">
        <h2>Get In Touch</h2>
    </div>
    
    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-7 mb-4">
            <div class="contact-form">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="col-lg-5">
            <div class="contact-info">
                <h3>Our Information</h3>
        
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>
                        <strong>Address</strong>
                        Jl. Rajawali Jl. Jembatan Merah, Kota Lama,<br>
                        Kec. Krembangan, Surabaya, Jawa Timur
                    </span>
                </p>
        
                <p>
                    <i class="fas fa-phone"></i>
                    <span>
                        <strong>Phone</strong>
                        (+62) 87778716996
                    </span>
                </p>
        
                <p>
                    <i class="fas fa-envelope"></i>
                    <span>
                        <strong>Email</strong>
                        jeep@gmail.com
                    </span>
                </p>
        
                <p>
                    <i class="fas fa-clock"></i>
                    <span>
                        <strong>Business Hours</strong>
                        Monday - Sunday: 8:00 AM - 6:00 PM
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Google Map -->
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.0833097709076!2d112.73741817488753!3d-7.235275792763589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f92b1bdd7971%3A0xbf91bf2a59fcf75b!2sJembatan%20Merah%2C%20Krembangan%20Sel.%2C%20Kec.%20Krembangan%2C%20Surabaya%2C%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1708661572056!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection