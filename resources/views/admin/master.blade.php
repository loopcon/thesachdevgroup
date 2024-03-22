<html>
<head>
    @include('admin.layout.headerscript')
    @include('admin.layout.header')
</head>
<body> 
    @include('admin.layout.sidebar')
</body>
    
    @include('admin.layout.footerscript')
 
    <script>
        $(document).ready(function () {
          $('.select2').select2();
        });
    </script> 
     
</html>