
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
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

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
                        <a href="/" style="background: #104075;"><i class="glyphicon glyphicon-home fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a   href="/high" style="background: #3980b5;"><i class="fa fa-desktop fa-3x"></i> Hierarchy</a>
                    </li>
                        <li>
                        <a  href="/payment" style="background: #3980b5"><i class="fa fa-qrcode fa-3x"></i> Payments</a>
                    </li>
                     <li>
                        <a  href="/report" style="background: #3980b5"><i class="fa fa-qrcode fa-3x"></i> Report</a>
                    </li>
                   
                           <li  >
                        <a   href="/stat" style="background: #3980b5"><i class="fa fa-bar-chart-o fa-3x"></i> Statistics</a>
                    </li>   
                      <li  >
                        <a  href="/record" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                    <li  >
                        <a  href="/member" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Members</a>
                        
                    </li>
                    <li  >
                        <a  href="/upgrade" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>               
                    <li  >
                        <a  href="/newuser" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>   
                    <li  >
                            <a  href="/newdist" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New Dist</a>
                        </li>
                </ul>
                </ul>
               
            </div>
            
        </nav>
        

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2> 
                        
                    <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12" >           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="  fa fa-users"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                    <!-- displaying agents enrolled -->
                      {{$results}}
                     Enrolled</p>
                    <p class="text-muted">Members</p>
                </div>
             </div>
             </div>
             
           <div class="col-md-4 col-sm-6 col-xs-12">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fas fa-users"></i>
                </span>
                <div class="text-box" >
                         <!-- displaying all agents available  -->
                    <p class="main-text">{{$agents}} Agents</p>
                    <p class="text-muted">Available</p>
                </div>
             </div>
             </div>
             <div class="col-md-4 col-sm-6 col-xs-12">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <div class="text-box" >
                             <!-- displaying all agents available  -->
                        <p class="main-text">{{$agenthead}} Agent heads</p>
                        <p class="text-muted">Available</p>
                    </div>
                 </div>
                 </div>
            <div class="col-md-4 col-sm-6 col-xs-12">           
              <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                    <i class="fas fa-location-arrow"></i>
                   </span>
                    <div class="text-box" >
                       <p class="main-text">
                        <!-- displaying district with no agents -->
                          @foreach($district as $dist)
                           {{$dist->nums}}
                            @endforeach
                            Districts</p>
                          <p class="text-muted">With no agent</p>
                    </div>
             </div>
             </div>
             <div class="col-md-4 col-sm-6 col-xs-12">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                      <i class="fas fa-location-arrow"></i>
                     </span>
                      <div class="text-box" >
                         <p class="main-text">
                          <!-- displaying district with no agents -->
                          @if(empty($districtname))

                          NO
                      
                           @else
                            @foreach($districtname as $dist)
                             {{strtoupper($dist->name)}}
                              @endforeach
                              @endif

                              DISTRICT</p>
                            <p class="text-muted">With highest enrollment</p>
                      </div>
               </div>
               </div>
             
             
            <div class="col-md-4 col-sm-6 col-xs-12">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="  fas fa-user-graduate"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">
                
                      {{$co}}
                    
                      Member</p>
                    <p class="text-muted">Qualifed upgrade</p>
                </div>
             </div>

             </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-black set-icon">
                        <i class="fab fa-google-wallet"></i>
                     </span>
                      <div class="text-box" >
                         <p class="main-text">
                          <!-- displaying district with no agents -->
                          @if($amount==[])

                            {{0}}
                           @else
                            @foreach($amount as $amo)
                             {{$amo->amount}}
                              @endforeach
                              @endif
                              SHILLINGS</p>
                            
                            <p class="text-muted">Available at the end of the month</p>
                      </div>
               </div>
               </div>
                    <!-- /. ROW  -->
                 <div class="row">
                    <div class="panel" style="height: 1000px">
                  
                    </div>
                    
                 </div>
                 <!-- /. ROW  -->
                <!-- /. ROW  -->
                
                </div>
                    
                 <!-- /. ROW  -->           

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
