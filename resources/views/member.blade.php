@extends('layouts.set')
        @section('required')
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
           
                <div class="col-md-6">
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
                                            @foreach($districttable as $row)
                                              <option value="{{$row->id}}">{{ $row->name}}</option>
                                            @endforeach    
                                              </select>
                                              <button  id="test" type="submit" class="btn btn-default">search</button>
                                 </form>
                                   

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Recomended</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    @foreach($membertable as $row)
                                       <tr>     
                                          <td>{{$row->districtNO}}</td>
                                          <td>{{$row->fname}}</td>
                                          <td>{{ $row->gender}}</td>
                                          <td>{{ $row->recommender}}</td>
                                          <td>{{ $row->created_at}}</td>
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
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    @endsection