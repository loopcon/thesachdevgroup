<div class="modal-header">
    <h5 class="modal-title">{{isset($record->id) && $record->id ? 'Award Edit' : 'Award Create'}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<form action="@if(isset($record->id)) {{ route('award-update', array('id' => encrypt($record->id))) }} @else{{ route('award-store') }} @endif" method="POST" class="award-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body m-3" id="form-detail">
        <div class="row">
            <div class="col-12">
                <label for="showroom_id" class="form-label">Showroom<span class="text-danger">*</span></label>
                <select class="form-control select2" name="showroom_id" id="showroom_id">
                    <option value="">-- Select Showroom --</option>
                    @foreach($showrooms as $value)
                        <option value="{{$value->id}}"@if(isset($record->showroom_id) && $record->showroom_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('showroom_id')) <div class="text-danger">{{ $errors->first('showroom_id') }}</div>@endif
                <div id="errordiv"></div>
            </div>
            <div class="col-12 mt-3">
                <label for="image" class="form-label">Image</label>&nbsp;<small>(Image Type : jpg,jpeg,png,webp)</small>
                @if(isset($record->image) && $record->image)
                    <img src="{{url('public/uploads/award/'.$record->image)}}" width="100" style="margin-bottom:10px; margin-left:5px;">
                @endif  
                <input type="file" id="image" class="form-control" name="image" value="">
                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary submit">Submit</button>
        <a href="{{ route('awards') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
