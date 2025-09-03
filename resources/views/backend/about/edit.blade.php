@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Ubah Tentang 
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.about.update', $about->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                               <div class="mb-2">
                                    <label for="about">Tentang Restoran</label>

                                    <textarea name="about" cols="30" rows="10" value="{{$about->about}}" class="form-control @error ('about') is-invalid @enderror">{{old ('about')}}</textarea>
                                    @error('about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="vision">Visi Restoran</label>

                                    <textarea name="vision" cols="30" rows="10" value="{{$about->vision}}" class="form-control @error ('vision') is-invalid @enderror">{{old ('vision')}}</textarea>
                                    @error('vision')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="mission">Misi Restoran</label>

                                    <textarea name="mission" cols="30" rows="10" value="{{$about->mission}}" class="form-control @error ('mission') is-invalid @enderror">{{old ('mission')}}</textarea>
                                    @error('mission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    @if($about->image_vision)
                                        <label for="image">Foto Visi</label>
                                        <img src="{{ Storage::url($about->image_vision) }}" alt="" style="width: 100px; height:100px;">
                                    @endif

                                    <br>
                                    <label for="image_vision">Foto Visi</label>
                                    <input type="file" name="image_vision" class="form-control @error('image_vision') is-invalid @enderror">
                                    <small class="text-muted">tidak usah di isi bila tidak ingin ada perubahan</small>
                                    
                                    @error('image_vision')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    @if($about->image_mission)
                                        <label for="image_mission">Foto Misi</label>
                                        <img src="{{ Storage::url($about->image_mission) }}" alt="" style="width: 100px; height:100px;">
                                    @endif

                                    <br>
                                    <label for="image_mission">Foto Misi</label>
                                    <input type="file" name="image_mission" class="form-control @error('image_mission') is-invalid @enderror">
                                    <small class="text-muted">tidak usah di isi bila tidak ingin ada perubahan</small>
                                    
                                    @error('image_mission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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