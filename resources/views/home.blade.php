@extends('layouts.app')

@section('content')
<div class="container">
    Welcome <b>{{ Auth::user()->role}}</b>, pilih kolom scan untuk mulai <a href="/operator/scan"><b>Scan</b></a>.
    <br>
    {{-- Silahkan pilih kolom <a href="/admin/mahasiswa"><b>PESERTA</b><a> untuk menambah data mahasiswa (hanya untuk admin). --}}
</div>
@endsection
