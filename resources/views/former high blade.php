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
                          <?php
                          global $color;
                          global $data;
                          global $work;-
                          $connect = mysqli_connect('localhost','root','','utfes_database' );
                          $resultset =$connect->query("SELECT id, name FROM districts");

                          $color1="lightblue";
                          $color2="blue";
                          $color3=$color1;

                          ?>
                      
                           <button  id="test" type="submit" class="btn btn-default" onclick="hierachy" height="3px" width="5px"style="float:right">view</button> 
                         Select District to view <select name="district" id="id" style="float: right";">
                          <?php 
                          while ($rows = $resultset->fetch_assoc())
                          {
                            $color==$color1 ? $color=$color2:$color=$color1;
                            $name = $rows['name'];
                          echo"<option  value=".$rows['id']."  (HTML::link_to_route('districts',$name,array(&district_Id))) style='background:$color;'> $name </option>";
                          }
                          ?>                          
                         </select>
                        </div>
                        <div class="panel" style="height: 350px;width: 500px;">
                        
                          <ul>
                            
                            <li>{{$work}}</li>
                          </ul>                                              
                                                         
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

<img src="assets/img/hierachy.png" style="width:auto;height:420px;padding-left:15%;margin-top:0px;padding-top: 0 "> 
                           <ul>
                              <li>Administrator</li>
                              <ul>
                                <li>Agent Head</li>
                                <ul>
                                  <li>Agent stoni</li>
                                 
                                  <li>Agent levers</li>
                                  
                                  <li>Agent winschott</li>
                                  
                                  <li>Agent aple</li>
                                </ul>

                              </ul>

                            </ul>
                                                    
@endsection                         