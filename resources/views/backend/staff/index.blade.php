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
                        Data staff
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('backend.staff.create') }}" class="btn btn-info btn-sm" style="color:white; float: right;" 
                                style="float: right;">
                                tambah
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table" id="datauser">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nama Staff </th>
                                        <th> Email Staff </th>
                                        <th> Aksi </th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($user as $data)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$data->name}} </td>
                                        <td> {{$data->email}}</td>                                        
                                        <td>
                                            @if(auth()->id() == $data->id || auth()->user()->role == 'admin')
                                                <a href="{{ route('backend.staff.show', $data->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    Tampilkan
                                                </a> |

                                                <a href="{{ route('backend.staff.edit', $data->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Edit
                                                </a> |

                                                @if(auth()->user()->role == 'admin' && auth()->id() != $data->id)
                                                    <a href="{{ route('backend.staff.destroy', $data->id) }}"
                                                        class="btn btn-sm btn-danger"
                                                        data-confirm-delete="true">
                                                        Hapus
                                                    </a>
                                                @endif
                                                
                                            @endif
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
        $('#datauser').DataTable();
    });
    </script>
@endpush