@extends('layout.app')

@section('content')
 <div class="jumbotron">
   <div class="container">
     <div style="text-align: center">
       <h1 class="display-3">{{$title}}</h1>
       <p>One Stop Shop for All Your Livestock Management Needs!</p>
      </div>
     @if (Auth::guest())
       <div style="text-align: center">
         <p><a class="btn btn-primary btn-lg" href="/login" role="login">Login &raquo;</a>  <a class="btn btn-secondary btn-lg" href="/register" role="register">Register &raquo;</a></p>
       </div>
     @endif
   </div>
 </div>

  <div class="row">
      <div class="col-lg-4">
        <div style="text-align: center">
          <a href="/inventory"><img src={{asset('/images/inv1.png')}} alt="Inventory" width="50%" margin="auto"></a>
        </div>
        <h2>Inventory</h2>
        <p>An inventory management system is the combination of technology and processes and procedures that oversee the monitoring and maintenance of products.</p>
        <p><a class="btn btn-primary" href="/inventory" role="button">View Inventory &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div style="text-align: center">
          <a href="/finance"><img src={{asset('/images/finance.png')}} alt="Finance" width="50%" margin="auto"></a>
        </div>
        <h2>Finance</h2>
        <p>A financial system allows a company to maintain accountability for expenditures and revenues, and to control their finances to minimize waste and loss.</p>
        <p><a class="btn btn-primary" href="/finance" role="button">View Finance &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div style="text-align: center">
          <a href="/mobs"><img src={{asset('/images/scheduler.png')}} alt="Scheduler" width="50%" margin="auto"></a>
        </div>
        <h2>Scheduler</h2>
        <p>Scheduling is the process of arranging, controlling and optimizing work and workloads in a production process or manufacturing process.</p>
        <p><a class="btn btn-primary" href="/mobs" role="button">View Scheduler &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


@endsection
