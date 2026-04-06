@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Edit Staff
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.staff.update', $user->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="phone" name="phone" 
                                        class="form-control @error('phone') is-invalid @enderror" 
                                        value="{{ old('phone', $user->phone) }}" required>
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Ubah Password</label><br>
                                    <a href="{{ route('backend.staff.editPassword', $user->id) }}" class="btn btn-sm btn-outline-primary mt-1 mb-4">Ubah Password</a>
                                </div>

                                {{-- <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" 
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" 
                                        class="form-control" required>
                                </div> --}}

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