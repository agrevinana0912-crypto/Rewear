
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ReWear</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f5f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            width: 360px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h2 { text-align: center; color: #344b3b; }
        p { text-align: center; color: #777; font-size: 14px; }

        label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            background: #344b3b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .error { color: red; font-size: 13px; }
        .link { margin-top: 18px; text-align: center; }
        a { color: #344b3b; }
    </style>
</head>
<body>

<div class="container">
    <h2>ReWear</h2>
    <p>Buat akun baru</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf

        <label>Nama Lengkap</label>
        <input type="text" name="NAMA"
               value="{{ old('NAMA') }}" required>

        <label>Email</label>
        <input type="email" name="EMAIL"
               value="{{ old('EMAIL') }}" required>

        <label>Password</label>
        <input type="password" name="PASSWORD" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="PASSWORD_confirmation" required>

        <button type="submit">Daftar</button>
    </form>

    <div class="link">
        Sudah punya akun?
        <a href="{{ url('/login') }}">Login di sini</a>
    </div>
</div>

</body>
</html>
