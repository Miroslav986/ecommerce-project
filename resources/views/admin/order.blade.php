<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
      .title_deg{
        font-size: 40px;
        text-align: center;
        padding: 20px;
        font-weight: bold;
      }
      .table_deg{
        margin: auto;
        width:100%;
        border: 3px solid white;
        text-align: center;
        margin-top: 40px;

      }
      .th_color{
        background:skyblue;
        padding: 20px;
      }
      td {
        padding-left: 15px;
        padding-right: 15px;
        border-bottom: 1px solid white;
      }
      .search{
        margin:auto;
        padding-top:30px;
        padding-bottom:30px;
        padding-left:42%;
      }
      
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">

            <h1 class="title_deg">All Orders</h1>

            <div class="search">
                <form action="{{ url('search') }}" method="get">
                  @csrf

                  <input style="color:black;" type="text" name="search" placeholder="Search For Something">

                  <input type="submit" value="Search" class="btn btn-outline-primary">

                </form>

            </div>


            <div>
              
              <table class="table_deg">
                <tr>
                  <th class="th_color">Name</th>
                  <th class="th_color">Email</th>
                  <th class="th_color">Address</th>
                  <th class="th_color">Phone</th>
                  <th class="th_color">Product Title</th>
                  <th class="th_color">Quantity</th>
                  <th class="th_color">Price</th>
                  <th class="th_color">Payment Status</th>
                  <th class="th_color">Delivery Status</th>
                  <th class="th_color">Image</th>
                  <th class="th_color">Delivered</th>
                  <th class="th_color">Print PDF</th>
                  <th class="th_color">Send Email</th>

                 
                </tr>
                @forelse($orders as $order)
                <tr>
                  <td>{{$order->name}}</td>
                  <td>{{$order->email}}</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->product_title}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->payment_status}}</td>
                  <td>{{$order->delivery_status}}</td>
                  <td><img style="height: 100px; width:100px" src="/product/{{$order->image}}"></td>
                  <td>
                  @if($order->delivery_status != 'delivered')
                  
                  <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this product is delivered !!')" class="btn btn-sm btn-primary">Delivered</a>
                  
                  @else
                    <p style="color:green;">Delivered</p>
                  @endif

                  </td>
                  <td>
                    <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-sm btn-secondary">Print PDF</a>
                  </td>
                  <td>
                    <a href="{{ url('send_email',$order->id) }}" class="btn btn-sm btn-info">Send Email</a>
                  </td>
                </tr>

                @empty

                <tr>
                  <td colspan="16">
                    No Data Found
                  </td>
                </tr>


                @endforelse
              </table>
            </div>

          </div>
      </div>      
    
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>