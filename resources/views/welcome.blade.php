<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=OpenSans:400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #636b6f;
                color: #434b4f;
                font-family: 'OpenSans', sans-serif;
                font-weight: 400;
                font-size: 18px;
                margin: 0;
            }

            .content {
                box-sizing: border-box;
                background-color: #fff;
                border-radius: 10px;
                border: 3px solid #485479;
                padding: 0 50px 30px;
                max-width: 1200px;
                margin: 30px auto;
            }
        </style>
    </head>
    <body>
        <div class="content">
            {!! $content !!}
        </div>
    </body>
</html>
