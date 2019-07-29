@extends('layouts.set')
@section("required")

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
                        <a  href="/upgrade" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>				
			        <li  >
                        <a  href="/newuser" style="background: #104075"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>	
                    <li  >
                            <a  href="/newdist" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New District</a>
                        </li>
                </ul>
                </ul>
               
            </div>
            
        </nav>   

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-8">
                        <h2>New user </h2>
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />  
                  @foreach ($errors->all() as $error)
                       <div class="alert alert-danger" role="alert">
                          <ul>  <li>{{ $error }}</li></ul>
                       </div>
                 @endforeach 
                 @if(session('success'))
                 
                        <script>window.alert('{{session('success')}}')  </script>
                 @endif
                   
                     <hr> 
                        <div class="col-md-8">
                            <form action="/newuser/id" method="post"style="padding-left:100px;">
                              {{ csrf_field() }}
                               <div class="form-group">
                                    <label for="">First name:</label>
                                    <input type="text"
                                    class="form-control" name="firstName" id="" aria-describedby="helpId" placeholder="Enter the first name here ">
                               </div>
                                    
                               <div class="form-group">
                                    <label for="">Last name</label>
                                    <input type="text"
                                    class="form-control" name="lastName" id="" aria-describedby="helpId" placeholder="Enter the last name">
                               </div>
                                
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text"
                                    class="form-control" name="userName" id="" aria-describedby="helpId" placeholder="" maxlength="5">
                                    <small id="helpId" class="form-text text-muted">shouldn't exceed 5 characters</small>
                               </div>

                              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                           </div>
                           
                          
                      </div>

                     

               </div>
               <!-- inner page --> 
 </div>
 @endsection