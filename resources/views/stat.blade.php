@extends('layouts.set')
@section("required")

        {!! Charts::styles() !!}
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
                        <a   href="/stat" style="background: #104075;"><i class="fa fa-bar-chart-o fa-3x"></i> Statistics</a>
                    </li>	
                    <li  >
                        <a  href="/member" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Members</a>
                        
                    </li>
                      <li  >
                        <a  href="/record" style="background: #3980b5"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                    <li>
                        <a  href="/upgrade" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>				
			        <li>
                      <a  href="/newuser" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>
                    <li>
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
                     <h2>Statistics</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
             
                  <div class="row">                     
                      
                    <div class="col-md-10 col-sm-10 col-xs-10">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Members  enrollment
                            </div>
                            <div class="panel-body">
                                <div class="app" > 
                                    
                                
                  
                                      {!! $chart->html() !!}
                                  
                                   
                                  </div> 
                            </div>
                        </div>            
                    
                    
               </div>
                     <!-- /. ROW  -->
        </div>
                 <!-- /. ROW  -->
             <div class="row">                     
                      
                <div class="col-md-10 col-sm-10 col-xs-10">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Wellwisher's contribution per month
                        </div>
                        <div class="panel-body">
                            <div class="app" > 
                                
         
                                  {!! $chart2->html() !!}
                              
                               
                              </div> 
                        </div>
                    </div>            
                
                
           </div>
                 <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            
        

            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <
    
     {!! Charts::scripts() !!}

     {!! $chart->script() !!}
     {!! $chart2->script() !!}
  
</div>
@endsection