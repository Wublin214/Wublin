<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @foreach ($data as $OrderItem)
        <title>{{ $OrderItem->ProjectTitle }}</title>
</head>
<body>
<h1>{{ $OrderItem->ProjectTitle }}</h1>
<p><strong>Описание:</strong> {{ $OrderItem->ProjectDescription }}</p>
<p><strong>Тип веб-сайта:</strong> {{ $OrderItem->TypeOfWebsite }}</p>
<p><strong>Предпочтения в дизайне:</strong> {{ $OrderItem->DesignPreferences }}</p>
<p><strong>Функциональные требования:</strong> {{ $OrderItem->FunctionalRequirements }}</p>
<p><strong>Временные рамки:</strong> {{ $OrderItem->Timeline }}</p>
<p><strong>Бюджет:</strong> {{ $OrderItem->Budget }}</p>
<p><strong>Контент:</strong> {{ $OrderItem->Content }}</p>
<p><strong>SEO:</strong> {{ $OrderItem->SeoConsiderations }}</p>
<p><strong>Контактная информация:</strong> {{ $OrderItem->ContactInformation }}</p>

<form action="{{ url('chatClient/addNewChat') }}" method="post">
    @csrf
    <input type="hidden" name="Id_Orders" value="{{ $OrderItem->id }}">
    <input type="submit" name="buttonMessages" value="Написать заказчику">
</form>

<form action="{{ url('application/NewApplication') }}" method="post">
    @csrf
    <input type="hidden" name="Id_Orders" value="{{ $OrderItem->id }}">
    <input type="submit" name="buttonMessages" value="Взять заказ">
</form>
@endforeach
</form>
</body>
</html>
