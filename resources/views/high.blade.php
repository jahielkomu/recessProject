@extends('layouts.set')
        @section('required')
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

@endsection