<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Task Manager</title>
        @include('includes.head')
        @include('includes.scripts')
    </head>
    <body>
        @include('includes.navbar')
        <!-- Page content -->
        <div class="page-content">
            @include('includes.sidebar')
            
            <!-- Main content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /main content -->

        </div>
        <!--End Page content -->
    </body>
</html>
