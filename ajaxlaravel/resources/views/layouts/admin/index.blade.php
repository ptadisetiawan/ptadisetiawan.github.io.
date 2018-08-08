<!DOCTYPE html>
<html lang="en">

  @include('layouts.admin._head')

  <body id="page-top">

    @include('layouts.admin._navbar')

    <div id="wrapper">

      @include('layouts.admin._sidebar')

      <div id="content-wrapper">

        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->

       @include('layouts.admin._footer')

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('layouts.admin._scrollToTopBtn')

    @include('layouts.admin._script')
    @yield('script')
  </body>

</html>
