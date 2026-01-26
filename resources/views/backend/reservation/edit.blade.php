@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Ubah Data Reservasi
                    </div>

                    <div class="card-body">
                        <!-- Informasi Pemesan -->
                        {{-- 1st line --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase fw-bold text-muted mb-3">Details</h6>
                            <div class="row g-3">
                                <div class="">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Nama Pelanggan:</strong><br>{{$reservation->user->name}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Kode Reservasi:</strong><br>{{ $reservation->reserve_code }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Email Pelanggan:</strong><br>{{ $reservation->user->email }}
                                    </div>
                                </div>
                                {{-- 2nd line --}}
                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Tanggal Reservasi:</strong><br>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Waktu Reservasi:</strong><br>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }} WIB
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Jumlah Tamu:</strong><br>{{ $reservation->guest_count }} Orang
                                    </div>
                                </div>

                                {{-- 3rd line --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2 bg-light">
                                        <strong>Status Reservasi:</strong><br>
                                        <span>
                                            <span class="badge
                                                {{ $reservation->status == 'pending'
                                                    ? 'bg-warning text-dark'
                                                    : ($reservation->status == 'confirmed'
                                                        ? 'bg-primary'
                                                        : ($reservation->status == 'cancelled'
                                                            ? 'bg-danger'
                                                            : 'bg-success')) }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-2 bg-light">
                                        <strong>Status Pembayaran:</strong><br>
                                        <span>
                                            <span class="badge
                                                {{ $reservation->payment_status == 'unpaid'
                                                    ? 'bg-warning text-dark'
                                                    : ($reservation->payment_status == 'paid'
                                                        ? 'bg-success'
                                                        : 'bg-danger') }}">
                                                {{ ucfirst($reservation->payment_status) }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <hr>

                        <!-- Ubah Status -->
                        <div class="mb-4">
                            <h6 class="text-uppercase fw-bold text-muted mb-3">Ubah status</h6>
                            <form action="{{ route('backend.reservation.update', $reservation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-2">
                                    <div class="col-md-10">
                                        <select name="status" class="form-select" required>
                                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                            <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mt-3">
                                    <div class="col-md-10">
                                        <select name="payment_status" class="form-select" required>
                                            <option value="paid" {{ $reservation->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="unpaid" {{ $reservation->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mt-3">
                                    <div class="col-md-10">
                                        <textarea name="note" class="form-control" rows="3" placeholder="Catatan (opsional)">{{ old('note') }}</textarea>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Data Reservasi
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection