<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expiry Reminder</title>

<style>
    body {
        background-color: #ccc;
        padding: 20px;
    }

    #mainbox {
        width: 100%;
        max-width: 600px;
        padding: 20px;
        background-color: #fff;
        margin: auto;
    }

    #mainbox a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #000;
        text-decoration: none;
        color: #fff;
        border-radius: 5px;
    }
</style>

</head>
<body>
    <div id="mainbox">
        <h3>{{ $user->name }}</h3>
        <h3>Peringatan untuk Perbaharui Keahlian</h3>
        <p>Keahlian anda di ZMember bakal luput dalam
            30 hari lagi.
        </p>
        <p>Keahlian anda bakal luput pada {{ $user->expiry_date }}</p>
        <p>Jangan lupa untuk perbaharui keahlian anda
            di dalam sistem untuk terus menikmati
            manfaat keahlian.
        </p>

        <p>
            <a href="{{ route('membership.index') }}">
                Perbaharui Keahlian Sekarang
            </a>
        </p>
    </div>
</body>
</html>