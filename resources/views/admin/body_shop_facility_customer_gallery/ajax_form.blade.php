<div class="modal-header">
    <h5 class="modal-title">{{isset($record->id) && $record->id ? 'Body Shop Facility Customer Gallery Edit' : 'Body Shop Facility Customer Gallery Create'}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<form action="@if(isset($record->id)) {{ route('body-shop-facility-customer-gallery-update', array('id' => encrypt($record->id))) }} @else{{ route('body-shop-facility-customer-gallery-store') }} @endif" method="POST" class="service-center-facility-gallery-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body m-3" id="form-detail">
        <div class="row">
            <div class="col-12 adm-brand-errorbox">
                <label for="body_shop_id" class="form-label">Body Shop<span class="text-danger">*</span></label>
                <select class="form-control select2" name="body_shop_id" id="body_shop_id">
                    <option value="">-- Select Body Shop --</option>
                    @foreach($body_shop as $value)
                        <option value="{{$value->id}}"@if(isset($record->body_shop_id) && $record->body_shop_id == $value->id){{'selected'}}@endif>{{$value->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('body_shop_id')) <div class="text-danger">{{ $errors->first('body_shop_id') }}</div>@endif
            </div>

            <div class="col-12">
                <label for="facility_image" class="form-label">Facility Image</label>
                @if(isset($record->facility_image) && $record->facility_image)
                    <img src="{{url('public/uploads/body_shop_facility_image/'.$record->facility_image)}}" width="50" style="margin-bottom: 10px; margin-left:5px;">
                @endif  
                <input type="file" id="facility_image" class="form-control" name="facility_image" value="">
                @if ($errors->has('facility_image')) <div class="text-danger">{{ $errors->first('facility_image') }}</div>@endif
                <div class="error"></div>
                <small class="image_type">(Hight:243px,Width:325px; Image Type : jpg,jpeg,png,svg,webp)</small>
            </div>

            <div class="col-12 mt-3">
                <label for="customer_gallery_image" class="form-label">Customer Gallery Image</label>
                @if(isset($record->customer_gallery_image) && $record->customer_gallery_image)
                    <img src="{{url('public/uploads/body_shop_customer_gallery_image/'.$record->customer_gallery_image)}}" width="50" style="margin-bottom: 10px; margin-left:5px;">
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
        <a href="{{ route('body-shop-facility-customer-gallery') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>