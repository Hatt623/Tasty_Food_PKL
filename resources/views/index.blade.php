@extends('layouts.frontend')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">

        <div class="container">
            <div class="row gy-4 justify-content-center justify-content-lg-between">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Healthy<br> Tasty Food</h1>
                <p data-aos="fade-up" data-aos-delay="100">Lorem Ipsum</p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                <a href="#book-a-table" class="btn-get-started">TENTANG KAMI</a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{asset('assets/frontend/img/hero-img.png')}}" class="img-fluid animated" alt="">
            </div>
            </div>
        </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

        <!-- Tetang kami -->
        <div class="container section-title" data-aos="fade-up">
            <p><span class="description-title">TENTANG KAMI</span></p>
           
                <p><span>{{$about->about}}</span>  </p>
                <hr style="width:15%;height:3px;border-width:0;background-color:black; margin-left:auto; margin-right:auto;">
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
                            <img
                            src="{{ Storage::url($product->image) }}"
                            alt="{{ $product->title }}"
                            class="featured-img rounded-circle"
                            >

                            <div class="card-body pt-5 mt-5">
                                <div class="featured-card-child">
                                    <h2 class="card-title mb-2">{{ $product->name }}</h2>
                                    <p class="card-text small mb-3 mt-3">
                                        {{ Str::limit($product->description, 80) }}
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
                    <div class="card h-100 border-0 shadow-sm">
                        <img
                        src="{{ Storage::url($featured->image) }}"
                        class="card-img-top"
                        alt="{{ $featured->title }}"
                        >
                        <div class="card-body">
                        <h5 class="card-title">{{ $featured->title }}</h5>
                        <p class="card-text">{{ Str::limit($featured->description, 150) }}</p>
                        <a href="#"
                            class="stretched-link text-decoration-none">
                            Baca selengkapnya →
                        </a>
                        </div>
                    </div>
                    </div>
                @endif

                {{-- Featured card kanan --}}
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                    @foreach($smallCards as $index => $post)
                        <div class="col-6" data-aos="fade-up" data-aos-delay="{{ 250 + ($index * 50) }}">
                        <div class="card h-100 border-0 shadow-sm">
                            <img
                            src="{{ Storage::url($post->image) }}"
                            class="card-img-top"
                            alt="{{ $post->title }}"
                            >
                            <div class="card-body">
                            <h6 class="card-title mb-2">{{ $post->title }}</h6>
                            <p class="card-text small mb-0">
                                {{ Str::limit($post->description, 80) }}
                            </p>
                            <a href="#"
                                class="stretched-link small text-decoration-none">
                                Baca selengkapnya →
                            </a>
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
                <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                @foreach($products as $data)
                    <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <a href="{{ Storage::url($data->image) }}" class="glightbox">
                        <img
                            src="{{ Storage::url($data->image) }}"
                            alt="Gallery Image"
                            class="card-img-top img-fluid"
                            style="object-fit: cover; height: 250px;"
                        >
                        </a>
                    </div>
                    </div>
                @endforeach
                </div>

                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                <a href="#" class="btn btn-dark">
                    Lihat Lebih Banyak
                </a>
                </div>
            </div>
        </section>
        <!-- alkhir galeri -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p><span>Need Help?</span> <span class="description-title">Contact Us</span></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="mb-5">
            <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen=""></iframe>
            </div><!-- End Google Maps -->

            <div class="row gy-4">

            <div class="col-md-6">
                <div class="info-dataproducts d-flex align-dataproductss-center" data-aos="fade-up" data-aos-delay="200">
                <i class="icon bi bi-geo-alt flex-shrink-0"></i>
                <div>
                    <h3>Address</h3>
                    <p>A108 Adam Street, New York, NY 535022</p>
                </div>
                </div>
            </div><!-- End Info dataproducts -->

            <div class="col-md-6">
                <div class="info-dataproducts d-flex align-dataproductss-center" data-aos="fade-up" data-aos-delay="300">
                <i class="icon bi bi-telephone flex-shrink-0"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>+1 5589 55488 55</p>
                </div>
                </div>
            </div><!-- End Info dataproducts -->

            <div class="col-md-6">
                <div class="info-dataproducts d-flex align-dataproductss-center" data-aos="fade-up" data-aos-delay="400">
                <i class="icon bi bi-envelope flex-shrink-0"></i>
                <div>
                    <h3>Email Us</h3>
                    <p>info@example.com</p>
                </div>
                </div>
            </div><!-- End Info dataproducts -->

            <div class="col-md-6">
                <div class="info-dataproducts d-flex align-dataproductss-center" data-aos="fade-up" data-aos-delay="500">
                <i class="icon bi bi-clock flex-shrink-0"></i>
                <div>
                    <h3>Opening Hours<br></h3>
                    <p><strong>Mon-Sat:</strong> 11AM - 23PM; <strong>Sunday:</strong> Closed</p>
                </div>
                </div>
            </div><!-- End Info dataproducts -->

            </div>

            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="600">
            <div class="row gy-4">

                <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
                </div>

            </div>
            </form><!-- End Contact Form -->

        </div>

        </section><!-- /Contact Section -->

    </main>
@endsection
