<button class="feedback-button-blade btn @if(isset($btn_class))btn-{{$btn_class}}@else btn-primary @endif @if(isset($ajax_class)){{$ajax_class}}@else ajax-validate-blade @endif"
        type="submit"
        data-prefix="{{$field_prefix}}"
        data-button-id="{{$form_id}}"
        data-button-type="form"
>
    <div class="btn-content" @if(isset($wait_text)) data-wait="{{$wait_text}}" @endif>
        @if(isset($btn_icon))
            <i class="fa fa-{{$btn_icon}}"></i> &nbsp;
        @endif
        @if(isset($btn_text))
            {{$btn_text}}
        @else
            Submit
        @endif
    </div>
    <div class="wait-content">
        <span class="wait-icon glyphicon glyphicon-hourglass animated rotateIn infinite"></span> &nbsp;
        <span class="wait-text animated flash infinite"></span>
    </div>
</button>