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
                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Kode Reservasi:</strong><br>{{ $reservation->reserve_code }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Email Pelanggan:</strong><br>{{ $reservation->user->email }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Telepon Pelanggan:</strong><br>{{ $reservation->user->phone }}
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
                                        <h5 class="modal-title">Silahkan pilih menu </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="table-responsive">
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn sm btn-info">Submit Order</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                       {{-- Desktop Ver--}}
                        <div class="d-none d-md-block">
                            <div class="table-responsive">
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
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $products->name }}</td>
                                            <td>Rp {{ number_format($products->price, 0, ',', '.') }}</td>
                                            <td>{{ $products->pivot->quantity }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editNoteModal{{ $products->id }}">
                                                     lihat/Edit Catatan
                                                </button>
                                                
                                                <div class="modal fade" id="editNoteModal{{ $products->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Catatan: {{ $products->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            
                                                            {{-- Form diarahkan ke route update yang sama --}}
                                                            <form action="{{ route('reservation.products.update', [$reservation->id, $products->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                
                                                                <div class="modal-body text-start">
                                                                    <div class="mb-3">
                                                                        <label for="note{{ $products->id }}" class="form-label">Isi Catatan</label>
                                                                        {{-- Gunakan textarea agar lebih mudah menulis pesan panjang --}}
                                                                        <textarea name="note" id="note{{ $products->id }}" class="form-control" rows="4" placeholder="Masukkan catatan di sini...">{{ $products->pivot->note }}</textarea>
                                                                    </div>
                                                                    
                                                                    {{-- Hidden input untuk quantity agar nilainya tidak ter-reset saat update catatan --}}
                                                                    <input type="hidden" name="quantity" value="{{ $products->pivot->quantity }}">
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('reservation.products.update', [$reservation->id, $products->id]) }}" method="POST" class="d-inline">
                                                    @csrf @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $products->pivot->quantity }}" class="form-control d-inline w-25" min="1">
                                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                </form>
                                                <form action="{{ route('reservation.products.destroy', [$reservation->id, $products->id]) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Mobile ver --}}
                        <div class="d-md-none">
                            @foreach ($reservation->products as $products)
                            <div class="card mb-3 border shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ $products->name }}</h6>
                                            <small class="text-muted">Rp {{ number_format($products->price, 0, ',', '.') }} / item</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">x{{ $products->pivot->quantity }}</span>
                                    </div>

                                    <div class="bg-light p-2 rounded mb-3 small">
                                        <strong>Catatan:</strong> {{ $products->pivot->note ?? '-' }}
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-primary btn-sm flex-grow-1" data-bs-toggle="collapse" data-bs-target="#editMobile{{ $products->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('reservation.products.destroy', [$reservation->id, $products->id]) }}" method="POST" class="flex-grow-1">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm w-100">Hapus</button>
                                        </form>
                                    </div>

                                    {{-- collapse  --}}
                                    <div class="collapse mt-3" id="editMobile{{ $products->id }}">
                                        <form action="{{ route('reservation.products.update', [$reservation->id, $products->id]) }}" method="POST" class="border-top pt-3">
                                            @csrf @method('PUT')
                                            <div class="mb-2">
                                                <label class="form-label small">Jumlah</label>
                                                <input type="number" name="quantity" value="{{ $products->pivot->quantity }}" class="form-control form-control-sm" min="1">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small">Catatan Baru</label>
                                                <input type="text" name="note" value="{{ $products->pivot->note }}" class="form-control form-control-sm">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
                                        @foreach ($reservationHistory as $History)
                                        <tr>
                                            <td> {{$loop->iteration}} </td>
                                            <td> {{ $History->old_status }} </td>
                                            <td> {{ $History->new_status }} </td>
                                            <td> {{ $History->staff_name }} </td>
                                            <td> {{ $History->created_at }} </td>
                                            {{-- <td> {{ $History->note }} </td> --}}
                                              <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#seeNoteStaffModal{{ $History->id }}">
                                                    Lihat Catatan
                                                </button>
                                                
                                                <div class="modal fade" id="seeNoteStaffModal{{ $History->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Catatan Oleh: {{ $History->staff_name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ $History->note ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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