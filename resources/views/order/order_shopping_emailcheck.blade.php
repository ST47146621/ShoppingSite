<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


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
                font-family: 'Lato', sans-serif;
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

            }
        </style>
    </head>
    <body>
        <table style="width:600px; border-collapse: collapse;">
            <tr style="height:30px;">
                <td style="color:#fff;background-color:#455661;border-color: #455661;border-width: 15px;border-style: solid;font-weight:bold;font-size: 20px;">XX數位工程</td>      
            </tr>
            <tr style="background-color:#142a3a;color:#fff;">
                <td style="border-width:15px;border-style:solid;border-color:#142a3a;">
                     <p style="font-size:22px;border-top-width:30px;border-top-style:solid;border-top-color:#142a3a;border-left-width:20px;border-left-style:solid;border-left-color:#142a3a;border-bottom-width:10px;border-bottom-style:solid;border-bottom-color:#142a3a;">親愛的{{ $data[0]['username'] }} 您好：</p>
                    <p style="font-size:16px;border-left-width:20px;border-left-style:solid;border-left-color:#142a3a;border-right-width:20px;border-right-style:solid;border-right-color:#142a3a;">感謝您最近在XX上消費，以下為您的訂購清單，您可以至「 訂單查詢」了解最新訂單處理進度。</p>         
                </td>
            </tr>
            <tr style="background-color:#142a3a;color:#fff;">
                <td style="border-width:15px;border-style:solid;border-color:#142a3a;">
                   <table style="border: 15px solid #0F1F2A; background-color: #0F1F2A;  color: #fff; font-size: 16px;">
                        <tbody>
                        <?php 
                          $total = 0;
                        ?>
                        @foreach($data as $data)
                        <tr >
                          <td style="width:25%;"><img src="http://placehold.it/250x250" style="height:100px; width:100px;"></td>
                          <td style="width:55%;border-right-width:30px;border-right-style:solid;border-right-color:#0F1F2A;"><span style="vertical-align:top;">{{ $data['mdesc'] }}</span>
                          </td>
                          <td style="width:20%;text-align:right;""><span style="color: #fff; font-size: 16px;vertical-align:top;">
                          @if($data['price'] == ".00")
                          {{str_replace(".00","0",$data['price'])}}        
                          @else
                          {{str_replace(".00","",$data['price'])}}      
                          @endif
                          </span></td>
                        </tr>
                        <?php
                          $total += $data['price'];
                        ?>
                        @endforeach
                      </tbody>
                      <tfoot >  

                        <tr style="border-collapse: collapse;">
                            <td  style="border-top-width:2px;border-top-style:solid;border-top-color:#142a3a;"></td>
                            <td  style="border-top-width:2px;border-top-style:solid;border-top-color:#142a3a;text-align:right;">總金額：NT</td>

                            <td  style="border-top-width:2px;border-top-style:solid;border-top-color:#142a3a;text-align:right;">
                            <span > {{ $total }}</span></td>
                        </tr>
                        </tfoot>
                   </table>
                </td> 
            </tr>
             
            <tr  style="background-color:#142a3a;color:#fff;">
                <td style="border-width:15px;border-style:solid;border-color:#142a3a;">
                      <table style="border: 15px solid #0F1F2A; background-color: #0F1F2A;  color: #fff; font-size: 16px;width:100%;">
                        <thead>
                            <tr style="border-collapse: collapse;">
                                <td style="border-bottom-width:2px;border-bottom-style:solid;border-bottom-color:#142a3a;"><span >取件人資料</span></td>
                                <td style="border-bottom-width:2px;border-bottom-style:solid;border-bottom-color:#142a3a;"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <tr >
                           <td style="width:95px;"><span style="vertical-align:top;">帳戶名稱：</span></td>
                           <td style="width:505px;"><span style="vertical-align:top;">{{ $data['email'] }}</span></td>
                       </tr>
                       <tr >
                           <td style="width:95px;"><span style="vertical-align:top;">姓　　名：</span></td>
                           <td style="width:505px;"><span style="vertical-align:top;">{{ $data['dname'] }}</span></td>
                       </tr>
                       <tr >
                           <td style="width:95px;"><span style="vertical-align:top;">電　　話：</span></td>
                           <td style="width:505px;"><span style="vertical-align:top;">{{ $data['phone'] }}</span></td>
                       </tr>
                       <tr >
                           <td style="width:95px;"><span style="vertical-align:top;">地　　址：</span></td>
                           <td style="width:505px;"><span style="vertical-align:top;">{{ $data['address'] }}</span></td>
                       </tr>
                       </tbody>
                   </table>
                </td>
            </tr>
            <tr style="background-color:#142a3a;border-top-width:50px;border-top-style:solid;border-top-color:#142a3a;border-bottom-width:80px;border-bottom-style:solid;border-bottom-color:#142a3a;">
                <td style="background-color:#142a3a;border-width:15px;border-style:solid;border-color:#142a3a;">
                    <span style="background-color:#142a3a;color:#92A5B5;font-size: 14px;">若您仍有訂單相關問題，請透過客服電話：931-777-262聯絡。</span>
                </td>
            </tr>
            
            <tr style="height:20px; ">
                <td style="background-color:#677A86;border-left-width:15px;border-right-width:15px;border-left-style:solid;border-right-style:solid;border-left-color:#677A86;;border-right-color:#677A86;">
                    <p style="border-left-width:185px;border-left-style:solid;border-left-color:#677A86; color:#fff;font-size:14px;">海量數位工程股份有限公司</p>
                </td>
            </tr>
            
        </table>

    </body>
</html>
