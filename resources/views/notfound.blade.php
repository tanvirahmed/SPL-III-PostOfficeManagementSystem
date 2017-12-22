<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Post Office Management</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>

        #track-form div > div {
            margin: 4px;
        }
        .button:hover {
            color:#eee;
            background-color: #666;
        }
        .button {
            border-radius: 2px;
            cursor: pointer;
margin-top: 20px;
            border: 1px solid #ddd;
            background-color: #efefef;

            padding: 10px;

        }
        #track-form input:focus {
        border-color: #1e88e5;
        }

        #track-form input   {
            border-radius: 2px;
            border: 1px solid #ddd;
            padding:5px;
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

        <div class="top-right links">

                <a href="{{ url('/') }}">Home</a>


        </div>


    <div class="content t-c">
        <div style="font-weight:bold;"></div>
        <div class="title m-b-md">
            Not found 404
        </div>

    </div>
</div>
</body>
</html>
