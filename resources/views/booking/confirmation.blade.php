@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Detail Reservasi</h4>
                </div>
                <div class="card-body">
                    @if($reservation->payment_status === 'paid')
                        <div class="alert alert-success mb-4">
                            <h5 class="alert-heading"><i class="fas fa-check-circle"></i> Pembayaran Berhasil!</h5>
                            <p class="mb-0">Reservasi Anda telah dikonfirmasi dan tiket Anda sudah dipesan.</p>
                        </div>
                    @elseif($reservation->payment_status === 'pending')
                        <div class="alert alert-warning mb-4">
                            <h5 class="alert-heading"><i class="fas fa-clock"></i> Menunggu Pembayaran</h5>
                            <p class="mb-0">Silakan selesaikan pembayaran Anda sebelum batas waktu habis.</p>
                            @if($reservation->expires_at)
                                <p class="mt-2 mb-0">Batas waktu: {{ $reservation->expires_at->format('d M Y H:i') }}</p>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-danger mb-4">
                            <h5 class="alert-heading"><i class="fas fa-times-circle"></i> Pembayaran Gagal</h5>
                            <p class="mb-0">Pembayaran Anda gagal atau telah dibatalkan. Silakan coba lagi.</p>
                        </div>
                    @endif

                    <div class="reservation-details">
                        <h5 class="card-title">Informasi Reservasi</h5>
                        <hr>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">ID Reservasi:</p>
                                <p class="font-weight-bold">#{{ $reservation->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Status Pembayaran:</p>
                                <p>
                                    @if($reservation->payment_status === 'paid')
                                        <span class="badge bg-success">Dibayar</span>
                                    @elseif($reservation->payment_status === 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Nama:</p>
                                <p class="font-weight-bold">{{ $reservation->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Email:</p>
                                <p>{{ $reservation->email }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">No. Telepon:</p>
                                <p>{{ $reservation->telp }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Kota:</p>
                                <p>{{ $reservation->city }}</p>
                            </div>
                        </div>
                        
                        <h5 class="card-title mt-4">Detail Kunjungan</h5>
                        <hr>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Tanggal:</p>
                                <p>{{ \Carbon\Carbon::parse($reservation->session->date)->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Sesi:</p>
                                <p>{{ \Carbon\Carbon::parse($reservation->session->session_time)->format('H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Jumlah Pengunjung:</p>
                                <p>{{ $reservation->count }} orang</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Total Pembayaran:</p>
                                <p class="font-weight-bold">Rp {{ number_format($reservation->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        @if($reservation->payment_status === 'paid')
                            <div class="mt-4">
                                <h5 class="card-title">Informasi Tiket</h5>
                                <hr>
                                
                                <div class="alert alert-info">
                                    <p class="mb-1"><strong>Petunjuk:</strong></p>
                                    <ol class="mb-0">
                                        <li>Tunjukkan halaman ini kepada petugas saat tiba di lokasi</li>
                                        <li>Mohon datang 15 menit sebelum jadwal keberangkatan</li>
                                        <li>Jika ada pertanyaan, hubungi customer service kami</li>
                                    </ol>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button class="btn btn-primary" onclick="window.print()">
                                    <i class="fas fa-print"></i> Cetak Tiket
                                </button>
                            </div>
                        @elseif($reservation->payment_status === 'pending' && now()->lt($reservation->expires_at))
                            <div class="text-center mt-4">
                                <a href="/booking" class="btn btn-primary">
                                    Kembali ke Halaman Pembayaran
                                </a>
                            </div>
                        @else
                            <div class="text-center mt-4">
                                <a href="/booking" class="btn btn-primary">
                                    Pesan Ulang
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection