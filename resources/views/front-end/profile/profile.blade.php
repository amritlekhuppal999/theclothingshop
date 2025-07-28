    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/profile.css') }}">
@endsection

@php
    //var_dump($UserData);
@endphp

@section('content')
    
    <div class="content"> 
        <div class="container-fluid">
            <!-- <p>Page Content..</p> -->

            
            <div class="row ">

                <!-- margin div -->
                <div class="col-md-12 mt-4"></div>

                @if(request("page") == "add-address")
                    
                    {{-- add address --}}
                    <x-front.profile.add-address />
                
                @else
                    
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
                                        <a href="#profile" data-toggle="tab" class="text-decoration-none">
                                            <b>Edit Profile</b>
                                        </a>
                                        <!-- <a class="float-right">1,322</a> -->
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#change_password" data-toggle="tab" class="text-decoration-none">
                                            <b>Change Password</b>
                                        </a>
                                        <!-- <a class="float-right">543</a> -->
                                    </li>

                                    {{-- Update Email --}}
                                    <li class="list-group-item">
                                        <a href="#update_email" data-toggle="tab" class="text-decoration-none">
                                            <b>Update Account Email</b>
                                        </a>
                                    </li>

                                    {{-- Update Phone --}}
                                    <li class="list-group-item">
                                        <a href="#update_phone" data-toggle="tab" class="text-decoration-none">
                                            <b>Update Account Phone</b>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="#manage_address" data-toggle="tab" class="text-decoration-none">
                                            <b>Manage Address</b>
                                        </a>
                                        <a class="float-right">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        </a>
                                    </li>

                                </ul>

                                <a href="#" class="btn btn-danger btn-block"><b>Delete Account</b></a>
                            </div>
                            
                        </div>

                    </div>
                    
                    <!-- Right section -->
                    <div class="col-md-9 ">

                        <div class="tab-content">
                            <!-- Edit Profile -->
                            <x-front.profile.edit-profile :userData="$UserData" />
        
                            <!-- Change Password -->
                            <x-front.profile.change-password />

                            {{-- Update Email --}}
                            <x-front.profile.update-email :userData="$UserData"/>
                            
                            {{-- Update Phone --}}
                            <x-front.profile.update-phone :userData="$UserData"/>
                            
                            <!-- Manage Address -->
                            <x-front.profile.manage-address />
                        </div>
                    </div>
                @endif


            </div>

        </div>
    </div>
@endsection




@section('content-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', e=>{
            
            let EDIT_PROFILE_TAB = document.getElementById('edit-profile');
            let MANAGE_ADDRESS_TAB = document.getElementById('manage_address');

            let REQUEST_EMAIL_CODE = document.getElementById('request-email-code');

            EDIT_PROFILE_TAB.addEventListener('click', event=>{
                let element = event.target;

                if(element.id == "emailId-span"){

                    console.log(element.innerText);
                    MyApp.copyTextToClipboard(element.innerText);
                }

                if(element.id == "phoneNo-span"){

                    console.log(element.innerText);
                    MyApp.copyTextToClipboard(element.innerText);
                }
            });

            
            
            MANAGE_ADDRESS_TAB.addEventListener('click', async event=>{
                let element = event.target;

                //Toggle Default
                if(element.className.includes("set-default-adderss")){

                    let setDefaultBtn = element;
                    setDefaultBtn.disabled = true;

                    if(!confirm("Set as default address?")){
                        return false;
                    }

                    let eleArr = Array.from(document.getElementsByClassName('set-default-adderss'));
                    eleArr.forEach(element=> element.checked = false);

                    let dataObj = {
                        addressId: setDefaultBtn.dataset.address_id
                    };

                    try{
                        
                        const request_options = {
                            method: 'GET',
                            // headers: {},
                            // body: JSON.stringify(request_data)
                        };
                        const params = new URLSearchParams(dataObj);

                        let url = '/toggle-default-address?'+params;
                        //let url = route+params;
                        let response = await fetch(url, request_options);

                        if(response.ok){

                            let response_data = await response.json();
                            //console.log(response_data);

                            if(response_data.code === 200){
                                toastr.success(response_data.message);

                                //document.getElementById(removeItemBtn.dataset.item_id).remove();
                                setDefaultBtn.checked = true;
                            }

                            else {
                                toastr.error(response_data.message);
                                setDefaultBtn.checked = false;
                            }

                            /*setTimeout(()=>{
                                if(response_data.reload) location.reload();
                            }, 800);*/

                        }

                        setDefaultBtn.disabled = false;

                    }
                    catch(error){
                        console.error('Error:', error);
                        setDefaultBtn.disabled = false;
                        setDefaultBtn.checked = false;
                    }
                    
                }

                // REMOVE ADDRESS
                if(element.className.includes("remove-address")){

                    let removeBtn = element;
                    removeBtn.disabled = true;
                        
                    if(!confirm("Delete saved address?")){
                        return false;
                    }

                    let dataObj = {
                        addressId: removeBtn.dataset.address_id
                    };

                    try{
                        
                        const request_options = {
                            method: 'GET',
                            // headers: {},
                            // body: JSON.stringify(request_data)
                        };
                        const params = new URLSearchParams(dataObj);

                        let url = '/remove-saved-address?'+params;
                        //let url = route+params;
                        let response = await fetch(url, request_options);
                            console.log(response);

                        if(response.ok){

                            let response_data = await response.json();
                            console.log(response_data);

                            if(response_data.code === 200){
                                toastr.success(response_data.message);

                                document.getElementById(removeBtn.dataset.address_id).remove();
                                removeBtn.checked = true;
                            }

                            else {
                                toastr.error(response_data.message);
                                removeBtn.checked = false;
                            }

                            /*setTimeout(()=>{
                                if(response_data.reload) location.reload();
                            }, 800);*/

                        }

                        removeBtn.disabled = false;

                    }
                    catch(error){
                        console.error('Error:', error);
                        removeBtn.disabled = false;
                    }
                    
                }
            });


            REQUEST_EMAIL_CODE.addEventListener('click', async event=>{
                
                /*
                if(!confirm("Confirm request?")){
                    return false;
                }
                */

                //let element = ev

                let requestBTN = event.target;
                requestBTN.disabled = true;

                let dataObj = {
                    newEmailId: document.getElementById('new-email').value
                };
                console.log(dataObj.newEmailId);

                //console.log(document.querySelector('input[name="_token"]').getAttribute('value'));
                //return false;

                try{
                        
                    const request_options = {
                        method: 'POST',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').getAttribute('value')
                        },
                        body: JSON.stringify(dataObj)
                    };
                    //const params = new URLSearchParams(dataObj);

                    let url = '/generate-email-verification-code';
                    let response = await fetch(url, request_options);
                    console.log(response);

                    if(response.ok){

                        let response_data = await response.json();
                        console.log(response_data);

                        if(response_data.code === 200){
                            toastr.success(response_data.message);

                            requestBTN.remove();
                        }

                        else {
                            toastr.error(response_data.message);
                            requestBTN.disabled = false;
                        }

                        /*setTimeout(()=>{
                            if(response_data.reload) location.reload();
                        }, 800);*/
                    }

                    else requestBTN.disabled = false;

                }
                catch(error){
                    console.error('Error:', error);
                    requestBTN.disabled = false;
                }
            });

        });
    </script>
@endsection