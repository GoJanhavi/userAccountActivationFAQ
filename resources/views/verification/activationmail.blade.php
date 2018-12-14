<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Email</title>
</head>

<body>
<h2>Welcome to the forum {{$user['name']}}</h2>
<br/>
Your registered email-id is {{$user['email']}} , Please click on the below link to activate your email account
<a href="{{url('user/verify', $user->user_activation_token)}}">Verify Email</a>
</body>

</html>