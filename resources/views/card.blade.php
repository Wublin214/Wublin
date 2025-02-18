<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .profile-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
        }

        .profile-image {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 10px 0;
        }

        .portfolio {
            margin-top: 20px;
        }

        .portfolio h2 {
            margin-bottom: 10px;
        }

        .portfolio ul {
            list-style-type: none;
            padding: 0;
        }

        .portfolio li {
            margin: 5px 0;
        }

        .portfolio a {
            text-decoration: none;
            color: #007BFF;
        }

        .portfolio a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    @foreach ($data as $element)
    <div class="profile-card">
        <img src="#" alt="User Image" class="profile-image">
        <div class="profile-info">
            <p><strong>First Name:</strong> <span id="first-name">{{$element->firstName}}</span></p>
            <p><strong>Last Name:</strong> <span id="last-name">{{$element->lastName}}</span></p>
            <p><strong>Email:</strong> <span id="email">{{$element->email}}</span></p>
            <p><strong>Gender:</strong> <span id="gender">{{$element->gender}}</span></p>
            <p><strong>Text:</strong> <span id="text">{{$element->Text}}</span></p>
        </div>
        <div class="portfolio">
            <h2>Portfolio</h2>
            <ul>
                <li><a href="#" id="portfolio1">{{$element->portfolio1}}</a></li>
                <li><a href="#" id="portfolio2">{{$element->portfolio2}}</a></li>
                <li><a href="#" id="portfolio3">{{$element->portfolio3}}</a></li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>


{{--1-a--}}
{{--2-c--}}
{{--3-b--}}
{{--4-b--}}
{{--5-a--}}
{{--6-c--}}
{{--7-a--}}
{{--8-c--}}
{{--9-a--}}
{{--10-c--}}
{{--11-b--}}
{{--12-a--}}
{{--13-b--}}
{{--14-a--}}
{{--15-c--}}
{{--16-b--}}
{{--17-b--}}
{{--18-a--}}
{{--19-b--}}
{{--20-b--}}
{{--21-c--}}
{{--22-с--}}
{{--23-b--}}
{{--24-b--}}
{{--25-a--}}
{{--26-b--}}
{{--27-b--}}
{{--28-b--}}
{{--29-c--}}
{{--30-b--}}


