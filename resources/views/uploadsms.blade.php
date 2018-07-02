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
                    <a class="navbar-brand" href="#">SMS Upload</a>
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
                <h4 class="title">Upload Excel File With Name and Phone number ONLY(.CSV)</h4>
                <p class="category">Click <a href="{{ url('/assets/SampleSmsFile.csv') }}" download>here</a> to see a sample CSV file to upload</p>
            </div>
            <div class="content">
                <form method="POST" action="{{url('/importsms')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <!-- COMPONENT START -->
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <label>Training Name:</label>
                             <input type="text" name="Training" class="form-control" placeholder="Training Identifier" required>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="input-group input-file">
                             <span class="input-group">
                             <input type="file" name="Excel_file" id="fileToUpload" accept=".csv">
                             </span>
                        </div>
                    </div>
                    <!-- COMPONENT END -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Upload</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
