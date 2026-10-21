@extends('layouts.app')

@section('title', 'Pemesanan Berhasil')

@section('content')
<div style="max-width: 700px; margin: 0 auto; text-align: center;">
    <div class="card">
        <div style="font-size: 5rem; margin-bottom: 1rem; animation: bounce 1s ease infinite;">✅</div>
        <h2 style="color: #000; margin-bottom: 1.5rem; font-size: 2.5rem; text-transform: uppercase; letter-spacing: -1px; line-height: 1.2;">
            PEMESANAN<br/>BERHASIL!
        </h2>
        <div style="background: #A8FF76; padding: 1.5rem; border: 4px solid #000; margin-bottom: 2rem; box-shadow: 6px 6px 0 #000;">
            <p style="color: #000; font-weight: 700; font-size: 1.1rem; line-height: 1.6;">
                Terima kasih telah melakukan pemesanan.<br/>
                Kami akan segera menghubungi Anda untuk konfirmasi.
            </p>
        </div>

        <div style="background: #000; color: #FFE951; padding: 2rem; border: 4px solid #FFE951; margin-bottom: 2rem; text-align: left;">
            <h3 style="text-align: center; margin-bottom: 1.5rem; font-size: 1.8rem; letter-spacing: 1px;">DETAIL PEMESANAN</h3>
            
            <div style="display: grid; gap: 1.2rem;">
                <div style="border-bottom: 2px solid #FFE951; padding-bottom: 1rem;">
                    <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Nomor Kamar</p>
                    <p style="font-size: 1.8rem; font-weight: 700; letter-spacing: 1px;">{{ $booking->room->room_number }}</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Nama Pemesan</p>
                        <p style="font-size: 1.2rem; font-weight: 700;">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Kontak</p>
                        <p style="font-size: 1.2rem; font-weight: 700;">{{ $booking->contact }}</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Durasi Sewa</p>
                        <p style="font-size: 1.2rem; font-weight: 700;">{{ $booking->duration_months }} Bulan</p>
                    </div>
                    <div>
                        <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Tanggal Masuk</p>
                        <p style="font-size: 1.2rem; font-weight: 700;">{{ $booking->move_in_date->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div style="border-top: 2px solid #FFE951; padding-top: 1rem; margin-top: 0.5rem;">
                    <p style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.5rem;">Total Biaya</p>
                    <p style="font-size: 3rem; font-weight: 700; letter-spacing: -2px; line-height: 1;">
                        Rp {{ number_format($booking->room->price * $booking->duration_months, 0, ',', '.') }}
                    </p>
                </div>

                <div style="background: rgba(255,233,81,0.2); padding: 1rem; border: 2px solid #FFE951; margin-top: 0.5rem;">
                    <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem;">Status</p>
                    <p style="font-size: 1.3rem; font-weight: 700;">{{ $booking->status }}</p>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 2rem;">
            <a href="{{ route('home') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
                🏠 KEMBALI KE BERANDA
            </a>
        </div>

        <div style="background: #FFF3CD; padding: 1.5rem; border: 4px solid #000; box-shadow: 4px 4px 0 #000;">
            <p style="color: #000; font-size: 1rem; font-weight: 600; line-height: 1.6;">
                💡 <strong>PENTING:</strong> Simpan informasi ini! Kami akan menghubungi Anda melalui nomor kontak yang Anda berikan untuk proses selanjutnya.
            </p>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
@endsection
