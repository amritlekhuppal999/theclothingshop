

    <div class="tab-pane {{ (request("page") == "update-email") ? "active" : "" }}" id="update_email">

        <div class="row">
            <div class="col-md-6 offset-md-3">

                <div class="card card-secondary">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div> -->
                    
                    
                    <div class="card-body">

                        <h5 class="card-text  mb-3"> Update Email </h5>

                        <form action="#" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                {{-- <input 
                                    type="email" 
                                    class="form-control" 
                                    id="old-email" name="oldEmail" 
                                    value="{{ $userData["email"] }}"  
                                    placeholder="Old Email"
                                /> --}}

                                <label class="form-control">
                                    {{ $userData["email"] }}
                                </label>
                            </div>

                            <div class="input-group mb-3">
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="new-email" name="newEmail" 
                                    placeholder="Enter New Email"
                                />

                                <input 
                                    type="hidden" 
                                    class="form-control" 
                                    id="code" name="code" 
                                    placeholder="Enter Verification Code"
                                />
                            </div>
    
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary btn-block" id="request-email-code">Request Code</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    
                    <!-- <div class="card-footer"></div> -->
                </div>
            </div>
        </div>
        
    </div>