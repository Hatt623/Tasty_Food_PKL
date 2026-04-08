@extends('layouts.backend')

@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        SILAHKAN EDIT HALAMAN ABOUT 
                    </div>

                    {{-- About 1 --}}
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Tentang </th>
                                        <th> Visi </th>
                                        <th> Misi </th>
                                        <th>Gambar Visi </th>
                                        <th>Gambar Misi </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($about as $data)
                                    <tr>
                                        <td> {{Str::limit($data->about,10)}} </td>
                                        <td> {{Str::limit($data->vision,10)}} </td>
                                        <td> {{Str::limit($data->mission,10)}} </td>
                                        <td> <img src="{{ asset($data->image_vision) }}" alt="{{ $data->image_vision }}" style="width: 60px; height: auto;"> </td>                                                         
                                        <td> <img src="{{ asset($data->image_mission) }}" alt="{{ $data->image_mission }}" style="width: 60px; height: auto;"> </td>                                                         
                                        
                                        <td> 
                                            <a href="{{ route('about.index',) }}"
                                                class="btn btn-sm btn-success">
                                                Tampilkan
                                            </a> |

                                            <a href="{{ route('backend.about.edit', $data->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Ubah
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- About 2 --}}
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Email </th>
                                        <th> Telepon </th>
                                        <th> Alamat </th>
                                        <th> Peta </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($about as $data)
                                    <tr>
                                        <td> {{Str::limit($data->email,10)}} </td>
                                        <td> {{Str::limit($data->phone,10)}} </td>
                                        <td> {{Str::limit($data->address,10)}} </td>
                                        <td> 
                                            <div class="map-container" style="width: 200px; height: 100px; overflow: hidden; border-radius: 8px;">
                                                {!! $data->map_embed !!} 
                                            </div>
                                        </td>                                                         
                                        
                                        <td> 
                                            <a href="{{ route('contact.index',) }}"
                                                class="btn btn-sm btn-success">
                                                Tampilkan
                                            </a> |

                                            <a href="{{ route('backend.about.edit2', $data->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Ubah
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush