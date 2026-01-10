@extends('layouts.frontend-2')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">GALERI KAMI</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->
      
        {{-- Carousel featured products --}}
        <section id="carousel-featured" class="carousel-featured py-5 light-background">
            <div class="container">
                <div class="row gy-4 align-items-start">
                <div class="mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">

                    <div id="carouselFeatured" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        @foreach($featuredproducts as $index => $data)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img 
                                src="{{ asset($data->image) }}" 
                                class="d-block w-100" 
                                alt="{{ $data->name }}"
                                >
                            </div>
                        @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatured" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Sebelumnya</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatured" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Berikutnya</span>
                        </button>
                    </div>

                    </div>
                </div>
                </div>
            </div>
        </section>
        {{-- akhir Carousel featured products --}}

        <!-- Galeri -->
        <section id="galeri" class="galerry section">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                @foreach($products as $index => $data)
                    <div class="col-lg-3 gallery-item" style="{{ $index >= 12 ? 'display:none;' : '' }}" data-aos="fade-up" data-aos-delay="{{ 250 + ($index * 50) }}">
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <a href="{{ asset($data->image) }}" class="glightbox">
                                <img
                                    src="{{ asset($data->image) }}"
                                    alt="Gallery Image"
                                    class="card-img-top img-fluid"
                                >
                            </a>
                        </div>
                        {{-- Rating--}}
                        @if (Auth::check())
                        <form action="{{ route('reviews.store', $data->id) }}" method="POST">
                            @csrf
                            <select name="rating" class="form-select mt-2">
                                <option hidden>Rate</option>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-dark mt-2">Rate</button>
                        </form>
                        @endif
                        <p class="lead mt-2">Rating: {{ number_format($data->reviews()->avg('rating'), 1) }}/5</p>
                        {{-- Akhir rating --}}
                    </div>
                @endforeach
                </div>

                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="#" id="loadMoreBtn" class="btn-load-more">
                        Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </section>
        <!-- alkhir galeri -->
    </main>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const items = document.querySelectorAll(".gallery-item");
        const loadMoreBtn = document.getElementById("loadMoreBtn");
        let visibleCount = 4; 

        loadMoreBtn.addEventListener("click", function (e) {
            e.preventDefault();

            let nextCount = visibleCount + 4; 
            for (let i = visibleCount; i < nextCount && i < items.length; i++) {
                items[i].style.display = "block";
            }
            visibleCount = nextCount;

            if (visibleCount >= items.length) {
                loadMoreBtn.style.display = "none";
            }
        });
    });
</script>