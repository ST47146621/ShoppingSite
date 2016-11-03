<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
        <div class="title">親愛的會員 您好：<br>

這封認證信是由XX股份有限公司發出，用以處理您忘記密碼，當您收到本「認證信函」後，請直接點選下方連結重新設置您的密碼</div>
        <div class="title">{{ $key['password'] }}</div>
        <div class="title">為了確保您的會員資料安全，重設密碼的連結將於此信件寄出後15分鐘後或您重設密碼後失效。<br><br>

＊ 此信件為系統發出信件，請勿直接回覆，感謝您的配合。謝謝！＊</div>
    </div>
</div>
</body>
</html>
