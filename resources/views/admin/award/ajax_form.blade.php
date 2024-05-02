<div class="modal-header">
    <h5 class="modal-title">{{isset($record->id) && $record->id ? 'Award Edit' : 'Award Create'}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<form action="@if(isset($record->id)) {{ route('award-update', array('id' => encrypt($record->id))) }} @else{{ route('award-store') }} @endif" method="POST" class="award-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body m-3" id="form-detail">
        <div class="row">
            <div class="col-12 mb-2">
                <label for="business_id" class="form-label">Our Business<span class="text-danger">*</span></label>
                <select class="form-control select2" name="business_id" id="business_id">
                    <option value="">-- Select Business --</option>
                    @foreach($our_business as $value)
                        <option value="{{$value->id}}"@if(isset($record->business_id) && $record->business_id == $value->id){{'selected'}}@endif>{{$value->title}}</option>
                    @endforeach
                </select>
                @if ($errors->has('business_id')) <div class="text-danger">{{ $errors->first('business_id') }}</div>@endif
            </div>

            <div class="col-12 mt-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{isset($record->name) ? $record->name : old('name')}}">
            </div>

            <div class="col-12 mt-3">
                <label for="image" class="form-label">Image</label>
                @if(isset($record->image) && $record->image)
                    <img src="{{url('public/uploads/award/'.$record->image)}}" width="100" style="margin-bottom:10px; margin-left:5px;">
                @endif  
                <input type="file" id="image" class="form-control" name="image" value="">
                @if ($errors->has('image')) <div class="text-danger">{{ $errors->first('image') }}</div>@endif
                <small class="image_type">(Hight:270px,Width:360px; Image Type : jpg,jpeg,png,svg,webp)</small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary submit">Submit</button>
        <a href="{{ route('awards') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
