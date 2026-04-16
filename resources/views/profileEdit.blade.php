@extends('layouts.frontend')

@section('content')
<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <!-- Card -->
                <div class="card shadow-sm border-0 rounded-3 mt-5 pt-5">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h4 class="mb-0">Silahkan Edit Profil Anda</h4>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" 
                                       type="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Masukkan Nama Baru anda" 
                                       required 
                                       autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" 
                                       type="email" 
                                       name="email"
                                       value="{{ old('email', $user->email) }}" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Masukkan Email Baru anda" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input id="phone" 
                                       type="number" 
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       placeholder="Masukkan Nomor Telepon Baru Anda" 
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                           

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <a href="{{ route('profileEditPassword', $user->id) }}" class="btn btn-outline-dark btn-lg mb-5">Ubah Password</a>
                                <button type="submit" class="btn btn-dark btn-lg">Update Profile</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
</main>
@endsection
