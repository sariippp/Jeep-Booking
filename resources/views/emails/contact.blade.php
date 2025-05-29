<!DOCTYPE html>
<html>
<head>
    <title>Form Kontak Website</title>
</head>
<body>
    <h2>Pesan Baru dari Contact Form</h2>

    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email Pengirim:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ nl2br(e($data['message'])) }}</p>

</body>
</html>