@extends('layouts.frontend-2')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">BERITA KAMI</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->
        
        <!-- Featured news-->
       
        <section class="news-hero mb-5 light-background">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <img class="news-hero-img"
                            src="{{ Storage::url($featurednews->image) }}"
                            alt="{{ $featurednews->title }}">
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">{{ $featurednews->title }}</h2>
                        <p class="lead">{{ $featurednews->description }}</p>
                        <a href="#" class="btn btn-dark">BACA SELENGKAPNYA</a>
                    </div>
                </div>
            </div>
        </section>
      
        <!--Akhir Featured news-->

        
        <div class="container py-5 ">
            <!-- Berita Lainnya -->
            <section aria-labelledby="berita-lainnya">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 id="berita-lainnya" class="block-title m-0">BERITA LAINNYA</h3>
                </div>

                <div class="row g-4">
                    @foreach ($news as $data)
                    <div class="col-12 col-sm-6 col-lg-3 news-item" style="display: {{ $loop->index < 8 ? 'block' : 'none' }};">
                        <div class="card h-100 news-card">
                            <img src="{{ Storage::url($data->image) }}" class="card-img-top" alt="{{ $data->title }}">
                            <div class="card-body">
                                <h5 class="card-title mb-2">{{ $data->title }}</h5>
                                <p class="card-text text-muted mb-3">{{ $data->description }}</p>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-outline-dark btn-sm btn-link-more">Baca selengkapnya</a>
                                    <button type="button" class="btn btn-sm btn-light border">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="#" id="loadMoreBtn" class="btn btn-dark">
                        Lihat Lebih Banyak
                    </a>
                </div>
            </section>
            <!-- Akhir Berita Lainnya -->
        </div>

    </main>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll(".news-item");
    const loadMoreBtn = document.getElementById("loadMoreBtn");
    let visibleCount = 4; // awalnya tampil 4 berita

    loadMoreBtn.addEventListener("click", function (e) {
        e.preventDefault();

        let nextCount = visibleCount + 4; // tambah 4 berita lagi
        for (let i = visibleCount; i < nextCount && i < items.length; i++) {
            items[i].style.display = "block";
        }
        visibleCount = nextCount;

        // kalau semua berita sudah tampil, sembunyikan tombol
        if (visibleCount >= items.length) {
            loadMoreBtn.style.display = "none";
        }
    });
});
</script>