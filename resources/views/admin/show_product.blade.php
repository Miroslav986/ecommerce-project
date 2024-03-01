<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
      .center{
        margin: auto;
        width:50%;
        border: 3px solid white;
        text-align: center;
        margin-top: 40px;
      }
      .font_size{
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
      }
      .img_size{
        width: 100 px;
        height: 100 px;
      } 
      .th_color{
        background:skyblue;
      }
      .th_deg{
        padding: 30px;
      }
      td{
        border-bottom:1px solid white;
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

             @if(session()->has('message'))

              <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p>{{ session()->get('message') }}</p>
                
              </div>

            @endif

            <h2 class="font_size">All Products</h2>
            <table class="center">
              <tr class="th_color">
                <th class="th_deg">Product title</th>
                <th class="th_deg">Description</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Category</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Discount Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Edit</th>
              </tr>
              @foreach($products as $product)
              <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount_price}}</td>
                <td>
                  <img class="img_size" src="/product/{{$product->image}}">
                </td>
                <td><a onclick="return confirm('Are You Sure To Delete This')" href="{{ url('/delete_product',$product->id) }}" class="btn btn-sm btn-danger">Delete</a></td>
                <td><a href="{{ url('/update_product',$product->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
              </tr>
              @endforeach
            </table>

          </div>  
      </div>    
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>