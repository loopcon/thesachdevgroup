<div class="modal-header">
    <h5 class="modal-title"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<form action="@if(isset($record->id)) {{ route('award-update', array('id' => encrypt($record->id))) }} @else{{ route('award-store') }} @endif" method="POST" class="award-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body m-3" id="form-detail">
        <div class="row">
            <div class="col-12">
                <label for="brand_id" class="form-label">Brand<span class="text-danger">*</span></label>
                <select class="form-control select2" name="brand_id" id="brand_id">
                    <option value="">-- Select Brand --</option>
                    @foreach($brand as $value)
                        <option value="{{$value->id}}"@if(isset($record->brand_id) && $record->brand_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                    @endforeach
                </select>
                <div id="error"></div>
                @if ($errors->has('brand_id')) <div class="text-danger">{{ $errors->first('brand_id') }}</div>@endif
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
