@extends('layouts.set')
        @section('required')
         <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-8">
                        <h2>New user </h2>
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
                 @if(session('success'))
                 
                        <script>window.alert('{{session('success')}}')  </script>
                 @endif
                   
                     <hr> 
                        <div class="col-md-8">
                            <form action="/newuser/id" method="post"style="padding-left:100px;">
                              {{ csrf_field() }}
                               <div class="form-group">
                                    <label for="">First name:</label>
                                    <input type="text"
                                    class="form-control" name="firstName" id="" aria-describedby="helpId" placeholder="Enter the first name here ">
                               </div>
                                    
                               <div class="form-group">
                                    <label for="">Last name</label>
                                    <input type="text"
                                    class="form-control" name="lastName" id="" aria-describedby="helpId" placeholder="Enter the last name">
                               </div>
                                
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text"
                                    class="form-control" name="userName" id="" aria-describedby="helpId" placeholder="" maxlength="5">
                                    <small id="helpId" class="form-text text-muted">shouldn't exceed 5 characters</small>
                               </div>

                              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                           </div>
                           
                          
                      </div>

                     

               </div>
               <!-- inner page --> 
 </div>
   @endsection