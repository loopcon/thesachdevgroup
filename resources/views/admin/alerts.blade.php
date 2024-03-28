@if ($message = Session::get('success'))
<div class="alert alert-dismissible alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="alert-message">
        {{ $message }}
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-dismissable alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="alert-message">
        {{ $message }}
    </div>
</div>
@endif