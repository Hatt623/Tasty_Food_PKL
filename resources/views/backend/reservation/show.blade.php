@extends('layouts.backend')

@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Ubah products Reservasi
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
                                {{-- 2nd line --}}
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
                                {{-- 3nd line --}}
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

                                {{-- 4th line --}}
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

                                 {{-- 5th line --}}
                                <div class="">
                                    <div class="border rounded p-3 bg-light ">
                                        <h5 style="text-decoration: underline; align-content: center">Total Harga Pesanan: RP {{ number_format($reservation->total_price,0,',','.') }}</h5>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <hr>
                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke products Reservasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        {{-- Pesanan --}}
                        <div class="card-header bg-secondary text-white">
                            Detail Pesanan

                            <button type="button" class="btn btn-info btn-sm" style="color:white; float: right;" data-bs-toggle="modal" data-bs-target="#placeOrderModal">
                                Buat Order
                            </button>
                        </div>

                        {{-- pop up menu --}}
                        <div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="placeOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                <form action="{{ route('reservation.products.store', $reservation->id) }}" method="post" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Silahkan pilih menu anda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <table class="table table-bordered align-middle" id="placeOrderTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Gambar</th>
                                                    <th>Menu</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $index => $product)
                                                    <tr>
                                                        <td>
                                                            <img src="../../{{ $product->image }}" alt="{{ $product->name }}" class="img-thumbnail" width="100">
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $product->id }}">
                                                            <input type="number" name="products[{{ $index }}][quantity]" min="0" value="{{$product->reserved_quantity}}" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="products[{{ $index }}][note]" value="{{$product->reserved_note}}" class="form-control" placeholder="Catatan (opsional)">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn sm btn-info">Submit Order</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table" id="DetailPesanan">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Nama Produk </th>
                                            <th> Harga Satuan </th>
                                            <th> Kuantitas </th>
                                            <th> Catatan </th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
 
                                    <tbody>
                                        @foreach ($reservation->products as $products)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{ $products->name }} </td> 
                                            <td> Rp {{ number_format($products->price, 0, ',', '.') }} </td>
                                            <td> {{ $products->pivot->quantity }} </td>
                                            <td> {{ $products->pivot->note }} </td>

                                            <td>
                                                <!-- Edit -->
                                                <form action="{{ route('reservation.products.update', [$reservation->id, $products->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $products->pivot->quantity }}" min="1" class="form-control d-inline w-25">
                                                    <input type="text" name="note" value="{{ $products->pivot->note }}" class="form-control d-inline w-50">
                                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('reservation.products.destroy', [$reservation->id, $products->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        {{-- Sejarah perubahan reservasi oleh operator --}}
                        <div class="card-header bg-secondary text-white">
                            Sejarah Perubahan oleh operator
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table" id="ProductsHistory">
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
                                        @foreach ($reservationHistory as $products)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{ $products->old_status }} </td>
                                            <td> {{ $products->new_status }} </td>
                                            <td> {{ $products->staff_name }} </td>
                                            <td> {{ $products->created_at }} </td>
                                            <td> {{ $products->note }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        $('#ProductsHistory').DataTable({
            info:false,
            responsive:true
        });

        $('#DetailPesanan').DataTable({
            info:false,
            responsive:true
        });

        $('#placeOrderTable').DataTable({
            info:false,
            responsive:true
        });
    });
    </script>
@endpush