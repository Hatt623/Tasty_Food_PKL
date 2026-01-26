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

                        {{-- Sejarah perubahan reservasi oleh operator --}}
                        <h6 class="text-uppercase fw-bold text-muted mb-3">Sejarah Perubahan oleh operator</h6>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table" id="datahistory">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Status lama </th>
                                            <th> Status baru </th>
                                            <th> Oleh Staff </th>
                                            <th> diubah pada </th>
                                            <th>Note</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @foreach ($reservationHistory as $data)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{ $data->old_status }} </td>
                                            <td> {{ $data->new_status }} </td>
                                            <td> {{ $data->staff_name }} </td>
                                            <td> {{ $data->created_at }} </td>
                                            <td> {{ $data->note }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <hr>
                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Data Reservasi
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#datahistory').DataTable();
    });
    </script>
@endpush