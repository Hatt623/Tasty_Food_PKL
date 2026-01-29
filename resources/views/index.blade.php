@extends('layouts.frontend')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <hr data-aos="fade-up">
                    <h1 data-aos="fade-up">FINE DINING</h1>
                    <h2 data-aos="fade-up">Delicacy</h2>
                    <p data-aos="fade-up" data-aos-delay="100">{{Str::limit($about->about,350)}}</p>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{route('about.index')}}" class="btn-get-started">TENTANG KAMI</a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="{{asset('assets/frontend/img/hero-img-magang.png')}}" class="img-fluid animated" alt="">
                </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

        <!-- Tetang kami -->
        <div class="container section-title" data-aos="fade-up">
            <p><span class="description-title">TENTANG KAMI</span></p>
           
            <h5>{{$about->about}}</h5>
            <hr data-aos="fade-up" class="section-title-hr">
           
            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                <a href="{{route('reservation.index')}}" class="btn-load-more">
                    BUAT RESERVASI
                </a>
            </div>
        </div>
        <!-- Akhir Tentang kami -->

        <!-- featured menu -->
        <section id="featured-menu" class="featured-menu section">
            <div class="container position-relative mt-5" data-aos="fade-up" data-aos-delay="100">
                <!-- Grid Kartu Menu -->
                <div class="row gy-4 justify-content-center">
                    @foreach($latestproducts as $product)
                    <div 
                        class="col-lg-3 col-md-6" 
                        data-aos="fade-up" 
                        data-aos-delay="{{ 150 + ($loop->index * 100) }}"
                        >
                        <div class="card featured-card position-relative overflow-visible text-center">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="featured-img rounded-circle">

                            <div class="card-body pt-5 mt-5">
                                <div class="featured-card-child">
                                    <h3 class="card-title mb-2">{{ $product->name }}</h3>
                                    <p class="card-text small mb-3 mt-3">
                                        {{ Str::limit($product->description, 120) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Akhir featured menu -->

        {{-- berita --}}
        <section id="our-news" class="py-5 light-background">

            <div class="container section-title" data-aos="fade-up">
                <p><span class="description-title">BERITA KAMI</span></p>
            </div>
            
            <div class="container">      
                @php
                $featured = $latestnews->first();
                $smallCards = $latestnews->skip(1)->take(4);
                @endphp

                <div class="row gy-4 align-dataproductss-start">

                {{-- Featured card kiri --}}
                @if($featured)
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                        <div class="news-card-featured card h-100 border-0 shadow-sm">
                            <img
                            src="{{asset($featured->image) }}"
                            class="card-img-top"
                            alt="{{ $featured->title }}"
                            >
                            <div class="card-body">
                                <h5 class="card-title">{{ $featured->title }}</h5>
                                <p class="card-text">{{ Str::limit($featured->description, 150) }}</p>
                                <div class="card-actions">
                                    <a href="{{route('newsRead.show', $featured->id)}}"
                                    class="stretched-link text-decoration-none">
                                    Baca selengkapnya
                                    </a>
                                    <button type="button" class="btn-link-more btn btn-sm btn-light ">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Featured card kanan --}}
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                    @foreach($smallCards as $index => $post)
                        <div class="col-6" data-aos="fade-up" data-aos-delay="{{ 250 + ($index * 50) }}">
                            <div class="news-card card h-100 border-0 shadow-sm">
                                <img
                                src="{{ asset($post->image) }}"
                                class="card-img-top"
                                alt="{{ $post->title }}"

                                >
                                <div class="card-body">
                                    <h6 class="card-title mb-2">{{ $post->title }}</h6>
                                    <p class="card-text small mb-0">
                                        {{ Str::limit($post->description, 80) }}
                                    </p>

                                    <div class="card-actions">
                                        <a href="{{route('newsRead.show', $post->id)}}" class="stretched-link small text-decoration-none">Baca selengkapnya</a>
                                        <button type="button" class="btn-link-more btn btn-sm btn-light">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                </div>
            </div>

        </section>
        {{-- akhir berita --}}

        <!-- Galeri -->
        <section id="galeri" class="menu section">
            <div class="container section-title" data-aos="fade-up">
                <p><span class="description-title">Galeri Kami</span></p>
            </div>

            <div class="container">
                <div class="row gy-4 justify-content-center" >
                @foreach($products as $index => $data)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 250 + ($index * 50) }}">
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <a href="{{ asset($data->image) }}" class="glightbox">
                            <img
                                src="{{ asset($data->image) }}"
                                alt="Gallery Image"
                                class="card-img-top img-fluid"
                                style="object-fit: cover; height: 400px;"
                            >
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>

                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{route('gallery.index')}}" class="btn-load-more">
                        Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </section>
        <!-- alkhir galeri -->

    </main>
@endsection
