

    <div class="tab-pane {{ (request("page") == "update-phone") ? "active" : "" }}" id="update_phone">

        <div class="row">
            <div class="col-md-6 offset-md-3">

                <div class="card card-secondary">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div> -->
                    
                    
                    <div class="card-body">

                        <h5 class="card-text  mb-3"> Update Phone No. </h5>

                        <form action="login.html" method="post">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="old-phone-no" name="oldPhoneNo" placeholder="Old Phone">
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new-phone-no" name="newPhoneNo" placeholder="New Phone">
                            </div>
    
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-secondary btn-block">Update Phone</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    
                    <!-- <div class="card-footer"></div> -->
                </div>
            </div>
        </div>
        
    </div>