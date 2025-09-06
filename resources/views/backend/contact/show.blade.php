@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0 text-white">Pesan Dari <b>{{$contact->name}}</b></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                                <label><strong>Subjek:</strong></label>
                                <div>{{$contact->subject}}</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label><strong>Nama Pelanggan:</strong></label>
                                <div>{{$contact->name}}</div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label><strong>Email pelanggan:</strong></label>
                                <div>{{$contact->email}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label><strong>Pesan:</strong></label>
                                <div>{{ $contact->message }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('backend.contact.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection