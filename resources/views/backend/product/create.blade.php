@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Tambah Produk
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.product.store') }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="mb-2">
                                    <label for="">Nama Produk</label>

                                    <input type="text" name="name" value="{{old ('name')}}" class="form-control @error('name') is-invalid @enderror"> 
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="description">Deskripsi Produk</label>

                                    <textarea name="description" cols="30" rows="10" value="{{old ('description')}}" class="form-control @error ('description') is-invalid @enderror">{{old ('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="image">Foto Produk</label>

                                    <input type="file" name="image" value="{{old ('image')}}" class="form-control @error('image') is-invalid @enderror">
                                    
                                    @error ('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
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