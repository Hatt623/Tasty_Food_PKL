<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png')}}" alt=""> -->
        <h1 class="sitename">Tasty Food</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}">Home<br></a></li>
          <li><a href="{{route('about.index')}}">Tentang</a></li>
          <li><a href="{{route('news.index')}}">Berita</a></li>
          <li><a href="{{ route('gallery.index') }}">Galeri</a></li>
          <li><a href="{{route ('contact.index')}}">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
    <script>
      window.addEventListener('scroll', function () {
        const header = document.getElementById('header');
        header.classList.toggle('scrolled', window.scrollY > 50);
      });
    </script>
  </header>