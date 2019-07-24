@extends('layouts.set')
        @section('required')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Records</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>
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
                            Agents
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>District</th>
                                            <th>Role</th>
                                            <!-- <th>No. of enrolls</th> -->
                                            <th>Signature</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agentstable as $row)
                                       <tr>     
                                          
                                          <td>{{$row->firstName}}</td>
                                          <td>{{$row->lastName}}</td>
                                          <td>{{ $row->name}}</td>
                                          <td>{{ $row->role}}</td>
                                          <td>{{$row->signature}}</td>
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
         <!-- /. PAGE WRAPPER  -->
    @endsection