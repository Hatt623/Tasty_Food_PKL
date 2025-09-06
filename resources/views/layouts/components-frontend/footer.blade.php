<footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <div class="address">
            <h2>Tasty Food</h2>
            <p>{{$about->about}}</p>
            <br>
            <i class="bi bi-twitter-x" style="margin-right: 10px"></i>
            <i class="bi bi-facebook"></i>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <div>
            <h3>Useful Links</h3>
            <p><a href="#">News</a></p>
            <p><a href="{{url('/')}}">Home</a></p>
            <p><a href="{{route('gallery.index')}}">Galeri</a></p>
            <p><a href="#">Testimonial</a></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <div>
            <h3>Privacy</h3>
              <p><a href="">Karir</a></p>
              <p><a href="">Tentang kami</a></p>
              <p><a href="">Kontak kami</a></p>
              <p><a href="">Servis</a></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h3>Contact Info</h3>
            <p><i class="bi bi-envelope-fill" style="margin-right: 10px;"></i><a href="">tastyfood@gmail.com</a></p>
            <p><i class="bi bi-telephone-fill" style="margin-right: 10px;"></i><a href="">+62 812 3456 7890</a></p>
            <p><i class="bi bi-geo-alt-fill" style="margin-right: 10px;"></i><a href="">Kota Bandung, Jawa Barat</a></p>

        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span><span>All Rights Reserved</span></p>
    </div>

  </footer>