@extends('layouts.set')
        @section('required')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Upgrade page</h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>

                <!-- /.UPGRADE -->
                <!--added for document purpose-->
                <div id="upgrade panel panel-default">
                    <div class="qualify panel-body">
                        <h2 class="qualify">Qualify</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>gender</th>
                                </tr>
                                     @foreach($memberqualify as $row)
                                       <tr>     
                                          <td>{{$row->districtNO}}</td>
                                          <td>{{$row->fname}}</td>
                                          <td>{{ $row->gender}}</td>
                                       </tr>
                                       @endforeach
                            </table>
                        </div>
                        <script>
                                $(document).ready(function(){
                                    $("table").click(function(){
                                        $(this).hide();
                                    });
                                });
                                </script> 
                                <form>
                        <button><a href="/upgrade/do">Random distribute</a></button>
                        @if(session('success'))
                 
                         <h4 style="color:red">{{session('success')}}<h4>
                       @endif
                    </div>
                    <div class="qualify panel-body">
                        <h2>Districts available</h2>
                        <!-- <select name="" id="" style="display: inline"><option value="Number of agets">Agents &lt;:<input type="number" name="" id=""></option><option value="members">Members &lt;: <input type="number" name="" id=""></option></select>
                            -->
                        <div class="district table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>                                    
                                    <th>Distric number</th>
                                    <!-- <th>Initial</th> -->
                                    <th>Name</th>
                            
                                </tr>
                                @foreach($districtAvailable as $row)
                                       <tr>     
                                          <td>{{$row->id}}</td>
                                          <td>{{$row->name}}</td>
                                       </tr>
                                       @endforeach
                            </table>
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
