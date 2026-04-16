@extends('layouts.frontend')

@section('content')
<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <!-- Card -->
                <div class="card shadow-sm border-0 rounded-3 mt-5 pt-5">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h4 class="mb-0">Delicacy Register</h4>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" 
                                       type="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Masukkan Nama anda" 
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
                                       value="{{ old('email') }}" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Masukkan Email anda" 
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
                                       value="{{ old('phone') }}" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       placeholder="Masukkan Nomor Telepon Anda" 
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" 
                                       type="password" 
                                       name="password"
                                       value="{{ old('password') }}" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan Password anda" 
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password_confirmation -->
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Password Confirmation</label>
                                <input id="password-confirm" 
                                       type="password" 
                                       name="password_confirmation" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       placeholder="Masukkan Ulang Password Anda" 
                                       required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-dark btn-lg">Register</button>
                                <a href="/login" class="btn btn-outline-dark btn-lg mt-2">Login</a>
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
