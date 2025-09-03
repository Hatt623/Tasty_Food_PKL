@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Detail Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Nama Produk:</strong></label>
                                <div>{{$product->name}}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Deskripsi produk:</strong></label>
                                <div>{{ $product->description }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Foto Produk:</strong></label><br>
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="product Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div>Produk tidak memiliki foto</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('backend.product.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection