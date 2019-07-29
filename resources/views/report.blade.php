@extends('layouts.set')
@section("required")

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
                        <a  href="/payment" style="background: #3980b5;"><i class="fa fa-qrcode fa-3x"></i> Payments</a>
                    </li>
                     <li>
                        <a  href="/report" style="background: #104075"><i class="fa fa-qrcode fa-3x"></i> Report</a>
                    </li>
                   
						   <li  >
                        <a   href="/stat" style="background: #3980b5;"><i class="fa fa-bar-chart-o fa-3x"></i> Statistics</a>
                    </li>
                    <li  >
                        <a  href="/member" style="background: #3980b5;"><i class="fa fa-table fa-3x"></i> Members</a>
                        
                    </li>	
                      <li  >
                        <a  href="/record" style="background: #3980b5;"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                    
                    <li  >
                        <a  href="/upgrade" style="background: #3980b5;"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>				
			        <li  >
                        <a  href="/newuser" style="background: #3980b5;"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>	
                    <li  >
                            <a  href="/newdist" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New District</a>
                        </li>
                </ul>
               
            </div>
        </nav> 

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Contributions Report</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>

                <!-- @yield('planner') -->

                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="">
                            
                        </div>
                        <div class="">
                            
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            <div class="row" >
                <div class="col-md-11" style="padding-left: 100px;">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Wellwishers
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>District</th>
                                            <th>Month</th>
                                            <!-- <th>No. of enrolls</th> -->
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contrtable as $row)
                                       <tr>     
                                          
                                          <td>{{$row->source}}</td>
                                          <td>{{$row->Amount}}</td>
                                          <td>{{ $row->district}}</td>
                                          <td>{{ $row->date}}</td>
                                          
                                       </tr>
                                       @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
                
           
                     <!--  End  Bordered Table  -->

          
             
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
            <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
@endsection
