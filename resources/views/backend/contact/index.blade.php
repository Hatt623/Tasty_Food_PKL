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
                            <table class="table" id="datacontact">
                                <thead>
                                    <tr>
                                        <th> Subjek </th>
                                        <th> Nama Pelanggan </th>
                                        <th> Email </th>
                                        <th> Pesan </th>
                                        <th> Aksi </th>
                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach ($contact as $data)
                                    <tr>
                                        <td> {{Str::limit($data->subject,10)}} </td>
                                        <td> {{Str::limit($data->name,10)}} </td>
                                        <td> {{Str::limit($data->email,10)}} </td>
                                        <td> {{Str::limit($data->message,10)}} </td>
                                        
                                        <td> 
                                            <a href="{{ route('backend.contact.show', $data->id) }}"
                                                class="btn btn-sm btn-success">
                                                Tampilkan
                                            </a> |

                                            <a href="{{ route('backend.contact.destroy', $data->id) }}"
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
        $('#datacontact').DataTable();
    });
    </script>
@endpush