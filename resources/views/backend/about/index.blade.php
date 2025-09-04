@extends('layouts.backend')

@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table" id="dataabout">
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
                                        <td> <img src="{{ Storage::url($data->image_vision) }}" alt="{{ $data->vision }}" style="width: 60px; height: auto;"> </td>                                                         
                                        <td> <img src="{{ Storage::url($data->image_mission) }}" alt="{{ $data->mission }}" style="width: 60px; height: auto;"> </td>                                                         
                                        
                                        <td> 
                                            {{-- <a href="{{ route('backend.about.show', $data->id) }}"
                                                class="btn btn-sm btn-success">
                                                Tampilkan
                                            </a> | --}}

                                            <a href="{{ route('backend.about.edit', $data->id) }}"
                                                class="btn btn-sm btn-warning">
                                                Ubah
                                            </a> |

                                            <a href="{{ route('backend.about.destroy', $data->id) }}"
                                                class="btn btn-sm btn-danger"
                                                data-confirm-delete="true">
                                                Hapus
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
    <script>
    $(document).ready(function () {
        $('#dataabout').DataTable();
    });
    </script>
@endpush