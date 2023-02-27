<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    
    <title>CRUD- @yield('title')</title>
    <style>
        a{
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
        <div>
            @yield('products')
            @yield('script')
        </div>
        
        
{{-- <script type="text/javascript">

    $.noConflict();
    
    $(document).ready(function(){
        $('#product_table').DataTable();
    });
    
    </script> --}}

</body>
</html>