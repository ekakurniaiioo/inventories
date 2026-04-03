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
        <h1>Edit Barang</h1>

        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $item->name }}">

            <select name="category_id">
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'select' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>

            <button type="submit">
                Update
            </button>
        </form>
    </div>
</body>
</html>