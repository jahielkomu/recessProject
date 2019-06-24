<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
            <!-- FONTAWESOME STYLES-->
            <link href="assets/css/font-awesome.css" rel="stylesheet" />
            <!-- MORRIS CHART STYLES-->
            <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
            <!-- CUSTOM STYLES-->
            <link href="assets/css/custom.css" rel="stylesheet" />

        <!-- Styles -->
        <style>
          
          
        </style>
    </head>
    <body>
      <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0;background-color: rgb(0, 162, 255)">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" style="background: #2970b5" >Administrator</a> 
            </div>
            
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;background-color: "> Last access : <script>document.write(Date());</script> &nbsp; 
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  v-pre>
                                   <b class="btn btn-danger square-btn-adjust"> {{ Auth::user()->name }}</b> <span class="caret"></span>
                                </a>
                                 
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <b  >  {{ __('Logout') }} </b>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                            
                  </div>                  
        </nav> 
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse" style="background-color: #999">
                <ul class="nav" id="main-menu" style="background: #3980b5">
				<li class="text-center" style="background: #3980b5">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li style="background-color: rgb(0, 85, 182)">
                        <a href="/" style="background: #3980b5;"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a   href="/high" style="background: #3980b5;"><i class="fa fa-desktop fa-3x"></i> Hierarchy</a>
                    </li>
                        <li>
                        <a  href="/payment" style="background: #3980b5"><i class="fa fa-qrcode fa-3x"></i> Payments</a>
                    </li>
                   
						   <li  >
                        <a   href="/stat" style="background: #3980b5"><i class="fa fa-bar-chart-o fa-3x"></i> Statistics</a>
                    </li>	
                      <li  >
                        <a  href="/record" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                    <li  >
                        <a  href="/upgrade" style="background: #104075"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>				
			
                </ul>
               
            </div>
            
        </nav> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Upgrade page</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>

                <!-- /.UPGRADE -->
                <!--added for document purpose-->
                <div id="upgrade panel panel-default">
                    <div class="qualify panel-body">
                        <h2 class="qualify">qualify</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Registeration Date</th>
                                <th>Recomender</th>
                                <th>District</th>
                                <th>sign</th>
                                </tr>
                                <tr>
                                    <td>WK001</td>
                                    <td>Tendo J. Caleb</td>
                                    <td>09 May 2019</td>
                                    <td>Komu</td>
                                    <td>Nakaseke</td>
                                    <td>TC</td>
                                </tr>
                                <tr>
                                    <td>KL005</td>
                                    <td>T. Jecniah</td>
                                    <td>07 June 2019</td>
                                    <td>Komu</td>
                                    <td>Wakiso</td>
                                    <td>TJ</td>
                                </tr>
                                <tr>
                                    <td>KO001</td>
                                    <td>Kom Komu</td>
                                    <td>05 June 2019</td>
                                    <td>Aksam</td>
                                    <td>Kampala</td>
                                    <td>KK</td>
                                </tr>
                                <tr>
                                    <td>KT001</td><!--KT for Kitugum-->
                                    <td>Oboth Julius</td>
                                    <td>24 July 2019</td>
                                    <td>Aksam</td>
                                    <td>Kalangala</td>
                                    <td>OJ</td>
                                </tr>
                            </table>
                        </div>
                        <script>
                                $(document).ready(function(){
                                    $("table").click(function(){
                                        $(this).hide();
                                    });
                                });
                                </script>
                        <button onclick="rand()">Random distribute</button>
                    </div>
                    <div class="qualify panel-body">
                        <h2>Districts available</h2>
                        <!-- <select name="" id="" style="display: inline"><option value="Number of agets">Agents &lt;:<input type="number" name="" id=""></option><option value="members">Members &lt;: <input type="number" name="" id=""></option></select>
                            -->
                        <div class="district table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>                                    
                                    <th>Distric number</th>
                                    <th>Initial</th>
                                    <th>Name</th>
                                    <th> No. of agents</th>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>WK</td>
                                    <td>Wakiso</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                <tr>
                                        <td>34</td>
                                        <td>KA</td>
                                        <td>Kalangala</td>
                                        <td>2</td>
                                </tr>
                                <tr>
                                        <td>02</td>
                                        <td>KL</td>
                                        <td>Kampala</td>
                                        <td>15</td>
                                </tr>
                                <tr>
                                        <td>09</td>
                                        <td>MK</td>
                                        <td>Mukono</td>
                                        <td>3</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>



              
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
