@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <script type="text/javascript" src="jquery.min.js"></script> 

                    <script type="text/javascript"> 
                    function doSomething() { 
                        $.get("/home",'home'); 
                        return false; 
                    } 
                    </script>
                    
                    <a href="#" onclick="doSomething();">Click Me!</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
