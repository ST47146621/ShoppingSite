<html><body>
<title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="tools/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>

@foreach($data as $data)
	<div>
		<a href="product_info?id={{$data->bid}}">{{$data->mdesc}}</a>
	</div>              
@endforeach

</body></html>