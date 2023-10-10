@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Ubah Data Mahasiswa Baru 2020</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update',$siswa->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="container mt-4">
                        <div class="mb-3">
                            <label for="nim">No.hp</label>
                            <input type="text" class="form-control" value="{{ $siswa->nim }}" id="nim" name="nim">
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama Peserta</label>
                            <input type="text" class="form-control" value="{{ $siswa->nama }}" id="nama" name="nama">
                        </div>
                        <div class="form-floating mb-3">
                            <p><b>Alamat</b></p>
                            <input type="text-area" class="form-control" value="{{ $siswa->alamat }}" id="" name="alamat">
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleSelectRounded0">Kelas</label>
                            <select class="custom-select rounded-0"  id="exampleSelectRounded0" name="kelompok">
                                <option value="SMAN 77" disabled>-----Pilih Kelas-----</option>
                                <option value="A1">A1</option>
                                <option value="A2-1">A2-1</option>
                                <option value="A2-2">A2-2</option>
                                <option value="A3-1">A3-1</option>
                                <option value="A3-2">A3-2</option>
                                <option value="A3-3">A3-3</option>
                            </select>
                        </div>
                        <button class="btn btn-primary mr-1" name="submit" type="submit">Submit</button>
                        <a href="{{route('mahasiswa.index')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection
