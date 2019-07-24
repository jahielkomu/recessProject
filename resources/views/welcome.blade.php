@extends('layouts.set')
        @section('required')
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
                    <i class="fa fa-envelope-o"></i>
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
                    <i class="fa fa-bars"></i>
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
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
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
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
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
                          
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
@endsection