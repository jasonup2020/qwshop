{"code":@yield('code'),"msg":"@yield('title')   @yield('code', __('Oh no'))  @@@Server Error Please check your code@@@  @yield('message')  {{ app('router')->has('home') ? route('home') : url('/') }}     {{ __('Go Home') }} ","data":[]} 