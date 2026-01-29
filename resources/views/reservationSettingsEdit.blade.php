@extends('layouts.frontend-2')

@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">UPDATE RESERVASI</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->

        <section>
            <div class="container py-5">
                <div class="contact-section" data-aos="fade-up" data-aos-delay="100">

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
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $index => $product)
                                                <tr>
                                                    <td>
                                                        <img src="../../{{$product->image }}" alt="{{ $product->name }}" class="img-thumbnail" width="100">
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                                                    <td>
                                                        <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $product->id }}">
                                                        <input type="number" name="products[{{ $index }}][quantity]" min="0" value="{{ $product->reserved_quantity }}" class="form-control">
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
                                    <button type="submit" class="btn sm btn-dark">Submit Order</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <h2 class="mb-4 fw-bold">Reservasi</h2>
                    <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12 d-flex flex-column gap-3">
                                <div>
                                    <input type="number" name="guest_count" value="{{old ('guest_count', $reservation->guest_count)}}" class="form-control @error('guest_count') is-invalid @enderror" id="guest_count" placeholder="Guest Count" min="1" max="100" required>
                            
                                    @error('guest_count')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex flex-column gap-3">
                                <div>
                                    <input type="date" name="reservation_date" value="{{old ('reservation_date', $reservation->reservation_date)}}" class="form-control @error('reservation_date') is-invalid @enderror" id="reservation_date" placeholder="Reservation Date" required>
                                
                                    @error('reservation_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex flex-column gap-3">
                                <div>
                                    <input type="time" name="reservation_time" value="{{old ('reservation_time', $reservation->reservation_time)}}" class="form-control @error('reservation_time') is-invalid @enderror" id="reservation_time" placeholder="Reservation Time" required>
                                
                                    @error('reservation_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg">UPDATE RESERVASI</button>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="card">
                                {{-- Pesanan --}}
                                <div class="card-header ">
                                    <h5>Detail Pesanan</h5>
                                    <br>
                                    <h5 style="text-decoration: underline;">Total Harga Pesanan Anda: RP {{ number_format($reservation->total_price,0,',','.') }}</h5>
                                    <button type="button" class="btn btn-dark btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#placeOrderModal">
                                        Buat Order Baru
                                    </button>
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
                                                    <th> catatan </th>
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

                            <div class="row mt-4">
                                <div class="col-12 d-grid">
                                    <button class="btn btn-dark btn-lg"><a style="color:white; text-decoration:none;" href="{{route ('reservation.settings.index')}}">Kembali</a></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info mt-5">
                        <div class="row text-center g-4">
                            <!-- Email -->
                            <div class="col-md-4">
                            <i class="bi bi-envelope-fill fs-1 d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">EMAIL</h6>
                            <span>Delicacy@gmail.com</span>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-4">
                            <i class="bi bi-telephone-fill fs-1 d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">PHONE</h6>
                            <span>+62 820 3456 7890</span>
                            </div>

                            <!-- Location -->
                            <div class="col-md-4">
                            <i class="bi bi-geo-alt-fill fs-1 d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">LOCATION</h6>
                            <span>Kota Bandung, Jawa Barat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map -->
        <section class="light-background">
            <div class="container py-1">
                <div class="map-container" data-aos="fade-up" data-aos-delay="100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63344.39168152261!2d107.560755!3d-6.934469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7f3e0f1b3a1%3A0x401e8f1fc28c6e0!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1694012345678"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
        
    </main>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#placeOrderTable').DataTable({
            info:false,
            responsive:true
        });
    });
    </script>
@endpush