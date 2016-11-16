<button @if($btn_type == 'normal')id="{{$btn_id}}" @endif
        class="feedback-button-blade btn @if(isset($btn_class))btn-{{$btn_class}}@else btn-default @endif"
        @if($btn_type == 'form')
        type="submit"
        @endif
        data-button-type="{{$btn_type}}"
        data-button-id="{{$btn_id}}"
        @if(isset($process))
            data-process-form="{{$process}}"
        @else
            data-process-form="no"
        @endif
>
    <div class="btn-content" @if(isset($wait_text)) data-wait="{{$wait_text}}" @endif>
        @if(isset($btn_icon))
            <i class="fa fa-{{$btn_icon}}"></i>&nbsp;
        @endif
        {{$btn_text}}
    </div>
    <div class="wait-content">
        <span class="wait-icon glyphicon glyphicon-hourglass animated rotateIn infinite"></span> &nbsp;
        <span class="wait-text animated flash infinite"></span>
    </div>
</button>

<!-- Include in Blade template as follows to display a Feedback button outside of Vue.js: -->
{{--@include(--}}
{{--'global.partials.buttons._feedback-button',--}}
{{--['btn_id' => 'my-id',-- // A unique button ID, or the ID of the form if this is a submit button }}
{{--'btn_type' => 'normal', // one of 'normal' or 'form' depending on the button type --}}
{{--'btn_text' => 'My Text',--}}
{{--'btn_class' => 'primary' // Optional ,--}}
{{--'btn_icon' => 'user', // Optional --}}
{{--'wait_text' => 'My Wait Text' // Optional --}}
{{--])--}}