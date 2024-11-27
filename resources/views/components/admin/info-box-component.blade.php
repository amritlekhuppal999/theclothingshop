


<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-{{ isset($alertType) ? strtolower($alertType) : "info" }} elevation-1">
            <i class="{{ $boxLogo }}"></i>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">{{ $infoText }}</span>
            <span class="info-box-number">
                {{ $infoValue }}
                {{-- <small>%</small> --}}
            </span>
        </div>
    </div>
</div>