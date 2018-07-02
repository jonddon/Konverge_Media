@extends('layouts.base')
@section('content')
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
                                <h4 class="title">Bounce List</h4>
                                <p class="category">List of Failed Emails</p>
                                <a href=" {{ url('downloadtext') }}"><button class="button pull-right">Download Faileds list </button> </a> &nbsp; &nbsp;
                                <input type="search" class="light-table-filter pull-right" data-table="order-table" placeholder="Filter">
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped order-table">
                                    <thead>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th>Email Forwarder</th>
                                    </thead>
                                    
                                    <tbody>
                                        @forelse($all as  $index => $trainee)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$trainee->event}}</td>
                                            <td>{{$trainee->recipient}}</td>                                                
                                            <td>{{$trainee->domain}}</td>                                                
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