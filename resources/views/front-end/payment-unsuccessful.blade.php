@extends('layouts.pages') 

@section('content-css')
    <title>Thank You - Payment Unsuccessful | {{env('APP_NAME')}} </title>

    <style>
        body {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .thank-you-container {
            padding: 60px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: shakeAndSlide 1s ease-out;
            position: relative;
        }
        
        @keyframes shakeAndSlide {
            0% {
                opacity: 0;
                transform: translateY(50px) translateX(0);
            }
            60% {
                opacity: 1;
                transform: translateY(0) translateX(-10px);
            }
            70% {
                transform: translateY(0) translateX(10px);
            }
            80% {
                transform: translateY(0) translateX(-5px);
            }
            90% {
                transform: translateY(0) translateX(5px);
            }
            100% {
                opacity: 1;
                transform: translateY(0) translateX(0);
            }
        }
        
        .success-header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 40px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .success-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: float 20s linear infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px) translateX(0px); }
            100% { transform: translateY(-50px) translateX(-50px); }
        }
        
        .success-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out 3;
        }
        
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-10px);
            }
            75% {
                transform: translateX(10px);
            }
        }
        
        .order-details {
            padding: 40px;
        }
        
        .detail-item {
            background: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 0 10px 10px 0;
            transition: transform 0.3s ease;
        }
        
        .detail-item:hover {
            transform: translateX(5px);
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .detail-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 500;
        }
        
        .status-badge {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin: 10px 0;
            animation: errorPulse 2s infinite;
        }
        
        @keyframes errorPulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }
        
        .btn-custom {
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 10px;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .btn-outline-custom {
            border: 2px solid #dc3545;
            color: #dc3545;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 10px;
            background: transparent;
        }
        
        .btn-outline-custom:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }
        
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 50px;
            margin-bottom: 30px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: -30px;
            width: 2px;
            background: #e9ecef;
        }
        
        .timeline-item:last-child::before {
            display: none;
        }
        
        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 30px;
            height: 30px;
            background: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }
        
        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }
        
        .confetti-piece {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ff6b6b;
            animation: confetti-fall 3s linear infinite;
        }
        
        .confetti-piece:nth-child(odd) {
            background: #4ecdc4;
            animation-delay: 0.5s;
        }
        
        .confetti-piece:nth-child(3n) {
            background: #45b7d1;
            animation-delay: 1s;
        }
        
        .confetti-piece:nth-child(4n) {
            background: #f9ca24;
            animation-delay: 1.5s;
        }
        
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }
    </style>
@endsection



@section('content')

    <div class="content"> 
        <div class="container">
            

            {{-- breadcrumb --}}
            <x-front.breadcrumb>
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Order Placed</li>
            </x-front.breadcrumb>


            {{-- SORRY PAGE CONTENT --}}
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="success-card">
                        <div class="success-header">
                            <div class="success-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h1 class="mb-3">Payment Failed</h1>
                            <p class="lead mb-0">Unfortunately, we couldn't process your payment</p>
                            <div class="status-badge mt-3">
                                <i class="fas fa-times me-2"></i>Payment Declined
                            </div>
                        </div>
                        
                        <div class="order-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-exclamation-triangle me-2"></i>Transaction ID
                                        </div>
                                        <div class="detail-value">#TXN-FAILED-8874</div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-calendar me-2"></i>Attempt Date
                                        </div>
                                        <div class="detail-value">August 22, 2025</div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-credit-card me-2"></i>Payment Method
                                        </div>
                                        <div class="detail-value">Credit Card •••• 4242</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-ban me-2"></i>Error Reason
                                        </div>
                                        <div class="detail-value">Insufficient Funds</div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-clock me-2"></i>Response Time
                                        </div>
                                        <div class="detail-value">2.3 seconds</div>
                                    </div>
                                    
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-shopping-cart me-2"></i>Cart Status
                                        </div>
                                        <div class="detail-value">Items Reserved (30 min)</div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <h5 class="mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i>What Happened?
                            </h5>
                            
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-play"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Payment Initiated</h6>
                                        <small class="text-muted">Payment request was sent to your bank</small>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Payment Declined</h6>
                                        <small class="text-muted">Your bank declined the transaction due to insufficient funds</small>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-icon" style="background: #ffc107;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Cart Reserved</h6>
                                        <small class="text-muted">Your items are held for 30 minutes while you resolve payment</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-5">
                                <p class="text-muted mb-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    A confirmation email with order details has been sent to your registered email address.
                                </p>
                                
                                <div class="d-flex flex-wrap justify-content-center">
                                    <button class="btn btn-custom">
                                        <i class="fas fa-box me-2"></i>Track Your Order
                                    </button>
                                    <button class="btn btn-outline-custom">
                                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                                    </button>
                                    <button class="btn btn-outline-custom">
                                        <i class="fas fa-download me-2"></i>Download Invoice
                                    </button>
                                </div>
                                
                                <div class="mt-4">
                                    <p class="mb-2">
                                        <strong>Need Help?</strong>
                                    </p>
                                    <p class="text-muted">
                                        Contact our support team at 
                                        <a href="mailto:support@example.com" class="text-decoration-none">support@example.com</a>
                                        or call <a href="tel:+1234567890" class="text-decoration-none">+1 (234) 567-890</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
@endsection




@push('scripts') 
    <script>
        // Create confetti effect
        function createConfetti() {
            const confettiContainer = document.getElementById('confetti');
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#a8e6cf'];
            
            for (let i = 0; i < 50; i++) {
                const confettiPiece = document.createElement('div');
                confettiPiece.classList.add('confetti-piece');
                confettiPiece.style.left = Math.random() * 100 + '%';
                confettiPiece.style.background = colors[Math.floor(Math.random() * colors.length)];
                confettiPiece.style.animationDelay = Math.random() * 3 + 's';
                confettiPiece.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confettiContainer.appendChild(confettiPiece);
            }
            
            // Remove confetti after animation
            setTimeout(() => {
                confettiContainer.innerHTML = '';
            }, 6000);
        }

        // Trigger confetti on page load
        window.addEventListener('load', createConfetti);

        // Add click handlers for buttons (placeholder functionality)
        document.querySelectorAll('.btn-custom, .btn-outline-custom').forEach(btn => {
            btn.addEventListener('click', function() {
                const btnText = this.textContent.trim();
                alert(`${btnText} functionality would be implemented here!`);
            });
        });

        // Animate timeline items on scroll
        function animateTimeline() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }
                });
            });

            timelineItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                item.style.transition = 'all 0.6s ease';
                observer.observe(item);
            });
        }

        // Initialize timeline animation
        document.addEventListener('DOMContentLoaded', animateTimeline);
    </script>
@endpush

{{-- @once @endonce --}}