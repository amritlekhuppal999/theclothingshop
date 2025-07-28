
{{-- @extends('layouts.mail.email-verification-layout') --}}
@extends('layouts.mail.mail')

@section('content-css')
    <style>
        /* Reset styles for email clients */
        body, table, td {
            margin: 0;
            padding: 0;
            border: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
        }
        
        /* Main container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        /* Header */
        .header {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: normal;
        }
        
        /* Content area */
        .content {
            padding: 40px 30px;
        }
        
        .content h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            margin-top: 0;
        }
        
        .content p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        /* Verification code styling */
        .verification-code {
            background-color: #f8f9fa;
            border: 2px dashed #3498db;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
            font-size: 32px;
            font-family: 'Courier New', monospace;
            letter-spacing: 3px;
            color: #2c3e50;
        }
        
        /* Button */
        .button {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }
        
        .button:hover {
            background-color: #229954;
        }
        
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        
        /* Footer */
        .footer {
            background-color: #ecf0f1;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #bdc3c7;
        }
        
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
        }
        
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 0 !important;
                border-radius: 0 !important;
            }
            
            .content {
                padding: 20px !important;
            }
            
            .header {
                padding: 20px !important;
            }
            
            .header h1 {
                font-size: 24px !important;
            }
        }
    </style>
@endsection


@section('content')

    <!-- Header -->
    <div class="header">
        <h1>Email Verification</h1>
    </div>
    
    <!-- Content -->
    <div class="content">
        <h2>Verify Your Email Address</h2>
        
        <p>Hello {{ $name }},</p>
        
        <p>Please verify your email address by entering the verification code from below:</p>
        
        <div class="verification-code">
            <strong>{{ $verificationCode }}</strong>
        </div>
        
        <p>This verification code will expire in <strong>10 minutes</strong>. If you didn't request this verification, please ignore this email.</p>
        
        <div class="button-container">
            <a href="#" class="button">Verify Email</a>
        </div>
        
        <p>If you're having trouble with the button above, you can also verify your email by visiting our website and entering the code manually.</p>
        
        <p>Thanks for joining us!<br>
        The Security Team</p>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p>© 2025 {{ env('APP_NAME') }}. All rights reserved.</p>
        <p>
            <a href="#">Unsubscribe</a> | 
            <a href="#">Privacy Policy</a> | 
            <a href="#">Contact Us</a>
        </p>
        <p>123 Main Street, Patna, Bihar 800001</p>
    </div>

@endsection