@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Tambah Menu</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
        </div>

        <div class="mb-3">
            <label for="foto_menu" class="form-label">Foto Menu</label>
            <input type="file" class="form-control" id="foto_menu" name="foto_menu">
        </div>

        <div class="mb-3">
            <label for="deskripsi_menu" class="form-label">Deskripsi Menu</label>
            <textarea class="form-control" id="deskripsi_menu" name="deskripsi_menu" required></textarea>
        </div>

        <div class="mb-3">
            <label for="harga_menu" class="form-label">Harga Menu</label>
            <input type="number" class="form-control" id="harga_menu" name="harga_menu" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
