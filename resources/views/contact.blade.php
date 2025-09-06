@extends('layouts.frontend-2')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero-2" class="hero-2 section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">KONTAK KAMI</h2>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /akhir Hero Section -->
      
        <section>
            <div class="container py-5">
                <div class="contact-section">
                    <!-- Form -->
                    <h2 class="mb-4 fw-bold">KONTAK KAMI</h2>
                    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6 d-flex flex-column gap-3">
                                <div>
                                    <input type="text" name="subject" value="{{old ('subject')}}" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject">

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="text" name="name" value="{{old ('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name">
                                
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="email" name="email" value="{{old ('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <textarea name="message" class="form-control h-100 @error('message') is-invalid @enderror" id="message" placeholder="Message">{{old ('message')}}</textarea>
                            
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg">KIRIM</button>
                            </div>
                        </div>
                    </form>

                    <div class="contact-info mt-5">
                        <div class="row text-center g-4">
                            <!-- Email -->
                            <div class="col-md-4">
                            <i class="bi bi-envelope-fill fs-1 d-block mb-2"></i>
                            <h6 class="fw-bold mb-1">EMAIL</h6>
                            <span>tastyfood@gmail.com</span>
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
                <div class="map-container ">
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