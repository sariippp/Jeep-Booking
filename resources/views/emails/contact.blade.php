<!DOCTYPE html>
<html>
<head>
    <title>Form Kontak Website</title>
</head>
<body>
    <h2>Pesan Baru dari Form Kontak Website</h2>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Subjek:</strong> {{ $subject }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $message_content }}</p>
</body>
</html>