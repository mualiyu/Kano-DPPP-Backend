<!DOCTYPE html>
<html>
<head>
    <title>AMP - message</title>
</head>
<body>
    {{-- <h1>{{ $mailData['title'] }}</h1> --}}
    <p>Dear {{$mailData['user']}},</p>
    <p>{{ $mailData['body'] }}</p>
    <p>{{ $mailData['thank'] }}</p>
    {{-- <p></p> --}}
    
    <p>Warm Regards</p>
</body>
</html>