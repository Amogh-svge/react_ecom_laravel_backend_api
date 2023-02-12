<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .resetBox {
            background: rgb(212, 209, 209);
            box-shadow: rgba(59, 59, 59, 0.24) 0px 3px 8px;
            border-radius: 8px;
            padding: 15px;
            font-weight: 400;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <div class="resetBox">
        HI <br />
        Change Your Password <a href="http://localhost:3000/reset/{{ $data }}">Click Here to Reset</a>
        <br>Pincode : {{ $data }}
    </div>
</body>

</html>
