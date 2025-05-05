@extends('layouts.app')

@section('title', 'Booking')

@section('styles')
    <style>
        .booking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Modern Stepper Design */
        .stepper-wrapper {
            position: relative;
            padding: 30px 0;
            margin-bottom: 40px;
        }

        .stepper-line {
            position: absolute;
            top: 38%;
            left: 15%;
            right: 15%;
            height: 2px;
            background: var(--silver);
            z-index: 1;
        }

        .stepper-line-progress {
            position: absolute;
            height: 100%;
            background: var(--hunter-green);
            transition: width 0.3s ease;
        }

        .steps-nav {
            position: relative;
            z-index: 2;
            background: transparent;
        }

        .step-item {
            position: relative;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--silver);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            font-weight: 600;
        }

        .step-circle.completed {
            background: var(--hunter-green);
            border-color: var(--hunter-green);
        }

        .step-circle.completed::after {
            content: '✓';
            color: white;
            font-size: 20px;
        }

        .step-circle.active {
            border-color: var(--hunter-green);
            background: white;
            box-shadow: 0 0 0 3px rgba(58, 90, 64, 0.2);
            color: var(--hunter-green);
        }

        .step-title {
            font-weight: 500;
            color: var(--brunswick-green);
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .card-title {
            color: var(--brunswick-green);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 30px;
        }

        /* Form Elements */
        .form-label {
            color: var(--brunswick-green);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #eee;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 1rem;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--hunter-green);
            box-shadow: 0 0 0 3px rgba(58, 90, 64, 0.1);
            outline: none;
        }

        .form-control.is-valid {
            border-color: var(--fern-green);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        /* Date Picker */
        input[type="date"] {
            position: relative;
            padding-right: 40px;
            cursor: pointer;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            filter: invert(0.4);
        }

        /* Custom Select */
        .custom-select {
            position: relative;
        }

        .custom-select select {
            appearance: none;
            width: 100%;
            cursor: pointer;
        }

        .custom-select::after {
            content: '▼';
            font-size: 0.8rem;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--brunswick-green);
            pointer-events: none;
        }

        /* Button */
        .btn-custom {
            background: var(--hunter-green);
            color: white;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-custom:hover {
            background: var(--brunswick-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-custom:active {
            transform: translateY(0);
        }
    </style>
@endsection

@section('content')
<!-- <div class="faq-header text-center">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <p class="lead">Find answers to common questions about our jeep tours</p>
    </div>
</div> -->

<div class="booking-container">
    <!-- Stepper -->
    <div class="stepper-wrapper">
        <div class="stepper-line">
            <div class="stepper-line-progress" style="width: 0%"></div>
        </div>
        <div class="steps-nav">
            <div class="row text-center">
                <div class="col-4 step-item">
                    <div class="step-circle active" data-step="1">1</div>
                    <span class="step-title">Pilih Sesi</span>
                </div>
                <div class="col-4 step-item">
                    <div class="step-circle" data-step="2">2</div>
                    <span class="step-title">Data Diri</span>
                </div>
                <div class="col-4 step-item">
                    <div class="step-circle" data-step="3">3</div>
                    <span class="step-title">Pembayaran</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 1: Pilih Sesi -->
    <div id="step1" class="content-card">
        <h3 class="card-title">Pilih Sesi Kunjungan</h3>
        
        <div class="mb-4">
            <label class="form-label">Pilih Hari (Sabtu/Minggu)</label>
            <input type="date" class="form-control" id="visitDate">
            <div class="invalid-feedback">
                Harap pilih hari Sabtu atau Minggu
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Pilih Sesi</label>
            <div class="custom-select">
                <select class="form-control" id="sessionSelect" disabled>
                    <option value="">Pilih sesi kunjungan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Step 2: Data Diri -->
    <div id="step2" class="content-card" style="display: none;">
        <h3 class="card-title">Data Diri</h3>
        
        <form id="personalDataForm">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan nama lengkap" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="contoh@email.com" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. Telepon</label>
                    <input type="tel" class="form-control" name="telp" placeholder="Contoh: 08123456789" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-control" name="city" placeholder="Masukkan kota Anda" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jumlah Pengunjung</label>
                    <input type="number" class="form-control" name="count" min="1" placeholder="Masukkan jumlah pengunjung" required>
                </div>

                <div class="col-12 mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">
                            Saya dan/atau rombongan telah membaca, memahami, setuju dan bertanggung jawab dengan segala resiko berdasarkan seluruh syarat & ketentuan yang telah ditetapkan di atas.
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Step 3: Pembayaran -->
    <div id="step3" class="content-card" style="display: none;">
        <h3 class="card-title">Pembayaran</h3>
        
        <div class="payment-summary mb-4">
            <h4>Ringkasan Pembayaran</h4>
            <div id="paymentSummary" class="card">
                <div class="card-body">
                    <!-- Will be filled dynamically -->
                </div>
            </div>
        </div>

        <div class="payment-methods mb-4">
            <h4>Metode Pembayaran</h4>
            <div class="payment-option">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/qris-logo.png') }}" alt="QRIS" style="width: 60px; height: auto;">
                            <div class="ms-3">
                                <h5 class="mb-0">QRIS</h5>
                                <p class="mb-0 text-muted">Pembayaran menggunakan QRIS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="qrisContainer" style="text-align: center; display: none;">
            <h4>Scan QRIS untuk melakukan pembayaran</h4>
            <img id="qrisImage" src="" alt="QRIS Code" style="width: 250px; height: 250px;">
        </div>
        
        <button id="payButton" class="btn btn-primary w-100">Bayar dengan QRIS</button>
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <button id="prevBtn" class="btn btn-secondary" style="display: none;">Sebelumnya</button>
        <button id="nextBtn" class="btn btn-primary">Selanjutnya</button>
    </div>
</div>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    let formData = {};
    let selectedSession = null;
    
    // Elements
    const visitDate = document.getElementById('visitDate');
    const sessionSelect = document.getElementById('sessionSelect');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const termsCheck = document.getElementById('termsCheck');
    const payButton = document.getElementById('payButton');
    const qrisContainer = document.getElementById('qrisContainer');
    const qrisImage = document.getElementById('qrisImage');

    // CSRF Token
    const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMetaTag) {
        console.error('CSRF token meta tag not found!');
        return;
    }
    const csrfToken = csrfMetaTag.content;

    // Date input handler
    visitDate.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const day = selectedDate.getDay();

        if (selectedDate < today) {
            alert('Mohon pilih tanggal yang tidak lebih awal dari hari ini');
            this.value = '';
            this.classList.add('is-invalid');
            sessionSelect.disabled = true;
        } else if (day !== 0 && day !== 6) {
            alert('Mohon pilih hari Sabtu atau Minggu');
            this.value = '';
            this.classList.add('is-invalid');
            sessionSelect.disabled = true;
        } else {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
            loadSessions(this.value);
        }
    });

    // Load sessions
    function loadSessions(date) {
        fetch(`/get-sessions?date=${date}`)
            .then(response => response.json())
            .then(data => {
                sessionSelect.innerHTML = '<option value="">Pilih sesi kunjungan</option>';
                
                if (data.length > 0) {
                    data.forEach(session => {
                        const formattedTime = new Date(`2000-01-01T${session.session_time}`).toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        
                        sessionSelect.innerHTML += `
                            <option value="${session.id}" data-time="${session.session_time}">
                                ${formattedTime} (Sisa kuota: ${session.passenger_count})
                            </option>`;
                    });
                    sessionSelect.disabled = false;
                } else {
                    alert('Tidak ada sesi tersedia untuk tanggal ini');
                    sessionSelect.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat sesi');
            });
    }

    // Session select handler
    sessionSelect.addEventListener('change', function() {
        selectedSession = this.value;
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption) {
            formData.session_time = visitDate.value + ' ' + selectedOption.dataset.time;
        }
    });

    // Navigation handlers
    nextBtn.addEventListener('click', () => {
        if (validateCurrentStep()) {
            if (currentStep === 2 && !termsCheck.checked) {
                alert('Anda harus menyetujui syarat dan ketentuan untuk melanjutkan');
                return;
            }

            if (currentStep === 2) {
                // Collect and store form data
                const form = document.getElementById('personalDataForm');
                const formElements = new FormData(form);
                
                for (let [key, value] of formElements.entries()) {
                    formData[key] = value;
                }
                
                formData.session_id = selectedSession;

                // Store reservation
                fetch('/store-reservation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Server responded with status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        formData.reservation_id = data.reservation_id;
                        formData.total_price = data.total_price;
                        formData.session_time = data.session_time;
                        updatePaymentSummary();
                        currentStep++;
                        updateUI();
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat menyimpan data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
                });
            } else if (currentStep < totalSteps) {
                currentStep++;
                updateUI();
            }
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateUI();
        }
    });

    // Validation functions
    function validateCurrentStep() {
        switch(currentStep) {
            case 1:
                if (!visitDate.value) {
                    alert('Mohon pilih tanggal kunjungan');
                    visitDate.focus();
                    return false;
                }
                if (!sessionSelect.value) {
                    alert('Mohon pilih sesi kunjungan');
                    sessionSelect.focus();
                    return false;
                }
                return true;

            case 2:
                const form = document.getElementById('personalDataForm');
                const formElements = form.elements;
                
                for (let element of formElements) {
                    if (element.hasAttribute('required') && !element.value) {
                        alert(`Mohon isi ${element.previousElementSibling.textContent}`);
                        element.focus();
                        return false;
                    }

                    if (element.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(element.value)) {
                            alert('Format email tidak valid');
                            element.focus();
                            return false;
                        }
                    }

                    if (element.name === 'telp') {
                        const phoneRegex = /^[0-9]{10,}$/;
                        if (!phoneRegex.test(element.value)) {
                            alert('Nomor telepon harus berisi minimal 10 digit angka');
                            element.focus();
                            return false;
                        }
                    }

                    if (element.name === 'count') {
                        const count = parseInt(element.value);
                        if (count < 1) {
                            alert('Jumlah pengunjung minimal 1 orang');
                            element.focus();
                            return false;
                        }
                    }
                }
                return true;

            case 3:
                return true;
        }
    }

    // UI update function
    function updateUI() {
        // Update progress bar
        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        document.querySelector('.stepper-line-progress').style.width = `${progress}%`;

        // Update step circles
        document.querySelectorAll('.step-circle').forEach((circle, index) => {
            if (!circle.dataset.originalText) {
                circle.dataset.originalText = circle.textContent;
            }

            circle.classList.remove('active', 'completed');

            if (index + 1 < currentStep) {
                circle.classList.add('completed');
                circle.textContent = '';
            } else if (index + 1 === currentStep) {
                circle.classList.add('active');
                circle.textContent = circle.dataset.originalText;
            } else {
                circle.textContent = circle.dataset.originalText;
            }
        });

        // Show/hide steps
        document.querySelectorAll('.content-card').forEach((card, index) => {
            card.style.display = index + 1 === currentStep ? 'block' : 'none';
        });

        // Update navigation buttons
        prevBtn.style.display = currentStep === 1 ? 'none' : 'block';
        nextBtn.style.display = currentStep === totalSteps ? 'none' : 'block';
        payButton.style.display = currentStep === totalSteps ? 'block' : 'none';
    }

    // Payment summary update
    function updatePaymentSummary() {
        const summary = document.getElementById('paymentSummary');
        if (!summary) return;
        
        const sessionDate = new Date(formData.session_time.split(' ')[0]);
        const formattedDate = sessionDate.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        
        const sessionTime = formData.session_time.split(' ')[1];
        const formattedTime = new Date(`2000-01-01T${sessionTime}`).toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        
        summary.innerHTML = `
            <div class="p-3">
                <div class="d-flex justify-content-between mb-2">
                    <span>Tanggal Kunjungan:</span>
                    <span>${formattedDate}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Jam Kunjungan:</span>
                    <span>${formattedTime}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Jumlah Pengunjung:</span>
                    <span>${formData.count} orang</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Harga per Orang:</span>
                    <span>Rp ${new Intl.NumberFormat('id-ID').format(45000)}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total Pembayaran:</span>
                    <span>Rp ${new Intl.NumberFormat('id-ID').format(formData.total_price)}</span>
                </div>
            </div>
        `;
    }

    // QRIS Payment handler
    payButton.addEventListener('click', function() {
        this.disabled = true;
        this.textContent = 'Memproses...';

        fetch('/pay-qris', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                amount: formData.total_price,
                name: formData.name,
                email: formData.email,
                phone: formData.telp,
                reservation_id: formData.reservation_id
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show QRIS container and set image if available
                if (data.qris_url) {
                    qrisImage.src = data.qris_url;
                    qrisContainer.style.display = 'block';
                    payButton.style.display = 'none';
                } else {
                    // Use Snap if no direct QRIS URL
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            alert('Pembayaran berhasil!');
                            window.location.href = `/booking/confirmation/${formData.reservation_id}`;
                        },
                        onPending: function(result) {
                            alert('Menunggu pembayaran Anda');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                            payButton.disabled = false;
                            payButton.textContent = 'Bayar dengan QRIS';
                        },
                        onClose: function() {
                            payButton.disabled = false;
                            payButton.textContent = 'Bayar dengan QRIS';
                        }
                    });
                }
            } else {
                alert(data.message || 'Terjadi kesalahan saat memproses pembayaran');
                payButton.disabled = false;
                payButton.textContent = 'Bayar dengan QRIS';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.response) {
                error.response.text().then(text => {
                    console.error('Response body:', text);
                    alert('Terjadi kesalahan saat memproses pembayaran: ' + text);
                });
            } else {
                alert('Terjadi kesalahan saat memproses pembayaran: ' + error.message);
            }
            payButton.disabled = false;
            payButton.textContent = 'Bayar dengan QRIS';
        });
    });
});
</script>
@endsection