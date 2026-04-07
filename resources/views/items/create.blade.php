<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div>
        <h1><a href="{{ route('items.index') }}">Kembali</a></h1>
        <h1>Tambah Barang</h1>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nama Barang">

            <select name="category_id">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit">
                Simpan
            </button>
        </form>

    </div>
</body>

</html>