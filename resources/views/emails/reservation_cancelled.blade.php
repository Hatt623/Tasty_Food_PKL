<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pembatalan Reservasi</title>
</head>
<body>
    <h2>Halo {{ $reservation->user->name }},</h2>
    <p>
        Kami informasikan bahwa reservasi Anda dengan kode <strong>{{ $reservation->reserve_code }}</strong> 
        pada <strong>{{ $reservation->reservation_time->format('d M Y H:i') }}</strong> 
        telah <strong>dibatalkan</strong> karena Anda tidak hadir dalam waktu 2 jam.
    </p>
    <p>
        Jika Anda masih ingin melakukan reservasi, silakan membuat reservasi baru melalui sistem kami.
    </p>
    <p>Ini adalah pesan otomatis.Terima kasih,<br>Tim Delicacy</p>
</body>
</html>