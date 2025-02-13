@extends('layouts.app')

@section('title', 'FAQ')

@section('styles')
<style>
    .faq-header {
        background-color: var(--sage);
        padding: 1rem 0;
        margin-bottom: 3rem;
        border-radius: 15px;
        padding-top: 100px;
    }

    .faq-container {
        max-width: 800px;
        margin: 50px auto;
        background: var(--silver);
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .accordion-item {
        margin-bottom: 15px;
        border-radius: 20px;
        overflow: hidden;
    }

    .accordion-button {
        background-color: var(--sage);
        color: white;
        border-radius: 20px 20px 0 0 !important;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--fern-green);
        color: white;
        border-radius: 20px 20px 0 0 !important;
    }

    .accordion-collapse {
        border-top: none;
    }

    .accordion-body {
        background-color: var(--silver);
        border-radius: 0 0 20px 20px;
        padding: 15px;
    }

    .accordion-button:focus {
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<div class="faq-header text-center">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <p class="lead">Find answers to common questions about our jeep tours</p>
    </div>
</div>

{{-- <div class="container">
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    What should I bring for the jeep tour?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Recommended items include:
                    - Comfortable clothing
                    - Sunscreen
                    - Water bottle
                    - Camera
                    - Light jacket
                    - Comfortable shoes
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    What is your cancellation policy?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    - 48+ hours before tour: Full refund
                    - 24-48 hours before: 50% refund
                    - Less than 24 hours: No refund
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Are there age restrictions?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    - Minimum age: 10 years old
                    - Children under 16 must be accompanied by an adult
                    - Some tours have specific age requirements
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    Apa itu layanan ini?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Layanan ini menyediakan berbagai informasi mengenai ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    Bagaimana cara mendaftar?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Anda dapat mendaftar dengan mengklik tombol "Daftar" di bagian atas halaman ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Apakah ada biaya yang dikenakan?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tidak, layanan ini dapat digunakan secara gratis ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    Apakah ada biaya yang dikenakan?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tidak, layanan ini dapat digunakan secara gratis ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    Apakah ada biaya yang dikenakan?
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tidak, layanan ini dapat digunakan secara gratis ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                    Apakah ada biaya yang dikenakan?
                </button>
            </h2>
            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tidak, layanan ini dapat digunakan secara gratis ...
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                    Apakah ada biaya yang dikenakan?
                </button>
            </h2>
            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tidak, layanan ini dapat digunakan secara gratis ...
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection