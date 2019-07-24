@extends('layouts.set')
        @section('required')  
         <!-- /. NAV SIDE  -->
         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>PAYMENTS </h2>   
                        <h5>Welcome Lwanga Aksam , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                      <ul>  <li>{{ $error }}</li></ul>
                    </div>
                @endforeach 
                    <!-- /. ROW  -->
                    <div class="row">
                      <div class="col-md-8">
                        <caption>FUNDS REGISTRATION</caption>
                         <form action="/newpayment" method="post"style="padding-left:100px;">
                              {{ csrf_field() }}
                               <div class="form-group">
                                 <label for="">Source of funds:</label>
                                 <input type="text"
                                 class="form-control" name="source" id="" aria-describedby="helpId" placeholder="Enter the name of the organisation/individual ">
                                </div>
                                 
                                <div class="form-group">
                                 <label for="">Amount :</label>
                                 <input type="number"
                                 class="form-control" name="amount" id="" aria-describedby="helpId" placeholder="Enter the amount recieved by the organisation">
                                </div>
                             
                                <div class="form-group">
                                  <label for="">date recieved:</label>
                                  <input type="date" 
                                  class="form-control" name="date" id="" aria-describedby="helpId" placeholder="Enter the month the amount is recieved" >

                                </div>
                                <div class="form-group">
                                 <label for="">District of the sponsor</label>
                                 <input type="text"
                                 class="form-control" name="district" id="" aria-describedby="helpId" placeholder="district of the sponsor">
                                 <small id="helpId" class="form-text text-muted">This field is optional</small>
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                          </form>
                          <br><br>
                       </div>
                    
                        <div class="col-md-7" style="width: 900px">
                          <div class="panel panel-default" style="width: 900px">
                            <h2 style="text-align: center">Payroll statement as {{date('d-m-y')}}</h2>
                            <div class="table-responsive">
                                    <table class="table" border="4">
                                        <tr style="background-color: #3980f8;color:#fff">
                                               
                                            <th>role </th>
                                            <th>Amount (UGX)</th>
                            
                                        </tr>
                                        <tr>
                                            <td>Administrator </td>
                                            <td>{{number_format($amountagent/2,0)}}</td>
                                        </tr>
                                        <tr>
                                        <td>{{$remaininghead}} Agent heads each recieving</td>
                                                <td>{{number_format($amountagent*(7/4),0)}}</td>
                                        
                                        </tr>
                                        <tr>
                                                <td>{{$remainingagent}}  Agents each recieving  </td>
                                                <td>{{number_format($amountagent,0)}}</td>
                                                
                                        </tr>
                                        <tr>
                                        <td>{{$noagentsinhigh}}  Agents with highest enrollment each recieving</td>
                                                <td>{{number_format(2*$amountagent,0)}}</td>
                                                
                                        </tr>
                                        <tr>      
                                                <td>Agent head with highest enrollment</td>
                                                <td>{{number_format((7/2)*$amountagent,0)}}</td>
                                                
                                        </tr>
                                    </table>
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