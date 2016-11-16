<button class="btn btn-danger sweet-delete-blade"
        data-delete-path="{{$delete_path}}"
        @if(isset($item_name))
            data-item-name="{{$item_name}}"
        @endif
        @if(isset($redirect_path))
            data-redirect-path="{{$redirect_path}}"
        @endif
>
    <i class="fa fa-times-circle"></i>&nbsp;
    @if(isset($btn_txt))
        {{$btn_txt}}
    @else
        Delete
    @endif
</button>