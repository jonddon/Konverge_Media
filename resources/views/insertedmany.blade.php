@extends('layouts.base')
@section('content')
<style type="text/css">
    .margin{
        margin-top: 10px;
    }
</style>
    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Table List</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">0</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Certificate List</h4>
                                <p class="category">List of all successfully uploaded emails</p>
                                <a href="{{url('/sendmanyemails/'. $batch_id.'/'. $email)}}"><button class="button pull-right">Send all to {{$email}}</button></a><br>
                                <input type="text" class="form-control pull-right margin" value="{{$email}}" disabled>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                    	<th>Email/SMS</th>
                                    	<!-- <th>Action</th> -->
                                    </thead>
                                    
                                    <tbody>
                                        @forelse($batch as  $index => $trainee)
                                        <tr>
                                        	<td>{{$index +1}}</td>
                                            <td>{{$trainee->name}}</td>

                                            @if($trainee->email)
                                        	   <td>{{$trainee->email}}</td>
                                            @else
                                                <td>{{$trainee->phone}}</td>
                                            @endif

                                        	<!-- <td><button class="button">Resend</button></td> -->
                                        </tr>
                                        @empty

                                        @endforelse
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop