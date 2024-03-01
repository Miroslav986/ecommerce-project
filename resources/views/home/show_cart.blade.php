<!DOCTYPE html>
<html>
   <head>
      <!-- SweetAlert cdn link   -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- Basic -->
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
      <style type="text/css">

         .center{
            margin:auto;
            width:50%;
            text-align:center;
            padding:30px;
         }

         table,th,td{
            border:1px solid gray;
            padding:15px;
         }
         .th-deg{
            background-color:skyblue;
            font-size:25px;
         }
         .total{
            font-size:20px;
            font-weight:bold;
            margin-top:15px;
            margin-bottom:15px;
            text-align:left;
            padding:15px;
            background-color:skyblue;
            width:30%;

         }
      

      </style>
   </head>
   <body>

      @include('sweetalert::alert')

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
               <th class="th-deg">Product title</th>
               <th class="th-deg">Product quantity</th>
               <th class="th-deg">Price</th>
               <th class="th-deg">Image</th>
               <th class="th-deg">Action</th>
            </tr>

            <?php $totalPrice = 0; ?>

            @foreach($cart as $cart)
            <tr>
               <td>{{ $cart->product_title }}</td>
               <td>{{ $cart->quantity }}</td>
               <td>{{ $cart->price }} $</td>
               <td><img style="width: 100px" height="100px" src="/product/{{ $cart->image }}"></td>
               <td><a onclick="confirmation(event)" href="{{ url('/remove_cart',$cart->id) }}" class="btn btn-sm btn-danger">Remove Product</a></td>
            </tr>
            <?php  $totalPrice = $totalPrice + $cart->price   ?>
            @endforeach
         </table>
         <div>
            <h1 class="total">Total Price: {{ $totalPrice }} $</h1>
         </div>
         <div>
            <h1 style="font-size: 20px; padding-bottom: 10px;">Proceed to Order</h1>
            <a href="{{ url('cash_order') }}" class="btn btn-sm btn-danger">Cash On Delivery</a>
            <a href="{{ url('stripe',$totalPrice) }}" class="btn btn-sm btn-danger">Pay Using Card</a>
         </div>


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
            title: "Are you sure to cancel this product",
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