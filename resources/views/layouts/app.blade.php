
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>App Name - @yield('title')</title>
    <meta name="metro4:init" content="false">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="/assets/metro4/build/css/metro-all.min.css">
            <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">


            <script src="{{ asset('assets/js/redom.js') }}"></script>
            
           

            <!-- development version, includes helpful console warnings 
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->



<script>
  var fromErrors,success;
  const currency = @json(config('currency'))

  @if (isset($errors) && method_exists($errors,'any') && $errors->any())
fromErrors =   @json($errors->all());
@elseif (session()->has('error'))
    var x = 'error';
fromErrors =   @json(session('error'))
@elseif (session()->has('success'))
success = "<?php echo session('success'); ?>"
  @endif
  const serverMassage =   {!! \App\Exceptions\FlashMessage\Flash::withFormErrors($errors)->get()->toJson() !!}

</script> 

  </head>
  <body>
  <div id="app" class="{{config('view.themes')}}">
   <header  data-role="appbar" data-expand-point="md" >
    <a href="#" class="brand no-hover">
        <span  class="pl-2 pr-2 border bd-dark border-radius">
           bkash
        </span>
    </a>

  @yield('topMenu')
</header>
<div class="container">
    <!-- content here -->
<main class="row">
<aside>
  <!--start menu-->
 
@yield('leftMenu')
  <!--end menu-->
</aside>
<article class="cell">
 <section class="pageTitleBox">
  
     <div class="row">
    
    <div class="cell">
      <h2> @yield('pageTitle')</h2>
    </div>
  
 
</div>
 </section>
 <section>

    @yield('optionBar')
 </section>
@yield('content')
    
 
</article>
    @if(\Illuminate\Support\Facades\Route::currentRouteName() =='request.create')


  @component('others.indexCharms', ['leftMenu'=>$leftMenu])
        @endcomponent
    @endif
</main>




</div>


</div>


  <script src="{{ asset('assets/metro4/build/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/metro4/build/js/metro.min.js') }}"></script>

  <script src="{{ asset('assets/js/myvue.js') }}"></script>
  <script src="{{ asset('assets/js/vendor.js') }}"></script>
  <script src="{{ asset('assets/js/manifest.js') }}"></script>

  <script src="{{ asset('assets/js/app.js') }}"></script>





  @stack('scriptsTop')


  <script src="{{ asset('assets/js/downGlobal.js') }}"></script>
  @yield('scriptTagBottom')


  @stack('scriptsBottom')




  <script>


      window.onload = function () {
          //saif.loader.text('amar songar bangla').openSquare();
      }

  </script>

  </body>
</html>