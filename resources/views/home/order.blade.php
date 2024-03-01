
<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style>
      	.center{
      		margin:auto;
            width:50%;
            text-align:center;
            padding:30px;

      	}
      	table,th,td{
            border:1px solid gray;
            padding:10px;
         }
         .th-deg{
            background-color:skyblue;
            font-size:20px;
            padding:15px;
            font-weight:bold;
         }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         @if(session()->has('message'))

              <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p>{{ session()->get('message') }}</p>
                
              </div>

            @endif
         <div class="center">
         	<table>
         		<tr>
       				<th class="th-deg">Product Title</th>
       				<th class="th-deg">Quantity</th>
       				<th class="th-deg">Price</th>
       				<th class="th-deg">Payment Status</th>
       				<th class="th-deg">Delivery Status</th>
       				<th class="th-deg">Image</th>
       				<th class="th-deg">Cancel Order</th>
         		</tr>
         		@foreach($orders as $order)
         		<tr>
         			<td>{{ $order->product_title }}</td>
         			<td>{{ $order->quantity }}</td>
         			<td>{{ $order->price }}</td>
         			<td>{{ $order->payment_status }}</td>
         			<td>{{ $order->delivery_status }}</td>
         			<td><img style="width:100px; height:100px ;" src="/product/{{ $order->image }}"></td>
         			<td>
         				@if($order->delivery_status == 'processing')

         				<a onclick="confirmation(event)" href="{{ url('cancel_order',$order->id) }}" class="btn btn-sm btn-danger">Cancel Order</a>
         			</td>
         				@else
         				 <p style="color:blue;">Not Allowed</p>
         				@endif
         		</tr>
         		@endforeach
         	</table>
         	
         </div>
 
      
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>

      <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure you want to delete the order?",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


        });

        
    }
</script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>