@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Tambah Data Peserta</h2>
            </div>
            <div class="card-body">
                <form action="/admin/mahasiswa" method="post">
                    @csrf
                    <div class="container mt-4">
                        <div class="form-floating mb-3">
                            <p><b>No.hp</b></p>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="">
                        </div>    
                        <div class="form-floating mb-3">
                            <p><b>Nama Peserta</b></p>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                         <div class="form-floating mb-3">
                            <p><b>Alamat</b></p>
                            <input type="text-area" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleSelectRounded0">Kelas</label>
                            <select class="custom-select rounded-0" id="kelompok" name="kelompok">
                                <option value="A1">A1</option>
                                <option value="A2-1">A2-1</option>
                                <option value="A2-2">A2-2</option>
                                <option value="A3-1">A3-1</option>
                                <option value="A3-2">A3-2</option>
                                <option value="A3-3">A3-3</option>
                              
                            </select>
                        </div>
                        <button class="btn btn-primary mr-1" name="submit" type="submit">Submit</button>
                        <a href="/admin/mahasiswa" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection
