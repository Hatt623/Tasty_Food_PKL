@extends('layouts.frontend-2')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">TENTANG KAMI</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->
      
        <!-- Tasty Food -->
        <section class="section-about tasty light-background">
            <div class="container-about">
            <div class="row">
                <div class="left copy" data-aos="fade-up">
                <h2>Tasty Food</h2>
                <p class="lead" data-aos="fade-up">
                    {{$about->about}}
                </p>
                </div>
                <div class="right" data-aos="fade-up">
                    <div class="tile"><img class="img-zoom" src="{{ Storage::url($about->image_vision) }}" alt="tasty food"></div>
                </div>
            </div>
            </div>
        </section>

        <!-- Visi -->
        <section class="section-about visi">
            <div class="container-about">
            <div class="row">
                <div class="left" data-aos="fade-up">
                    <div class="tile"><img class="img-zoom" src="{{ Storage::url($about->image_vision) }}" alt="tasty food"></div>
                </div>
                <div class="right copy">
                <h2>Visi</h2>
                <p class="lead" data-aos="fade-up">
                    {{$about->vision}}
                </p>
                </div>
            </div>
            </div>
        </section>

        <!-- akhir Visi -->

        {{-- Misi --}}
        <section class="section-about misi">
            <div class="container-about">
            <div class="row">
                <div class="left copy">
                <h2>Misi</h2>
                <p class="lead" data-aos="fade-up">
                    {{$about->mission}}
                </p>
                </div>
                <div class="right" data-aos="fade-up">
                    <div class="tile"><img class="img-zoom" src="{{ Storage::url($about->image_mission) }}" alt="tasty food"></div>
                </div>
            </div>
            </div>
        </section>

        {{-- Akhir misi --}}
    </main>
@endsection