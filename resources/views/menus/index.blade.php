@include('layouts.master')

@section('content')
<div class="container">
    <h2>Daftar Menu</h2>

    <a href="{{ route('menus.create') }}" class="btn btn-success">Tambah Menu</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->nama_menu }}</td>
                <td>{{ $menu->deskripsi_menu }}</td>
                <td>Rp{{ number_format($menu->harga_menu, 0, ',', '.') }}</td>
                <td>
                    @if($menu->foto_menu)
                        <img src="{{ asset('storage/' . $menu->foto_menu) }}" width="100">
                    @else
                        Tidak ada foto
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
