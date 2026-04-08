@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Silahkan Ubah Data "Tentang" berikut
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.about.update2', $about->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                               <div class="mb-2">
                                    <label for="email">Email Restoran</label>

                                    <input type="email" name="email" value="{{$about->email}}" class="form-control @error ('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="phone">Telepon Restoran</label>

                                    <input type="text" name="phone" value="{{$about->phone}}" class="form-control @error ('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="address">Alamat Restoran</label>

                                    <textarea name="address" cols="30" rows="10" value="{{$about->address}}" class="form-control @error ('address') is-invalid @enderror">{{$about->address}}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="map_embed">Peta</label>
                                    <textarea name="map_embed" cols="30" rows="10" class="form-control @error('map_embed') is-invalid @enderror mb-2">{{$about->map_embed}}</textarea>
                                    @error('map_embed')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                    <div class="map-container">
                                        {!! $about->map_embed !!} 
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"> Save </button>
                                    <button type="reset" class="btn btn-sm btn-outline-warning"> Reset </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection