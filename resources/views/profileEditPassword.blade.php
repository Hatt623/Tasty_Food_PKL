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
                        <form method="POST" action="{{ route('profileupdatePassword', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" 
                                       type="password" 
                                       name="password"
                                       value="{{ old('password') }}" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan Password Baru anda" 
                                       >
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
                                       placeholder="Masukkan Ulang Password Baru Anda" 
                                       >
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-dark btn-lg">Update password</button>
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
