
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - ReWear</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f5f2;
            margin: 0;
            color: #333;
        }

        .navbar {
            background: #344b3b;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .logout {
            background: white;
            color: #344b3b;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        .welcome {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .welcome h1 {
            color: #344b3b;
        }

        .info {
            margin-top: 25px;
            padding: 20px;
            background: #eaf0e9;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>ReWear</h2>

        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="welcome">
            <h1>Selamat Datang, {{ Auth::user()->NAMA }}!</h1>

            <p>
                Selamat datang di Dashboard User ReWear.
                Kamu berhasil login ke akun kamu.
            </p>

            <div class="info">
                <h3>Informasi Akun</h3>
                <p><strong>Nama:</strong> {{ Auth::user()->NAMA }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->EMAIL }}</p>
                <p><strong>Role:</strong> {{ Auth::user()->ROLE }}</p>
            </div>
        </div>
    </div>

</body>
</html>
