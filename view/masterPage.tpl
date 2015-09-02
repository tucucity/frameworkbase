<!DOCTYPE html>
<html lang="es" ng-app="App">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{PROYECTO}</title>
      <link rel="icon" href="{IMG}favicon.png">
    <!-- Bootstrap -->
    <link href="{CSS}bootstrap.css" rel="stylesheet">
    <link href="{CSS}bootstrap-theme.css" rel="stylesheet">
    <link href="{CSS}font-awesome.min.css" rel="stylesheet">
    <link href="{CSS}default.css" rel="stylesheet">
    <link href="{CSS}simple-sidebar.css" rel="stylesheet">
    <link href="{CSS}sequence.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>  
    <!-- Add your menu here-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img alt="Proyecto" src="{IMG}iconMenu.png" style="width: 40px">
                    <a class="navbar-brand" href="#">{PROYECTO}</a>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!-- itemMenuSimplePHP -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- Add Here your view-->
    <div class="container-fluid">
      {view}
    </div>  
      <!-- Footer here-->
    <script src="{JS}jquery"></script>
    <script src="{JS}bootstrap.min"></script>
    <script src="{JS}jquery.sequence-min"></script>
    <script src="{JS}angular.min"></script>
    <script>app = angular.module('App', []);</script>
    <script src="{JS}default"></script>

    <script src="{SJS}simplephpAdmin"></script>
    <!-- SimpleJS -->

  </body>
</html>