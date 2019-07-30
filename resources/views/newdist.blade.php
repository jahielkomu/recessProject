@extends('layouts.set')
@section("required")

  
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
                        <a  href="/newuser" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New record</a>
                    </li>	
                    <li  >
                            <a  href="/newdist" style="background: #104075"><i class="fa fa-edit fa-3x"></i> New District</a>
                        </li>
                </ul>
                </ul>
               
            </div> </nav>   
            <!-- /. NAV SIDE  -->
           <div id="page-wrapper" >
               <div id="page-inner">
                   <div class="row">
                       <div class="col-md-8">
                        <h2 style="padding-left:100px">New District </h2> 
                           <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                          
                       </div>
                   </div>
                    <!-- /. ROW  -->
                    <hr />  
                     
                    @if(session('success'))
                    
                           <script>window.alert('{{session('success')}}')  </script>
                    @endif
                       
                    <div class="col-md-8">
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                               <ul>  <li>{{ $error }}</li></ul>
                            </div>
                      @endforeach 
                            
                       <form action="/newuser/dis" method="post"style="padding-left:100px;">
                        {{ csrf_field() }}
                          
                         <div class="form-group">
                               <hr>
                         <strong id="helpId" class="form-text text-muted">This section is required only when adding a new district</strong><hr>
                            <label for="">District</label>
                            <input type="text"
                            class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Home district">
                        </div>
                        <button type="submit" class="btn btn-primary" name='submit'>add </button>
                       </form>
                       </div>
                        
                </div>
                              
                             
            </div>
   
                  <!-- inner page --> 
        </div>
    @endsection