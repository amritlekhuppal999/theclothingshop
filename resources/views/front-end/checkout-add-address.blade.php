    
@extends('layouts.pages') 

@section('content-css')
        
@endsection



@section('content')

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            {{-- breadcrumb --}}
            <x-front.breadcrumb>
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </x-front.breadcrumb>
            
            {{-- {{ request()->path() }} --}}
            
            {{-- component present in profile directory --}}
            <x-front.profile.add-address />
            
        </div>
    </div>
@endsection




@push('scripts') 

    
@endpush

{{-- @once @endonce --}}