@extends('layouts.app')

@section('content')
    <!-- page content -->
    <div class="container">
        <div class="card" >
            <div class="card-header">
                <h2>Data Peserta Reuni SMAN 77 2023</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8 d-flex justify-content-start">
                        <a href="/admin/mahasiswa/create" class="btn btn-primary mx-2"> <i class="bi bi-plus-circle"></i></a>
                        {{-- <a href="/admin/mahasiswa/cetak" target="_blank" class="btn btn-success"><i class="bi bi-printer"></i></a> --}}
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <form method="GET">
                            <div class="col-12">
                                <div class="input-group">
                                    {{-- <button type="submit" class="btn btn-primary mx-4">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                Filter
                                            </a>
            
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    Absen 1 Hadir
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    Absen 2 Hadir
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    Absen 1 Tidak Hadir
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    Absen 2 Tidak Hadir
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </button> --}}
                                    <br>
                                    <input type="text" class="form-control" name="cari" id="cari" placeholder="Search Users" value={{ $cari }} >
                                    <button class="btn btn-primary" name="submit" type="submit"><i class="bi bi-search"></i></button>
                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th class="text-center d-none d-md-flex">QR Code</th>
                            <th>@sortablelink('nim','No.Hp')</th>
                            <th>@sortablelink('nama','Nama Peserta')</th>
                            <th>@sortablelink('alamat','Alamat')</th>
                            <th>Kelas</th>
                            <th>Kehadiran</th>
                            {{-- <th>Absen 2</th>
                            <th>Absen 3</th> --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                            @foreach($siswa as $s)
                                <tr>
                                    <td class="d-none d-md-flex">{!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($s->qr_code) !!} </td>
                                    <td>{{$s->nim}}</td>
                                    <td>{{$s->nama}}</td>
                                    <td>{{$s->alamat}}</td>
                                    <td>{{$s->kelompok}}</td>
                                    <td>{{$s->absen1}}</td>
                                    <td>{{$s->absen2}}</td>
                                    <td>{{$s->absen3}}</td>
                                    <td>
                                        <form action="{{route ('mahasiswa.destroy', $s->id)  }}" method="POST">
                                            <a href="{{ route ('mahasiswa.show', $s->id) }}" class="btn btn-round btn-primary mb-xs-2" > <i class="bi bi-eye"></i> </a>
                                            <a href="{{route('mahasiswa.edit', $s->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    </table>

                    <br/>
                    <div class="col mb-2">
                        <div class="row-4">
                            Halaman : {{ $siswa->currentPage() }}
                        </div>
                        <div class="row-4">
                            Jumlah Data : {{ $siswa->total() }}
                        </div>
                        <div class="row-4">
                            Data Per Halaman : {{ $siswa->perPage() }}
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        {{-- {{ $siswa->links() }} --}}
                        {!! $siswa->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div id="reader" width="600px"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <input type="text" id="result">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>
    <script>

        function onScanSuccess(decodedText, decodedResult) {
            $("#result").val(decodedText)

            let id= decodedText

            csrf_token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title : 'succes',
                text : 'Berhasiil Scanner',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'Ok',
            }).then((result)=>{
                if(result.value){
                    $.ajax({
                        url : "{{ route('validasiqr') }}",
                        type : "POST",
                        data : {
                            '_method' : 'POST',
                            '_token' : csrf_token,
                            'qr_code' : id,
                        },
                        success: function (response){

                            // console.log(response)
                            if(response.status_error){
                                Swal.fire({
                                    type: 'error',
                                    title : 'Oopsss!',
                                    text : 'qr code tidak ditemukan'
                                })
                            }
                            Swal.fire({
                                icon : 'success',
                                type : 'succes',
                                title : 'Succes!',
                                text : 'Berhasil Absen'
                            });
                        }
                    })
                }
            })
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

@endpush
