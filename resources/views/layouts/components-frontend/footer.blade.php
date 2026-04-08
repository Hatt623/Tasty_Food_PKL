<footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <div class="address">
            <h2>Delicacy</h2>
            <p>{{$about->about}}</p>
            <br>
            <i class="bi bi-twitter-x" style="margin-right: 10px"></i>
            <i class="bi bi-facebook"></i>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 d-flex">
          <div>
            <h3>Useful Links</h3>
            <p><a href="{{route ('news.index')}}">News</a></p>
            <p><a href="{{url('/')}}">Home</a></p>
            <p><a href="{{route('gallery.index')}}">Galeri</a></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <div>
            <br>
            <br>
            <p><a href="{{route ('about.index')}}">Tentang kami</a></p>
            <p><a href="{{route ('contact.index')}}">Kontak kami</a></p>
            <p><a href="{{route ('reservation.index')}}">Reservasi</a></p>
          </div>
        </div>
      

        <div class="col-lg-3 col-md-6">
          <h3>Contact Info</h3>
            <p><i class="bi bi-envelope-fill" style="margin-right: 10px;"></i><a href="{{route ('contact.index')}}">{{$about->email}}</a></p>
            <p><i class="bi bi-telephone-fill" style="margin-right: 10px;"></i><a href="{{route ('contact.index')}}">{{$about->phone}}</a></p>
            <p><i class="bi bi-geo-alt-fill" style="margin-right: 10px;"></i><a href="{{route ('contact.index')}}">{{$about->address}}</a></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>©<a href="/login">Delicacy</a> <span>Copyright</span><span>All Rights Reserved</span></p>
    </div>

</footer>