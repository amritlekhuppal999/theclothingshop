    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/profile.css') }}">
@endsection



@section('content')
    
    <div class="content"> 
        <div class="container-fluid">
            <!-- <p>Page Content..</p> -->

            
            <div class="row">

                <!-- margin div     -->
                <div class="col-md-12 mt-4"></div>

                <!-- Left Section -->
                <div class="col-md-3 ">

                    <!-- Profile Image -->
                    <div class="card">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- <img class="profile-user-img img-fluid img-circle"
                                    src="../../dist/img/user4-128x128.jpg"
                                    alt="User profile picture"> -->
                                <!-- <img class="profile-user-img img-fluid img-circle"
                                    src="https://i.pinimg.com/originals/3e/47/c0/3e47c0758697bb3be44d2fb927cb7605.jpg"
                                    alt="User profile picture"> -->
                            </div>

                            <h3 class="profile-username text-center">Drew Mcintire</h3>
                            <!-- <h3 class="profile-username text-center">Nina Mcintire</h3> -->

                            <p class="text-muted text-center">
                                <small>4.5</small>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half text-warning"></i>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a href="#profile" data-toggle="tab">
                                        <b>Edit Profile</b>
                                    </a>
                                    <!-- <a class="float-right">1,322</a> -->
                                </li>

                                <li class="list-group-item">
                                    <a href="#change_password" data-toggle="tab">
                                        <b>Change Password</b>
                                    </a>
                                    <!-- <a class="float-right">543</a> -->
                                </li>

                                <li class="list-group-item">
                                    <a href="#manage_address" data-toggle="tab">
                                        <b>Manage Address</b>
                                    </a>
                                    <!-- <a class="float-right">13,287</a> -->
                                </li>

                            </ul>

                            <a href="#" class="btn btn-secondary btn-block"><b>Delete Account</b></a>
                        </div>
                        
                    </div>

                </div>
                
                <!-- Right section -->
                <div class="col-md-9 ">

                    <div class="tab-content">
                        
                        <!-- Edit Profile -->
                        <div class="tab-pane active" id="profile">
    
                            <div class="card card-secondary">
                                <!-- <div class="card-header">
                                    <h3 class="card-title">Edit Profile</h3>
                                </div> -->
                                <!-- form start -->
                                
                                <form method="POST" role="form">
                                    <div class="card-body">
                                        
                                        <h4 class="card-text  mb-3"> Edit Profile </h4>
                                        <!-- <hr> -->
                                        
                                        <div class="row">

                                            <div class="col-md-6">
                                                
                                                <!-- full name -->
                                                <div class="form-group">
                                                    <label class="text-muted">Full Name</label>
                                                    <input type="text" class="form-control" id="full-name" placeholder="First name">
                                                </div>
                                                
                                                <!-- last name -->
                                                <div class="form-group">
                                                    <label class="text-muted">Last Name</label>
                                                    <input type="text" class="form-control" id="last-name" placeholder="last name">
                                                </div>
        
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label class="text-muted">Email</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                                                </div>
        
                                                <!-- Gender -->
                                                <div class="form-group">
                                                    <label class="text-muted">Gender</label>
                                                    <div class="d-flex ">
                                                        <label class="mr-2 cursor-pointer">
                                                            <input class="cursor-pointer" type="radio" name="gender" checked required>    
                                                            Male
                                                        </label>
            
            
                                                        <label class=" mr-2 cursor-pointer">
                                                            <input class="cursor-pointer" type="radio" name="gender"  required>    
                                                            Female
                                                        </label>
                                                        
            
                                                        <label class="cursor-pointer">
                                                            <input class="cursor-pointer" type="radio" name="gender" required>
                                                            Other
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="col-md-6">
        
                                                <!-- DOB -->
                                                <div class="form-group">
                                                    <label class="text-muted">Date Of Birth</label>
                                                    <input type="date" class="form-control" id="dob" placeholder="">
                                                </div>
        
                                                <!-- Phone No -->
                                                <div class="form-group">
                                                    <label class="text-muted">Phone No</label>
                                                    <input type="mobile" class="form-control" id="phone-no" placeholder="Enter mobile no.">
                                                </div>
                                                
                                                <!-- Address -->
                                                <div class="form-group">
                                                    <label class="text-muted">Address</label>
                                                    <textarea name="" class="form-control" id="address" rows="5" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
    
                        <!-- Change Password -->
                        <div class="tab-pane" id="change_password">

                            <div class="row">
                                <div class="col-md-6 offset-md-3">

                                    <div class="card card-secondary">
                                        <!-- <div class="card-header">
                                            <h3 class="card-title">Change Password</h3>
                                        </div> -->
                                        
                                        
                                        <div class="card-body">

                                            <h5 class="card-text  mb-3"> Change Password </h5>
        
                                            <form action="login.html" method="post">
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="old-password" placeholder="Old Password">
                                                    <!-- <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div> -->
                                                </div>
        
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="new-password" placeholder="New Password">
                                                    <!-- <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                        
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                                                    <!-- <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-secondary btn-block">Change password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        
                                        <!-- <div class="card-footer"></div> -->
                                    </div>
                                </div>
                            </div>
                            
                                                
                        </div>
                        
                        <!-- Manage Address -->
                        <div class="tab-pane " id="manage_address">
                            
                            <div class="card card-secondary">
                                <!-- <div class="card-header">
                                    <h3 class="card-title">Manage Address</h3>
                                </div> -->

                                <div class="card-body">
                                    <h4 class="card-text  mb-3"> Manage Address </h4>

                                    <div class="row">
                                        
                                        <!-- Address 1 -->
                                        <div class="col-md-4">
                                            <div class="card card-success card-outline">
                                                <!-- <div class="card-header">
                                                    <h3 class="card-title">Default Address</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div> -->
                                            
                                                <div class="card-body">
                                                    Default Address
                                                </div>

                                                <div class="mb-2 mr-2 text-right">
                                                    <button type="button" class="btn btn-sm btn-default edit-address-btn"> Edit </button>
                                                    <button type="button" class="btn btn-sm btn-default remove-address-btn"> Remove </button>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Address 2 -->
                                        <div class="col-md-4">
                                            <div class="card card-secondary card-outline">
                                                <!-- <div class="card-header">
                                                    <h3 class="card-title">Address 2</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div> -->
                                            
                                                <div class="card-body">
                                                    Address 2
                                                </div>

                                                <div class="mb-2 mr-2 text-right">
                                                    <button type="button" class="btn btn-sm btn-default edit-address-btn"> Edit </button>
                                                    <button type="button" class="btn btn-sm btn-default remove-address-btn"> Remove </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address 3 -->
                                        <div class="col-md-4">
                                            <div class="card card-secondary card-outline">
                                                <!-- <div class="card-header">
                                                    <h3 class="card-title">Address 3</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div> -->
                                            
                                                <div class="card-body">
                                                    Address 3
                                                </div>

                                                <div class="mb-2 mr-2 text-right">
                                                    <button type="button" class="btn btn-sm btn-default edit-address-btn"> Edit </button>
                                                    <button type="button" class="btn btn-sm btn-default remove-address-btn"> Remove </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-2 mr-2 text-right">
                                    <button type="button" class="btn btn-secondary" id="add-new-address-btn">
                                        <i class="fas fa-plus"></i>
                                        Add New
                                    </button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                

                


                {{-- <!-- Commented Section -->
                    
                    <!-- About ME  -->
                    <div class="col-md-3 ">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <!-- <img class="profile-user-img img-fluid img-circle"
                                        src="../../dist/img/user4-128x128.jpg"
                                        alt="User profile picture"> -->
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="https://i.pinimg.com/originals/3e/47/c0/3e47c0758697bb3be44d2fb927cb7605.jpg"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">Drew Mcintire</h3>
                                <!-- <h3 class="profile-username text-center">Nina Mcintire</h3> -->

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                            </div>
                            
                        </div>


                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            

                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                            </div>
                        </div>

                    </div>
                --}}

            </div>

        </div>
    </div>
@endsection




@section('content-scripts')

@endsection