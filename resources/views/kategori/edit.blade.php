<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - ReWear</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7f0;
            color: #30392d;
        }

        .container {
            max-width: 650px;
            margin: 70px auto;
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h2 {
            color: #526b43;
            margin-bottom: 10px;
        }

        p {
            color: #777;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #405536;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce4d5;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #526b43;
        }

        .simpan {
            background: #526b43;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .kembali {
            display: inline-block;
            background: #e5ead9;
            color: #405536;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 8px;
        }

        .error {
            color: #b83232;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Kategori</h2>
    <p>Perbarui informasi kategori produk ReWear.</p>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kategori</label>

        <input
            type="text"
            name="nama_kategori"
            value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
            required
        >

        <a href="{{ route('kategori.index') }}" class="kembali">
            Kembali
        </a>

        <button type="submit" class="simpan">
            Simpan Perubahan
        </button>
    </form>

</div>

</body>
</html>
