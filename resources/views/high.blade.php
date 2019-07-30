@extends('layouts.set')
@section("required")

        <script>
        // displays the agent records in hierachy format
        $(document).ready(function(){
          $(document).on('change','.district_id',function()
          
          {
            console.log("its working");
            var ids=$(this).val();
            var div=$(this).parent();
            op="";
            console.log(ids);
            $.ajax({
              type:'get',
              url:'{!! URL::to('reco') !!}',
              data:{'id':ids},
              success:function(data) {


                 
                // console.log('success');
                // console.log(data);


                for(var i=0;i<data.length;i++){ 
                  if(data[i].role=='Agent head'){
                  op+='<label>Admininstrator</label><li>Aksam Lwanga </li> </label><label>Agent head </label><li value="">'+data[i].firstName+' '+data[i].LastName+'</li><label>Agents </label>'; 
                  }   
                  else{
                  op+='<ul><li value="">'+data[i].firstName+' '+data[i].LastName+'</li></ul>';
                  }
                }
            


                $('#agent_id').html(op);
                







              },


              error:function(){
                console.log(data);

              }


          });
        });
      });
        
     </script>

           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse" style="background-color: #999">
                <ul class="nav" id="main-menu" style="background: #3980b5">
        <li class="text-center" style="background: #3980b5">
                    <img src="assets/img/logo.png" class="user-image img-responsive"/>
          </li>
        
          
                    <li style="background-color: rgb(0, 85, 182)">
                        <a href="/" style="background: #3980b5;"><i class="glyphicon glyphicon-home fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a   href="/high" style="background: #104075;"><i class="fa fa-desktop fa-3x"></i> Hierarchy</a>
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
                    <li >
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
                     <h2>Hierarchy</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                    
                      <div class="col-md-7" style="width: 900px">
                    <div class="panel panel-default" style="width: 900px">
                        <div class="panel-heading" style="width: 900px">

                                           
                                <label for="agent_id">Hierachy display of agents to particular district</label>

                         <select id="district_id" class="district_id" style="float: right";">
                             <label for="agent_id">agent</label>
                             <option value="">Select district</option>
                             @foreach($district_list as $country)
                             <option value="{{ $country->id}}"  onchange="function(data)">{{ $country->name }}</option>
                             @endforeach                 
                         </select>
                          

                          </div>
                       

                            <div class="panel" style="height: 350px;width: 500px;">
                                   <div class="list-group">
  
                                    
                                    <ul name="agent_id" id="agent_id" class="agent_id">
                                     <li value="">shows me hierarchy by selecting a particular district</li>

                                    </ul>
                                   
                                                                      

                                    </div>
                            
                             
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

   @endsection