@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Ubah Password : <b>{{ $user->name }}</b>
                        {{-- button back --}}
                        <a href="{{ route('backend.staff.edit', $user->id) }}" class="btn btn-danger btn-sm" style="color:white; float: right;" 
                            style="float: right;">
                            Kembali
                        </a>
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.staff.updatePassword', $user->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" 
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" 
                                        class="form-control" required>
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