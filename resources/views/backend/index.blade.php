@extends('layouts.backend')

@section('content')
 <div class="container-fluid">
          <!--  Owl carousel -->
          <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
              <div class="card border-0 zoom-in bg-warning-subtle shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="{{asset('assets/backend/images/svgs/icon-briefcase.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-warning mb-1">News</p>
                    <h5 class="fw-semibold text-warning mb-0">{{$totalNews}}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="{{asset('assets/backend/images/svgs/icon-mailbox.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-info mb-1">Products</p>
                    <h5 class="fw-semibold text-info mb-0">{{$totalProducts}}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-danger-subtle shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="{{asset('assets/backend/images/svgs/icon-favorites.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-danger mb-1">Contact</p>
                    <h5 class="fw-semibold text-danger mb-0">{{$totalContacts}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Row 1 Products table --}}
          @section('styles')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
          @endsection
          <div class="container-fluid">
              <div class="row">
                  <div class="col">
                      <div class="card">
                          <div class="card-header bg-secondary text-white">
                              Data Products
                          </div>

                          <div class="card-body">
                              <div class="table table-responsive">
                                  <table class="table" id="dataproducts">
                                      <thead>
                                          <tr>
                                              <th> No </th>
                                              <th> Products  </th>
                                          </tr>

                                      </thead>

                                      {{-- <tbody>
                                          @foreach ($totalUsers as $data)
                                          <tr>
                                              <td> {{$loop->iteration}} </td>
                                              <td> {{$data->name}} </td>
                                          </tr>
                                          @endforeach
                                      </tbody> --}}
                                  </table>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--  Row 2 Chart-->
          <div class="row">
            <div class=" d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <h5 class="card-title fw-semibold">Contacts Update</h5>
                      <div id="orderchart" class="mx-n6"></div>
                    </div>
                    <div class="col-md-4">
                      <div>
                        <div class="d-flex align-items-baseline mb-4">
                          <span class="round-8 text-bg-success rounded-circle me-6"></span>
                          <div>
                            <p class="fs-3 mb-1"></p>
                            <h6 class="fs-5 fw-semibold mb-0">Success</h6>
                          </div>
                        </div>
                        <div class="d-flex align-items-baseline mb-4 pb-1">
                          <span class="round-8 text-bg-warning rounded-circle me-6"></span>
                          <div>
                            <h6 class="fs-5 fw-semibold mb-0">Pending</h6>
                          </div>
                        </div>
                        <div>
                          {{-- <a class="btn btn-primary w-100" href="{{route('backend.orders.index')}}">  
                              Manage orders
                          </a> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch flex-column">
            </div>
          </div>
@endsection

 @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/backend/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    <script>
    $(document).ready(function () {
        $('#dataproducts').DataTable();
    });
    </script>
    
@endpush