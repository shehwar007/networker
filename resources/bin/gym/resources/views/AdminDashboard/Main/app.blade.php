<!DOCTYPE html>
<html lang="en">
@include('AdminDashboard.inc.header')


<body>
    <div id="app">
        @include('AdminDashboard.inc.sidebar')

        <div id="main" class='layout-navbar'>
        @include('AdminDashboard.inc.topbar')
        
           
            <div id="main-content">
                
                @yield('page_content')
             
                @include('AdminDashboard.inc.footer')

            </div>
        </div>
    </div>
    @include('AdminDashboard.inc.js')
  

</body>

</html>