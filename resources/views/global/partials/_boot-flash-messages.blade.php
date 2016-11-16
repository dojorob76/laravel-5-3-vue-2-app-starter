<!-- Bootstrap Alert Flash Messages -->
@if(session()->has('boot_flash'))
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-{{session('boot_flash.level')}}" role="alert">
            <p class="text-center">
                <strong>
                    @if(session('boot_flash.level') == 'success')
                        <i class="fa fa-check-circle text-success"></i>
                    @elseif(session('boot_flash.level') == 'info')
                        <i class="fa fa-info-circle text-info"></i>
                    @elseif(session('boot_flash.level') == 'warning')
                        <i class="fa fa-warning text-warning"></i>
                    @elseif(session('boot_flash.level') == 'danger')
                        <i class="fa fa-times-circle text-danger"></i>
                    @endif
                    {{session('boot_flash.title')}}
                </strong>
                {{session('boot_flash.message')}}
            </p>
        </div>
    </div>
@endif

@if(session()->has('boot_dismiss'))
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-{{session('boot_dismiss.level')}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-times text-muted" aria-hidden="true"></i>
            </button>
            <p class="text-center">
                <strong>
                    @if(session('boot_dismiss.level') == 'success')
                        <i class="fa fa-check-circle text-success"></i>&nbsp;
                    @elseif(session('boot_dismiss.level') == 'info')
                        <i class="fa fa-info-circle text-info"></i>&nbsp;
                    @elseif(session('boot_dismiss.level') == 'warning')
                        <i class="fa fa-warning text-warning"></i>&nbsp;
                    @elseif(session('boot_dismiss.level') == 'danger')
                        <i class="fa fa-times-circle text-danger"></i>&nbsp;
                    @endif
                    {{session('boot_dismiss.title')}}
                </strong>
                {{session('boot_dismiss.message')}}
            </p>
        </div>
    </div>
@endif