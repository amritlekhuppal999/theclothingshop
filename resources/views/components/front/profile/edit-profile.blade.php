
@php
    $active = "";
    if(!request()->has("page")){
        $active = "active";
    }
    else if(request("page") == "edit-profile"){
        $active = "active";
    }
@endphp


    <div class="tab-pane {{ $active }}" id="edit-profile">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card card-secondary">
                    
                    <form action="{{ safe_route("edit-profile") }}" method="POST" role="form">
                        
                        @csrf

                        <div class="card-body">
                            
                            <h4 class="card-text  mb-3"> Edit Profile </h4>
                            <!-- <hr> -->
                            
                            <!-- full name -->
                            <div class="form-group">
                                <label class="text-muted">Full Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="fullName" 
                                    name="fullName" 
                                    placeholder="First name"
                                    value="{{ $userData["name"] }}"
                                />
                            </div>
                            
                            <!-- last name -->
                            {{-- <div class="form-group">
                                <label class="text-muted">Last Name</label>
                                <input type="text" class="form-control" id="last-name" placeholder="last name">
                            </div> --}}

                            

                            <!-- Gender -->
                            {{-- <div class="form-group">
                                <label class="text-muted">Gender</label>
                                <div class="d-flex ">
                                    <label class="mr-2 cursor-pointer">
                                        <input class="cursor-pointer" type="radio" name="gender" value="1" checked required>    
                                        Male
                                    </label>


                                    <label class=" mr-2 cursor-pointer">
                                        <input class="cursor-pointer" type="radio" name="gender" value="2" required>    
                                        Female
                                    </label>
                                    

                                    <label class="cursor-pointer">
                                        <input class="cursor-pointer" type="radio" name="gender" value="3" required>
                                        Other
                                    </label>
                                </div>
                            </div> --}}

                            <!-- DOB -->
                            {{-- <div class="form-group">
                                <label class="text-muted">Date Of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="">
                            </div> --}}

                            <!-- Email -->
                            <div class="form-group">
                                <label class="text-muted">Email: </label> 
                                <span id="emailId-span" class="cursor-pointer text-muted">{{ $userData["email"] }}</span>
                                {{-- <input type="email" class="form-control" id="email" placeholder="Enter email"> --}}
                            </div>

                            <!-- Phone No -->
                            <div class="form-group">
                                <label class="text-muted">Phone No: </label>
                                <span id="phoneNo-span" class="cursor-pointer text-muted">{{ $userData["phone_no"] }}</span>
                                {{-- <input type="mobile" class="form-control" id="phone-no" placeholder="Enter mobile no."> --}}
                            </div>

                            @if(session('error'))
                                <h4 class="text-danger"> {{ session('error') }} </h4>
                            @elseif(session('success'))
                                <h4 class="text-success"> {{ session('success') }} </h4>
                            @endif
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        
    </div>


    {{-- @once
        <script>
            
        </script>
    @endonce --}}