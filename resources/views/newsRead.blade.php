@extends('layouts.frontend-2')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">Berita Kami</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->
    
        <div class="container pt-5">
            <!-- Berita -->
            <section aria-labelledby="berita-detail">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10" data-aos="fade-up" data-aos-delay="250">
                        <div class="card shadow-lg border-0">
                            @if($news->image)
                                <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                            @endif
                            <div class="card-body p-4">
                                <h3 class="card-title mb-3">{{ $news->title }}</h3>
                                <p class="text-muted mb-4">Dipublikasikan pada {{ $news->created_at->format('d M Y') }}</p>
                                <p class="card-text" style="line-height: 1.8;">
                                    {{ $news->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Akhir Berita -->
        </div>

        <!-- Back Button -->
        <section class="mb-5">
            <div class="container text-center">
                <a href="{{ route('web.news') }}" class="btn-load-more" data-aos="fade-up" data-aos-delay="400">
                    ← Kembali ke Daftar Berita
                </a>
            </div>
        </section>


    </main>
@endsection