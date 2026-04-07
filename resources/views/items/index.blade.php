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
        <a href="{{ route('items.create') }}">
            Tambah Barang
        </a>

        <table>
            <thead>
                <tr>
                    <th class="text-red-700">Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->stock }}</td>
                        <td><a href="{{ route('items.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus')">Hapus</button>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>