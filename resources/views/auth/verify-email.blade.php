<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Verify Your Email Address</h1>
<p>Before proceeding, please check your email for a verification link.</p>

<div>

    <p>If you did not receive the email, <a href="{{ route('verification.send') }}">click here to request another</a>.</p>



</div>
</form>
</body>
</html>
