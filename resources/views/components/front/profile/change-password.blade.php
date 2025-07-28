

    <div class="tab-pane {{ (request("page") == "change-password") ? "active" : "" }}" id="change_password">

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