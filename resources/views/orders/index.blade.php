<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReWear - Pesanan Masuk</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f5f1;
            color: #302b27;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            background: white;
            padding: 30px 20px;
            border-right: 1px solid #eee9e3;
            flex-shrink: 0;
        }

        .logo {
            font-size: 27px;
            font-weight: 800;
            color: #805b4b;
            margin-bottom: 8px;
        }

        .logo span {
            color: #b58b72;
        }

        .sidebar-desc {
            font-size: 12px;
            color: #999;
            margin-bottom: 45px;
        }

        .menu-title {
            font-size: 11px;
            color: #aaa;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin: 20px 12px 12px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
            text-decoration: none;
            color: #777;
            font-size: 14px;
            font-weight: 600;
        }

        .menu.active {
            background: #f2e9e2;
            color: #805b4b;
        }

        .seller-profile {
            margin-top: 300px;
            padding: 15px 10px;
            border-top: 1px solid #eee9e3;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            background: #e9d8ca;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #805b4b;
            font-weight: 800;
        }

        .main {
            flex: 1;
            padding: 35px 45px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .welcome h1 {
            font-size: 27px;
            margin-bottom: 7px;
        }

        .welcome p {
            color: #999;
            font-size: 14px;
        }

        .workspace {
            background: white;
            padding: 11px 17px;
            border-radius: 10px;
            color: #805b4b;
            font-size: 13px;
            border: 1px solid #eee9e3;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid #eee9e3;
            border-radius: 15px;
            padding: 23px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            background: #f4ebe4;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 17px;
        }

        .stat-card p {
            color: #999;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .stat-card h2 {
            font-size: 27px;
            color: #49372e;
        }

        .order-section {
            background: white;
            border: 1px solid #eee9e3;
            border-radius: 16px;
            padding: 27px;
        }

        .section-header {
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 20px;
        }

        .section-header p {
            color: #999;
            font-size: 13px;
            margin-top: 5px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            background: #f8f4f0;
            color: #806353;
            text-align: left;
            padding: 15px 13px;
            font-size: 12px;
        }

        td {
            padding: 17px 13px;
            border-bottom: 1px solid #f0ece8;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            padding: 65px 15px;
            color: #999;
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .empty strong {
            display: block;
            color: #49372e;
            font-size: 17px;
            margin-bottom: 8px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #805b4b;
            font-weight: 700;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 190px;
            }

            .main {
                padding: 25px 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 22px 14px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">

        <div class="logo">Re<span>Wear.</span></div>
        <div class="sidebar-desc">PRELOVED MARKETPLACE</div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('products.index') }}" class="menu">
            <span>▦</span>
            Produk Saya
        </a>

        <a href="{{ route('seller.orders') }}" class="menu active">
            <span>▤</span>
            Pesanan Masuk
        </a>

        <div class="menu-title">AKUN</div>

        <div class="menu">
            <span>♙</span>
            Seller
        </div>

        <div class="seller-profile">
            <div class="avatar">S</div>
            <div>
                <strong>Seller ReWear</strong>
                <small>Penjual</small>
            </div>
        </div>

    </aside>

    <main class="main">

        <div class="topbar">
            <div class="welcome">
                <h1>Pesanan Masuk 📦</h1>
                <p>Pantau pesanan pembeli untuk produk yang kamu jual.</p>
            </div>

            <div class="workspace">
                ✦ Seller Workspace
            </div>
        </div>

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon">▤</div>
                <p>Total Pesanan</p>
                <h2>0</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">◷</div>
                <p>Menunggu Diproses</p>
                <h2>0</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <p>Pesanan Selesai</p>
                <h2>0</h2>
            </div>

        </div>

        <section class="order-section">

            <div class="section-header">
                <h2>Daftar Pesanan</h2>
                <p>Semua pesanan yang masuk dari pembeli.</p>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Pembeli</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="empty">
                                    <div class="empty-icon">📦</div>
                                    <strong>Belum Ada Pesanan</strong>
                                    <p>Pesanan dari pembeli akan muncul di halaman ini.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('products.index') }}" class="back">
                ← Kembali ke Produk Saya
            </a>

        </section>

    </main>

</div>
</body>
</html>
