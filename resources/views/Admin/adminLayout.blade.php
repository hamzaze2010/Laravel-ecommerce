<!DOCTYPE html>



<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>We can</title>
    
  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{asset('admin/plugins/material/css/materialdesignicons.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/plugins/simplebar/simplebar.css')}}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset('admin/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
  
  
  
  
  <link href="{{asset('admin/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
  
  
  
  <link href="{{asset('admin/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
  
  
  
  <link href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  
  
  
  <link href="{{asset('admin/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
  
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{asset('admin/css/style.css')}}" />

  


  <!-- FAVICON -->
  <link href="{{asset('admin/images/favicon.png')}}" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{asset('admin/plugins/nprogress/nprogress.js')}}"></script>

  <style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
  </style>
</head>
<body class="navbar-fixed sidebar-fixed" id="body">
  
<script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
</script>

    
    <div id="toaster"></div>
    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      
      
      
        

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">
    
        
      @include('Admin.adminHeader')
      @include('Admin.adminLeftNavbar')

      <div class="content"  id="content">
        @yield('content')
      </div>

      @include('Admin.adminFooter')

      <script>
    function search() {
        var query = document.getElementById('search-input').value.trim().toLowerCase();
        
        // Remove previous highlights
        var elements = document.querySelectorAll('.highlight');
        elements.forEach(function (element) {
            element.outerHTML = element.innerHTML;
        });

        if (query === '') {
            return;
        }

        var tableRows = document.querySelectorAll('table tbody tr');
        tableRows.forEach(function (row) {
            row.style.display = ''; // Reset display property
            var cells = row.querySelectorAll('td');
            var matchFound = false;
            cells.forEach(function (cell) {
                var cellText = cell.textContent.toLowerCase();
                if (cellText.includes(query)) {
                    matchFound = true;
                    var regex = new RegExp(query, 'gi');
                    cell.innerHTML = cell.innerHTML.replace(regex, function (match) {
                        return '<span class="highlight">' + match + '</span>';
                    });
                }
            });
            if (!matchFound) {
                row.style.display = 'none'; // Hide rows that do not match the query
            }
        });
    }

    document.getElementById('searchForm').addEventListener('submit', function (e) {
        e.preventDefault();
        search();
    });
</script>
<style>
    .highlight {
        background-color: yellow;
    }
</style>




    </body>
</html>      

      

      