@extends('layouts.app')

@section('title', 'Pesan Kamar')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <h2 style="margin-bottom: 2rem; display: inline-block; background: #76D9FF; padding: 0.8rem 1.5rem; border: 4px solid #000; box-shadow: 8px 8px 0 #000;">
        📝 FORM PEMESANAN
    </h2>

    <div class="card" style="margin-bottom: 2rem; background: #FFE951;">
        <h3 style="margin-bottom: 1.5rem; text-align: center; font-size: 1.8rem;">DETAIL KAMAR</h3>
        <div style="background: #000; color: #FFE951; padding: 2rem; border: 4px solid #FFE951;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div>
                    <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Nomor Kamar</p>
                    <p style="font-size: 1.8rem; font-weight: 700; letter-spacing: 1px;">{{ $room->room_number }}</p>
                </div>
                <div>
                    <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem; opacity: 0.8;">Tipe</p>
                    <p style="font-size: 1.4rem; font-weight: 700;">{{ $room->type }}</p>
                </div>
                <div style="grid-column: 1 / -1;">
                    <p style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.5rem; opacity: 0.8;">Fasilitas</p>
                    <p style="font-size: 1.1rem; font-weight: 600; line-height: 1.6;">{{ $room->facilities ?? 'Tidak ada info' }}</p>
                </div>
                <div style="grid-column: 1 / -1; border-top: 3px solid #FFE951; padding-top: 1rem; margin-top: 0.5rem;">
                    <p style="font-size: 0.9rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem;">Harga Sewa</p>
                    <p style="font-size: 2.5rem; font-weight: 700; letter-spacing: -1px;">
                        Rp {{ number_format($room->price, 0, ',', '.') }}
                        <span style="font-size: 1rem; opacity: 0.8;">/bulan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('bookings.store') }}" method="POST" class="card">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div style="margin-bottom: 2rem;">
            <label for="name" style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                👤 Nama Lengkap <span style="color: #FF6B9D;">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                style="width: 100%; padding: 1rem; border: 4px solid #000; font-size: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 600; box-shadow: 4px 4px 0 #000; background: #FFF;"
                placeholder="Contoh: Ahmad Wijaya">
            @error('name')
                <span style="display: block; margin-top: 0.5rem; color: #FF6B9D; font-weight: 700; padding: 0.5rem; background: rgba(255,107,157,0.1); border-left: 4px solid #FF6B9D;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label for="contact" style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                📱 Nomor Kontak <span style="color: #FF6B9D;">*</span>
            </label>
            <input type="text" id="contact" name="contact" value="{{ old('contact') }}" required
                style="width: 100%; padding: 1rem; border: 4px solid #000; font-size: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 600; box-shadow: 4px 4px 0 #000; background: #FFF;"
                placeholder="Contoh: 08123456789">
            @error('contact')
                <span style="display: block; margin-top: 0.5rem; color: #FF6B9D; font-weight: 700; padding: 0.5rem; background: rgba(255,107,157,0.1); border-left: 4px solid #FF6B9D;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div>
                <label for="duration_months" style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    📅 Durasi (Bulan) <span style="color: #FF6B9D;">*</span>
                </label>
                <input type="number" id="duration_months" name="duration_months" value="{{ old('duration_months', 1) }}" 
                    min="1" max="12" required
                    style="width: 100%; padding: 1rem; border: 4px solid #000; font-size: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 600; box-shadow: 4px 4px 0 #000; background: #FFF;"
                    placeholder="1-12 bulan">
                @error('duration_months')
                    <span style="display: block; margin-top: 0.5rem; color: #FF6B9D; font-weight: 700; padding: 0.5rem; background: rgba(255,107,157,0.1); border-left: 4px solid #FF6B9D;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="move_in_date" style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    📆 Tanggal Masuk <span style="color: #FF6B9D;">*</span>
                </label>
                <input type="date" id="move_in_date" name="move_in_date" value="{{ old('move_in_date') }}" 
                    min="{{ date('Y-m-d') }}" required
                    style="width: 100%; padding: 1rem; border: 4px solid #000; font-size: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 600; box-shadow: 4px 4px 0 #000; background: #FFF;">
                @error('move_in_date')
                    <span style="display: block; margin-top: 0.5rem; color: #FF6B9D; font-weight: 700; padding: 0.5rem; background: rgba(255,107,157,0.1); border-left: 4px solid #FF6B9D;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label for="notes" style="display: block; margin-bottom: 0.8rem; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">
                💬 Catatan Tambahan
            </label>
            <textarea id="notes" name="notes" rows="4"
                style="width: 100%; padding: 1rem; border: 4px solid #000; font-size: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 500; resize: vertical; box-shadow: 4px 4px 0 #000; background: #FFF;"
                placeholder="Masukkan catatan atau permintaan khusus">{{ old('notes') }}</textarea>
            @error('notes')
                <span style="display: block; margin-top: 0.5rem; color: #FF6B9D; font-weight: 700; padding: 0.5rem; background: rgba(255,107,157,0.1); border-left: 4px solid #FF6B9D;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
            <button type="submit" class="btn btn-success" style="flex: 1; font-size: 1.2rem; padding: 1.2rem;">
                ✓ KIRIM PEMESANAN
            </button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary" style="flex: 1; text-align: center; font-size: 1.2rem; padding: 1.2rem;">
                ✗ BATAL
            </a>
        </div>
    </form>
</div>

@push('styles')
<style>
    input:focus, textarea:focus {
        outline: none;
        background: #FFFEF0 !important;
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0 #000 !important;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        filter: invert(1);
        background: #000;
        padding: 5px;
        border-radius: 3px;
    }
</style>
@endpush
@endsection
