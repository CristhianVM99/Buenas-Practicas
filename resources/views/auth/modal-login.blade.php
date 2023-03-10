<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog bg-slate-50 panel">
        <ul class="nav nav-tabs color2" role="tablist">
            <li class="active">
                <a href="#tab-login" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="fa fa-user"></i>
                    {{ __('Log in')}}
                </a>
            </li>
            <li>
                <a href="#tab-register" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="fa fa-user-plus"></i>
                    {{ __('Register')}}
                </a>
            </li>
            <li>
                <a href="" data-dismiss="modal" title="{{ __("Close")}}">
                    <i class="rt-icon2-close"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content top-color-border color2 bg-white">
            <div class="tab-pane fade in active" id="tab-login">
                @include('auth.form-login')
            </div>
            <div class="tab-pane fade" id="tab-register">
                @include('auth.form-register')
            </div>
        </div>
    </div>
</div>