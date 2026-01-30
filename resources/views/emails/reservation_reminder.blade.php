<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reminder Reservasi</title>
</head>
<body>
    <h2>Halo {{ $reservation->user->name }},</h2>
    <p>
        Reservasi Anda dengan kode <strong>{{ $reservation->reserve_code }}</strong> 
        dijadwalkan pada <strong>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('d M Y H:i') }}</strong>.
    </p>
    <p>
        Mohon hadir sesuai jadwal. Jika tidak, reservasi akan otomatis dibatalkan 
        dalam 1 jam ke depan.
    </p>
    <p>Ini adalah pesan otomatis. Terima kasih,<br>Tim Delicacy</p>
</body>
</html>