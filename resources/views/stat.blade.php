@extends('layouts.set')
        @section('required')
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
    
     {!! Charts::scripts() !!}

     {!! $chart->script() !!}
     {!! $chart2->script() !!}
    
 @endsection
