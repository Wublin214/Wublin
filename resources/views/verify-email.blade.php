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
<div>

    не получил ссылку ?
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-link ps-0">Send Link</button>
    </form>

</div>
</form>
</body>
</html>
