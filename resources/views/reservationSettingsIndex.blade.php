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

                    <h2 class="mb-4 fw-bold">Data Reservasi Anda</h2>

                    @if($reservations->isEmpty())
                        <p>Anda belum memiliki reservasi.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle" id="reservationTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Reservasi</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Jumlah Tamu</th>
                                        <th>Status Reservasi</th>
                                        <th>Status Pembayaran</th>
                                        <th>Order Menu</th>
                                        <th>Aksi</th>
                                        <th>Cancel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->reserve_code }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }} WIB</td>
                                            <td>{{ $reservation->guest_count }}</td>
                                            <td>{{ $reservation->status }}</td>
                                            <td>{{ $reservation->payment_status }}</td>
                                            <td>
                                                @if($reservation->status == 'cancelled' || $reservation->status == 'completed' || $reservation->status == 'confirmed')
                                                    <span class="text-muted">-</span>
                                                @else
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#placeOrderModal">
                                                    Buat Order
                                                </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->status == 'cancelled' || $reservation->status == 'completed' || $reservation->status == 'confirmed')
                                                    <span class="text-muted">-</span>
                                                @else
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" 
                                                class="btn-link-more btn btn-sm btn-light border-dark">
                                                    Edit
                                                </a>                              
                                                @endif
                                               
                                            </td>
                                            <td>
                                                @if($reservation->status == 'cancelled' || $reservation->status == 'completed' || $reservation->status == 'confirmed')
                                                    <span class="text-muted">-</span>
                                                @else
                                                 <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')">Cancel</button>
                                                    <input type="hidden" name="status" value="cancelled">
                                                </form> 
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

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

                    {{-- pop up menu --}}
                    @if(isset($reservation))
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
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-thumbnail" width="100">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                                        <td>
                                            <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $product->id }}">
                                            <input type="number" name="products[{{ $index }}][quantity]" min="0" value="0" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="products[{{ $index }}][note]" class="form-control" placeholder="Catatan (opsional)">
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
                    @endif
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
        $('#reservationTable').DataTable();

        $('#placeOrderTable').DataTable({
            info:false,
            responsive:true
        });
    });
    </script>
@endpush