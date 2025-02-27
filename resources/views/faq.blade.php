@extends('layouts.app')

@section('title', 'FAQ')

@section('styles')
<style>
    .faq-header {
        background: linear-gradient(to right, var(--hunter-green), var(--fern-green));
        padding: 4rem 0 2rem;
        margin-bottom: 3rem;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-align: center;
        color: white;
    }
    
    .faq-header h1 {
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .faq-header .lead {
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .faq-section {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .faq-section h2 {
        margin-bottom: 2rem;
        color: var(--brunswick-green);
        position: relative;
        display: inline-block;
    }
    
    .faq-section h2:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background-color: var(--sage);
        bottom: -10px;
        left: 25%;
    }

    .accordion {
        max-width: 800px;
        margin: 0 auto 4rem;
    }

    .accordion-item {
        margin-bottom: 1rem;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .accordion-button {
        background-color: white;
        color: var(--brunswick-green);
        font-weight: 600;
        padding: 1.2rem 1.5rem;
        border: none;
        border-radius: 10px !important;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--fern-green);
        color: white;
        border-radius: 10px 10px 0 0 !important;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.125);
    }

    .accordion-button::after {
        background-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .accordion-body {
        background-color: white;
        padding: 1.5rem;
        line-height: 1.7;
        color: #555;
    }
    

    
    .faq-contact {
        background-color: rgba(163, 177, 138, 0.1);
        padding: 3rem 0;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 2rem;
    }
    
    .faq-contact h3 {
        color: var(--brunswick-green);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .faq-contact p {
        max-width: 600px;
        margin: 0 auto 1.5rem;
    }
</style>
@endsection

@section('content')
<!-- FAQ Header -->
<div class="faq-header">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <p class="lead">Find answers to common questions about our Jeep Adventure tours and services</p>
    </div>
</div>

<div class="container">
    <!-- FAQ Section Title -->
    <div class="faq-section">
        <h2>Common Questions</h2>
    </div>
    


    <!-- FAQ Accordion -->
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    Apa itu layanan Jeep Adventure?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Jeep Adventure adalah layanan wisata petualangan dengan menggunakan kendaraan jeep yang menawarkan pengalaman menjelajahi rute-rute off-road yang menantang. Kami menghadirkan pengalaman menarik untuk melihat pemandangan alam yang menakjubkan di berbagai lokasi wisata yang sulit dijangkau dengan kendaraan biasa. Semua jeep kami dilengkapi dengan peralatan keamanan dan dipandu oleh pengemudi yang berpengalaman.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    Bagaimana cara melakukan pemesanan tur?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Untuk melakukan pemesanan tur, Anda dapat mengklik tombol "Book Now" di situs web kami atau langsung menghubungi kami melalui nomor telepon atau email yang tertera. Kami menyarankan untuk melakukan pemesanan setidaknya 3 hari sebelum tanggal keberangkatan untuk memastikan ketersediaan. Setelah pemesanan, Anda akan menerima konfirmasi beserta detail tur melalui email.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Berapa biaya untuk mengikuti tur jeep?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Biaya tur bervariasi tergantung pada paket dan durasi perjalanan yang Anda pilih. Paket standar kami dimulai dari Rp500.000 per jeep (maksimal 4 orang) untuk durasi 3-4 jam. Untuk paket premium dengan durasi lebih lama dan fasilitas tambahan, biayanya berkisar antara Rp800.000 - Rp1.500.000. Semua biaya sudah termasuk bahan bakar, pengemudi/pemandu, air mineral, dan asuransi perjalanan.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    Apakah anak-anak diperbolehkan ikut dalam tur?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ya, anak-anak diperbolehkan ikut dalam tur kami, namun kami menyarankan agar anak berusia minimal 5 tahun untuk keamanan dan kenyamanan mereka. Kami juga menyediakan kursi khusus untuk anak-anak jika diperlukan, harap beritahu kami saat melakukan pemesanan. Orang tua atau wali bertanggung jawab untuk mengawasi anak-anak mereka selama perjalanan.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    Apa yang harus dipersiapkan sebelum mengikuti tur?
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sebelum mengikuti tur, kami menyarankan Anda untuk menyiapkan: 
                    <ul>
                        <li>Pakaian yang nyaman dan sesuai cuaca</li>
                        <li>Sepatu yang cocok untuk aktivitas outdoor</li>
                        <li>Tabir surya dan topi</li>
                        <li>Kamera atau ponsel untuk mengabadikan momen</li>
                        <li>Obat-obatan pribadi jika diperlukan</li>
                        <li>Jas hujan (terutama saat musim hujan)</li>
                    </ul>
                    Kami sudah menyediakan air mineral, namun Anda disarankan untuk membawa camilan jika diperlukan.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                    Apakah tur dapat dibatalkan atau dijadwalkan ulang?
                </button>
            </h2>
            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ya, Anda dapat membatalkan atau menjadwalkan ulang tur dengan ketentuan berikut:
                    <ul>
                        <li>Pembatalan 7 hari atau lebih sebelum tur: pengembalian dana 100%</li>
                        <li>Pembatalan 3-6 hari sebelum tur: pengembalian dana 50%</li>
                        <li>Pembatalan kurang dari 3 hari sebelum tur: tidak ada pengembalian dana</li>
                    </ul>
                    Penjadwalan ulang dapat dilakukan tanpa biaya tambahan jika dilakukan minimal 3 hari sebelum tanggal keberangkatan, tergantung pada ketersediaan. Dalam kondisi cuaca ekstrem, kami berhak membatalkan tur untuk keamanan dan akan menawarkan penjadwalan ulang atau pengembalian dana penuh.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                    Apakah tur jeep aman untuk semua orang?
                </button>
            </h2>
            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Tur jeep kami dirancang untuk memberikan pengalaman yang aman bagi semua peserta. Namun, karena sifat aktivitas off-road yang melibatkan medan yang tidak rata, kami tidak menyarankan tur untuk ibu hamil, orang dengan kondisi jantung serius, atau masalah punggung yang parah. Semua jeep kami secara rutin diperiksa keamanannya dan dilengkapi dengan sabuk pengaman serta peralatan keselamatan. Pemandu kami juga terlatih dalam pertolongan pertama dan protokol keselamatan.
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Section -->
    <div class="faq-contact">
        <div class="container">
            <h3>Tidak menemukan jawaban yang Anda cari?</h3>
            <p>Jika Anda memiliki pertanyaan lain yang tidak tercantum di atas, jangan ragu untuk menghubungi tim kami.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Hubungi Kami</a>
        </div>
    </div>
</div>


@endsection