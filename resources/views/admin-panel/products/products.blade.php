@extends('layouts.dashboard')

@section('content-css')

@endsection

@section('content')
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-2"></div>
        </div>

        {{-- infobox --}}
        <div class="row">
            <x-admin.info-box-component
                infoText="Total Added"
                infoValue="200K"
                boxLogo="fas fa-tshirt"
            />

            <x-admin.info-box-component
                infoText="Inventory"
                infoValue="160K"
                boxLogo="fas fa-tshirt"
                alertType="Success"
            />

            <x-admin.info-box-component
                infoText="Out of stock"
                infoValue="20K"
                boxLogo="fas fa-tshirt"
                alertType="Warning"
            />
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <x-admin.tables.table-component />

                <x-admin.tables.data-table-1 />

                <x-admin.tables.data-table-2 />
            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    
@endsection