<!DOCTYPE html>
<html lang="en">

 @include('layouts.content._head')

  <body>

   @include('layouts.content._navbar')

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          @yield('content')

          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>

        </div>

        @include('layouts.content._sidebarWidget')

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

   @include('layouts.content._footer')

   @include('layouts.content._script')
   @yield('script')

  </body>

</html>
