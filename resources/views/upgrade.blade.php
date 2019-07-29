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
                        <a  href="/payment" style="background: #3980b5"><i class="fa fa-qrcode fa-3x"></i> Payments</a>
                    </li>
                     <li>
                        <a  href="/reports" style="background: #3980b5"><i class="fa fa-qrcode fa-3x"></i> Reports</a>
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
<<<<<<< HEAD
                 <!-- <form> -->
                        <button><a href="/upgrade/do">Random distribution</a></button>
                       
=======
                                <form>
                        <button><a href="/upgrade/do">Random distribute</a></button>
                        @if(session('success'))
                 
                         <h4 style="color:red">{{session('success')}}</h4>
                       @endif
>>>>>>> 594e9228689b0be4212349d05c1db05b05021342
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
                
                <!-- </form> -->


              
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

</div>
</div>
</div>
</div>
</div>
</body>
</html> 
