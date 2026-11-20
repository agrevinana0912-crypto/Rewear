    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Kategori - ReWear</title>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            body {
                display: flex;
                background: #f5f7f0;
                color: #333;
            }

            .sidebar {
                width: 250px;
                min-height: 100vh;
                background: #526b43;
                padding: 30px 20px;
                color: white;
            }

            .logo {
                font-size: 27px;
                font-weight: bold;
                margin-bottom: 8px;
            }

            .tagline {
                font-size: 12px;
                margin-bottom: 40px;
                color: #e5ead9;
            }

            .sidebar a {
                display: block;
                text-decoration: none;
                color: white;
                padding: 13px 15px;
                margin-bottom: 10px;
                border-radius: 8px;
            }

            .sidebar a:hover,
            .sidebar a.active {
                background: #405536;
            }

            .content {
                flex: 1;
                padding: 35px;
            }

            .header {
                margin-bottom: 30px;
            }

            .header h1 {
                color: #405536;
                margin-bottom: 8px;
            }

            .header p {
                color: #777;
            }

            .table-container {
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 3px 12px rgba(0,0,0,0.05);
            }

            .top-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                gap: 10px;
            }

            .top-bar h2 {
                color: #405536;
            }

            .btn {
                display: inline-block;
                padding: 10px 16px;
                border: none;
                border-radius: 7px;
                text-decoration: none;
                cursor: pointer;
                font-size: 14px;
            }

            .btn-add {
                background: #526b43;
                color: white;
            }

            .btn-edit {
                background: #e5ead9;
                color: #405536;
            }

            .btn-delete {
                background: #c94c4c;
                color: white;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }

            th {
                background: #e5ead9;
                color: #405536;
            }

            .empty {
                text-align: center;
                color: #888;
            }

            @media (max-width: 700px) {
                body {
                    flex-direction: column;
                }

                .sidebar {
                    width: 100%;
                    min-height: auto;
                }

                .content {
                    padding: 20px;
                }

                .top-bar {
                    align-items: flex-start;
                    flex-direction: column;
                }
            }
        </style>
    </head>

    <body>

        <div class="sidebar">
            <div class="logo">ReWear ♡</div>
            <div class="tagline">Wear Again, Love Again</div>

            <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('kategori.index') }}" class="active">📂 Kategori</a>
            <a href="#">👕 Produk</a>
            <a href="{{ route('pesanan.index') }}">🛍️ Pesanan</a>
            <a href="#">👥 Pengguna</a>
            <a href="#">📊 Laporan</a>
        </div>

        <div class="content">

            <div class="header">
                <h1>Data Kategori</h1>
                <p>Kelola kategori produk ReWear dengan mudah.</p>
            </div>

            <div class="table-container">

                <div class="top-bar">
                    <h2>Daftar Kategori</h2>

                    <a href="{{ route('kategori.create') }}" class="btn btn-add">
                        + Tambah Kategori
                    </a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $item->id) }}"
                                    class="btn btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('kategori.destroy', $item->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </body>
    </html>
