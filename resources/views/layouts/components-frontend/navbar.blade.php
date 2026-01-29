<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Jangan dulu -->
        <!-- <img src="assets/img/logo.png')}}" alt=""> -->
        <h1 class="sitename">Delicacy</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}">Home<br></a></li>
          <li><a href="{{route('about.index')}}">Tentang</a></li>
          <li><a href="{{route('news.index')}}">Berita</a></li>
          <li><a href="{{ route('gallery.index') }}">Galeri</a></li>
          <li><a href="{{route ('contact.index')}}">Kontak</a></li>
          <li><a href="{{route ('reservation.index')}}">Reservasi</a></li>

          @if (Auth::check())
            <li class="dropdown">
              <a href="#"><span>Kelola</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="{{ route('reservation.settings.index') }}">Kelola Reservasi</a></li>
               <li><a href="/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</a></li>
              </ul>
            </li>
          @else
            <li><a href="{{ route('login') }}">Login</a></li>
          @endif
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