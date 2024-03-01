<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">

    @include('admin.css')
    <style>
      .title_deg{
        font-size: 30px;
        text-align: center;
        padding: 20px;
        
      }
      .fild{
        padding-left:35% ;
        padding-top: 30px;

      }
      label{
        display: inline-block;
        width: 200px;
        font-weight: bold;
      }
      .button{
        margin: auto;
        padding-top: 35px;
        width: 150px;
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

            <h1 class="title_deg">Send Email To :  {{$order->email}}</h1>

            @if(session()->has('message'))

              <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p>{{ session()->get('message') }}</p>
                
              </div>

            @endif
            
            <form action="{{url('send_user_email',$order->id)}}" method="Post">
              @csrf

            <div class="fild">
              <label>Email Greeting: </label>
              <input style="color:black;" type="text" name="greeting">
            </div>
            <div class="fild">
              <label>Email Firstline: </label>
              <input style="color:black;" type="text" name="firstline">
            </div>
            <div class="fild">
              <label>Email body: </label>
              <input style="color:black;" type="text" name="body">
            </div>
            <div class="fild">
              <label>Email Button name: </label>
              <input style="color:black;" type="text" name="button">
            </div>
            <div class="fild">
              <label>Email Url: </label>
              <input style="color:black;"  type="text" name="url">
            </div>
            <div class="fild">
              <label>Email Last Line: </label>
              <input style="color:black;" type="text" name="lastline">
            </div>
            <div class="button">
              
              <input  type="submit" value="Send Email" class="btn btn-primary">
            </div>

            </form>

          </div>
    </div>        
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>