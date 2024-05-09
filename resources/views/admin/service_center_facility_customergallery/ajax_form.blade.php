<div class="modal-header">
    <h5 class="modal-title">{{isset($record->id) && $record->id ? 'Service Center Facility Customer Gallery Edit' : 'Service Center Facility Customer Gallery Create'}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<form action="@if(isset($record->id)) {{ route('service-center-facility-customergallery-update', array('id' => encrypt($record->id))) }} @else{{ route('service-center-facility-customergallery-store') }} @endif" method="POST" class="service-center-facility-gallery-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body m-3" id="form-detail">
        <div class="row">
            <div class="col-12 adm-brand-errorbox">
                <label for="service_center_id" class="form-label">Service Center<span class="text-danger">*</span></label>
                <select class="form-control select2" name="service_center_id" id="service_center_id">
                    <option value="">-- Select Service Center --</option>
                    @foreach($service_center as $value)
                        <option value="{{$value->id}}"@if(isset($record->service_center_id) && $record->service_center_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('service_center_id')) <div class="text-danger">{{ $errors->first('service_center_id') }}</div>@endif
            </div>

            <div class="col-12">
                <label for="facility_image" class="form-label">Facility Image</label>
                @if(isset($record->facility_image) && $record->facility_image)
                    <img src="{{url('public/uploads/service_center_facility_image/'.$record->facility_image)}}" width="100" style="margin-bottom: 10px; margin-left:5px;">
                @endif  
                <input type="file" id="facility_image" class="form-control" name="facility_image" value="">
                @if ($errors->has('facility_image')) <div class="text-danger">{{ $errors->first('facility_image') }}</div>@endif
                <div class="error"></div>
                <small class="image_type">(Hight:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
            </div>

            <div class="col-12 mt-3">
                <label for="customer_gallery_image" class="form-label">Customer Gallery Image</label>
                @if(isset($record->customer_gallery_image) && $record->customer_gallery_image)
                    <img src="{{url('public/uploads/service_center_customer_gallery_image/'.$record->customer_gallery_image)}}" width="100" style="margin-bottom: 10px; margin-left:5px;">
                @endif  
                <input type="file" id="customer_gallery_image" class="form-control" name="customer_gallery_image" value="">
                @if ($errors->has('customer_gallery_image')) <div class="text-danger">{{ $errors->first('customer_gallery_image') }}</div>@endif
                <div class="error"></div>
                <small class="image_type">(Hight:325,Width:243; Image Type : jpg,jpeg,png,svg,webp)</small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary submit">Submit</button>
        <a href="{{ route('service-center-facility-customergallery') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>