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
                        <a  href="/member" style="background: #104075"><i class="fa fa-table fa-3x"></i> Members</a>
                        
                    </li>
                     <li  >
                        <a  href="/record" style="background: #3980b5;"><i class="fa fa-table fa-3x"></i> Records</a>
                    </li>
                    <li  >
                        <a  href="/upgrade" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> Upgrade</a>
                    </li>               
                    <li  >
                        <a  href="/newuser" style="background: #3980b5"><i class="fa fa-edit fa-3x"></i> New record</a>
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
                     <h2>Members</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                        
                                              
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

                 <option>Select a particular district to see its members</option>
                       
               
            <div class="row">
                <div class="col-md-8">
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
           
                <div class="col-md-14" style="padding-left:90px;padding-right:100px">
                     <!--   Basic Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Members
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="/member" method="POST">
                                    {{ csrf_field() }}
                                    <select name="district" id="">
                                        <option>select district</option>
                                            @foreach($districttable as $row)
                                              <option value="{{$row->id}}">{{ $row->name}}</option>
                                            @endforeach    
                                              </select>
                                              <button  id="test" type="submit" class="btn btn-default">search</button>
                                 </form>
                                   

                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Recomended</th>
                                            <th>Date of enrollment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    @foreach($membertable as $row)
                                       <tr>     
                                          <td>{{$row->districtNO}}</td>
                                          <td>{{$row->fname}}</td>
                                          <td>{{ $row->gender}}</td>
                                          <td>{{ $row->recommender}}</td>
                                          <td>{{  date('j F  Y', strtotime($row->created_at))}}</td>
                                       </tr>
                                       @endforeach
                                            
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                      <!-- End  Basic Table  -->
                </div>
            </div>
                <!-- /. ROW  -->
           
                     <!--  End  Bordered Table  -->
                    
             
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
             </div>
      @endsection