
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
                        <a href="/" style="background: #3980b5;"><i class="glyphicon glyphicon-home fa-3x"></i> Dashboard</a>
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
                        <a  href="/member" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Members</a>
                        
                    </li>	
                      <li  >
                        <a  href="/record" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                   
                    <li  >
                        <a  href="/upgrade" style="background: #104075"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>				
                    <li  >
                        <a  href="/newuser" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>	
                    <li >
                        <a  href="/newdist" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New District</a>
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
                     <h2>Upgrade page</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>

                <!-- /.UPGRADE -->
                <!--added for document purpose-->
                <div id="upgrade panel panel-default">
                    <div class="qualify panel-body">
                            @if(session('success'))
                         
                            <h4 style="color:green">{{session('success')}}</h4>
                          @elseif ($errors->any()) 
                            <h4 style="color:red">{{$errors->first()}}</h4>
                           @else
                                   <h4 style="color:orange">{{'Members available for upgrade'}}</h4>
                          @endif
                        <h2 class="qualify">Qualify</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>gender</th>
                                </tr>
                                     @foreach($memberqualify as $row)
                                       <tr>     
                                          <td>{{$row->districtNO}}</td>
                                          <td>{{$row->fname}}</td>
                                          <td>{{ $row->gender}}</td>
                                       </tr>
                                       @endforeach
                            </table>
                        </div>
                        <script>
                                $(document).ready(function(){
                                    $("table").click(function(){
                                        $(this).hide();
                                    });
                                });
                                </script> 
                                <form>
                        <button><a href="/upgrade/do">Random distribution</a></button>
                       
                    </div>
                    <div class="qualify panel-body">
                        <h2>Districts available</h2>
                        <!-- <select name="" id="" style="display: inline"><option value="Number of agets">Agents &lt;:<input type="number" name="" id=""></option><option value="members">Members &lt;: <input type="number" name="" id=""></option></select>
                            -->
                        <div class="district table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>                                    
                                    <th>Distric number</th>
                                    <!-- <th>Initial</th> -->
                                    <th>Name</th>
                            
                                </tr>
                                @foreach($districtAvailable as $row)
                                       <tr>     
                                          <td>{{$row->id}}</td>
                                          <td>{{$row->name}}</td>
                                       </tr>
                                       @endforeach
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
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
