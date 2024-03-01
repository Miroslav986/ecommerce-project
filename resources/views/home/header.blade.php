<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="/images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        @if($active == 'home')
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('/') }}" >Home <span class="sr-only">(current)</span></a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link " href="{{ url('/') }}" >Home <span class="sr-only">(current)</span></a>
                        </li>
                        @endif
                        @if($active == 'products')
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('products') }} ">Products</a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('products') }} ">Products</a>
                        </li>
                        @endif
                        @if($active == 'about')
                       <li class="nav-item active">
                           <a class="nav-link" href="{{ url('about') }}">About <span class="sr-only">(current)</span></a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('about') }}">About <span class="sr-only">(current)</span></a>
                        </li>
                        @endif
                        @if($active == 'blog')
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('blog') }}">Blog</a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('blog') }}">Blog</a>
                        </li>
                        @endif
                        @if($active == 'contact')
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                        </li>
                        @endif
                        
                        @if($active == 'orders')
                         <li class="nav-item active">
                           <a class="nav-link" href="{{ url('show_order') }}">Orders</a>
                        </li>
                        @else
                         <li class="nav-item">
                           <a class="nav-link" href="{{ url('show_order') }}">Orders</a>
                        </li>
                        @endif
                         
                        

                        @if (Route::has('login'))

                        @auth

                        <li class="nav-item">
                           <a class="nav-link"  style="background-color: skyblue; " href="{{url('show_cart')}}">Cart <span style="color: green;">[ {{$cart_count}} ]</span></a>
                        </li>

                        @else

                        <li class="nav-item">
                           <a class="nav-link"  style="background-color: skyblue; width:115px;  padding:4px 3px; margin-left:3px; " href="{{url('show_cart')}}">Cart <span style="color: green;">[ 0 ]</span></a>
                        </li>

                       
                        @endauth

                        @endif


                     
                        
                        
                        
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                           <x-app-layout>
   
                           </x-app-layout>
                        </li>
                        @else
                         <li class="nav-item">
                           <a class="btn btn-sm btn-primary mr-3 ml-3" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-sm btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                        @endif

                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>