<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
      .div_center {
        text-align:center;
        padding-top:40px;
      }
      .font_size{
        font-size: 40px;
        padding-bottom: 40px;
      }
      .text_color{
        color: black;
        padding-bottom: 20px;
      }
      label{
        display: inline-block;
        width:200px;
      }
      .div_design{
        padding-bottom: 15px;
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
            <div class="div_center">

              @if(session()->has('message'))

              <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p>{{ session()->get('message') }}</p>
                
              </div>

            @endif

              <h1 class="font_size">Add Product</h1>
              <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

                @csrf

              <div class="div_design">  
              <label for="title">Product Title: </label>  
              <input class="text_color" type="text" name="title" placeholder="Write a title" id="title" required> 
              </div>
              <div class="div_design">  
              <label for="description">Product Description: </label>  
              <input class="text_color" type="text" name="description" placeholder="Write a description" id="description" required> 
              </div>
              <div class="div_design">  
              <label for="price">Product Price: </label>  
              <input class="text_color" type="number" name="price" placeholder="Write a price" id="price" required> 
              </div>
              <div class="div_design">  
              <label for="discount_price">Discount Price: </label>  
              <input class="text_color" type="number" name="discount_price" placeholder="Write a discount" id="discount_price"> 
              </div>
              <div class="div_design">  
              <label for="quantity">Product Quantity: </label>  
              <input class="text_color" type="number" min="0" name="quantity" placeholder="Write a quantity" id="quantity" required> 
              </div>
              
              <div class="div_design">  
              <label for="category">Product Category: </label>  
              <select class="text_color"  name="category"  id="category" required>
              <option value="" selected="">Add a category here</option> 
              @foreach($categories as $category) 
              <option value="{{$category->category_name}}">{{$category->category_name}}</option>
              @endforeach
              </select>
              </div>
              <div class="div_design">  
              <label for="image">Product Image Here: </label>  
              <input type="file" name="image" required>
              </div>

              <div class="div_design">  
               
              <input type="submit" name="image" value="Add Product" class="btn btn-primary">
              </div>

              </form>
            </div>
          </div>
        </div>    
      
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>