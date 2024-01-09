@extends('layouts.main')
@section('title', 'Manajemen User')
@section('content')
    <a href="{{ route('tambahuserview') }}" class="btn btn-lg active ml-auto p-3" role="button" aria-pressed="true"
        style="background: #EBCDC3; border: 1px #CDCDCD solid;  color: white;">Tambah User</a>
    <div class="container-sm tabel_background">
        <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
            <div class="col-md-5">
                <p>Daftar User</p>
            </div>
            <div class="col-sm-7">
                <div class="d-flex form-inputs">
                    <input class="form-control ml-auto" id="myInput" type="text" placeholder="Cari" style="width: 70%;">
                    <span class="input-group-text bg-white border-0"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <hr style="background-color: #936151;">
        <!-- Place the table here -->
        <table class="table table-hover table-striped-columns">
            <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
                <tr style="color: #555555; ">
                    <th scope="col">NO</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($userData as $index => $data)
                    <tr>
                        <th scope="col"> {{ $index + 1 + ($userData->currentPage() - 1) * $userData->perPage() }}</th>
                        <td>{{ $data->nip }}</td>
                        <td>{{ $data->role }}</td>
                        <td>
                            <a href="{{ route('detailuserview', ['id_user'=> $data->id_user]) }}"><i class="fa fa-address-card" style="font-size:24px;color: #DCB5A9"></i></a> |
                            <a href="{{ route('ubahuserview', ['id_user'=> $data->id_user]) }}"><i class="fa fa-pencil-square" style="font-size:24px;color:blue"></i></a> |
                            <a href="{{ route('hapususer', ['id_user' => $data->id_user]) }}" onclick="return konfirmasi()"><i class="fa fa-window-close" style="font-size:24px;color:red"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                @if ($userData->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{ $userData->url($userData->currentPage() - 1) }}">&laquo;</a></li>
                @endif
        
                @for ($i = 1; $i <= $userData->lastPage(); $i++)
                    <li class="page-item {{ ($userData->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $userData->url($i) }}">{{ $i }}</a></li> 
                @endfor
        
                @if ($userData->currentPage() < $userData->lastPage())
                    <li class="page-item"><a class="page-link" href="{{ $userData->url($userData->currentPage() + 1) }}">&raquo;</a></li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
