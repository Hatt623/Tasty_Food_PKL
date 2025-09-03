@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Ubah Produk
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.news.update', $news->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                               <div class="mb-2">
                                    <label for="">Judul Berita</label>

                                    <input type="text" name="title" value="{{$news->title}}" class="form-control @error('title') is-invalid @enderror"> 
                                    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="description">Deskripsi Berita</label>

                                    <textarea name="description" cols="30" rows="10" value="{{$news->description}}" class="form-control @error ('description') is-invalid @enderror">{{old ('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    @if($news->image)
                                        <label for="image">Foto Produk</label>
                                        <img src="{{ Storage::url($news->image) }}" alt="" style="width: 100px; height:100px;">
                                    @endif

                                    <br>
                                    <label for="image">Foto Produk</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    <small class="text-muted">tidak usah di isi bila tidak ingin ada perubahan</small>
                                    
                                    @error('image')
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