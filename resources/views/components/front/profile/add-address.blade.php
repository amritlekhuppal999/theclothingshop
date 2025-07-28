
    <style>
        /*
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        */

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            /*max-width: 600px;*/
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-title {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            position: relative;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        input[type="text"]:hover,
        input[type="number"]:hover,
        select:hover {
            border-color: #b8c5f2;
        }

        select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            appearance: none;
            padding-right: 40px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .form-container {
                padding: 25px;
                margin: 10px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-title {
                font-size: 24px;
            }
        }

        /* Animation for form appearance */
        .form-container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    <div class="d-flex justify-content-center mb-3" id="add_new_address">
        
        {{-- Go back --}}
        <a href="{{ safe_route("profile", ["page" => "manage-address"]) }}">Back</a>

        <div class="col-md-10 ">
        
            <div class="form-container">
                <h1 class="form-title">Address Information</h1>
                
                @if(session('error'))
                    <h4 class="text-danger"> {{ session('error') }} </h4>
                @elseif(session('success'))
                    <h4 class="text-success"> {{ session('success') }} </h4>
                @endif


                <form id="addressForm" action="{{ safe_route('add-address') }}" method="POST">
                    
                    @csrf

                    {{-- Name --}}
                    <div class="form-group">
                        <label for="userName" class="required">Name</label>
                        <input type="text" id="userName" name="userName" value="{{ old("userName") }}" required>
                    </div>
                    @error('userName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Apartment No Building No --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="apartmentNo">Apartment No</label>
                            <input type="text" id="apartmentNo" name="apartmentNo" value="{{ old("apartmentNo") }}">
                        </div>
                        <div class="form-group">
                            <label for="buildingNo">Building No</label>
                            <input type="text" id="buildingNo" name="buildingNo" value="{{ old("buildingNo") }}">
                        </div>
                    </div>
                    @error('apartmentNo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('buildingNo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Building Name --}}
                    <div class="form-group">
                        <label for="buildingName">Building Name</label>
                        <input type="text" id="buildingName" name="buildingName" value="{{ old("buildingName") }}">
                    </div>
                    @error('buildingName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Street Name --}}
                    <div class="form-group">
                        <label for="streetName">Street Name</label>
                        <input type="text" id="streetName" name="streetName" value="{{ old("streetName") }}">
                    </div>
                    @error('streetName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- City State --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="required">City</label>
                            <input type="text" id="city" name="city"  value="{{ old("city") }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state" class="required">State</label>
                            <input type="text" id="state" name="state" value="{{ old("state") }}" required>
                        </div>
                    </div>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('state')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Pincode Phone No --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pincode" class="required">Pincode</label>
                            <input 
                                type="number" 
                                id="pincode" name="pincode" 
                                min="110001" max="999999" 
                                value="{{ old("pincode") }}" 
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">Phone No</label>
                            <input 
                                type="number" 
                                id="phone" name="phone" 
                                min="1000000000" max="9999999999" 
                                value="{{ old("phone") }}" 
                                required
                            />
                        </div>
                    </div>
                    @error('pincode')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- Full Address --}}
                    <div class="form-group">
                        <label for="fullAddress" class="required">Full Address</label>
                        <input type="text" id="fullAddress" name="fullAddress" value="{{ old("fullAddress") }}" required>
                    </div>
                    @error('fullAddress')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-row">

                        {{-- Address Category --}}
                        <div class="form-group">
                            <label for="addressCategory">Address Category</label>
                            <select id="addressCategory" name="addressCategory">
                                <option value="">Select Category</option>
                                <option value="1">Shipping Address</option>
                                <option value="2">Billing Address</option>
                            </select>
                        </div>

                        {{-- Address Type --}}
                        <div class="form-group">
                            <label for="addressType">Address Type</label>
                            <select id="addressType" name="addressType">
                                <option value="">Select Type</option>
                                <option value="1">Home</option>
                                <option value="2">Office</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    @error('addressCategory')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('addressType')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    

                    <button type="submit" class="submit-btn">Submit Address</button>
                </form>
            </div>
        </div>
    
    </div>