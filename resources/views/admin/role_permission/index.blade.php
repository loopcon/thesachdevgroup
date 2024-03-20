@include('admin.master') 
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="col-md-6">
                            <h1 class="m-0">Role Permission</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">{{__('Role')}}<span class="text-danger">*</span></label>
                                <select class="form-control" onchange="if (this.value) window.location.href=this.value">
                                    <option value="">-- select --</option>
                                    <option value="{{url('role-permission/'.$constant_superadmin)}}" {{$role_id == $constant_superadmin ? 'selected' : ''}}>{{__('Super Admin')}}</option>
                                    <option value="{{url('role-permission/'.$constant_hr)}}" {{$role_id == $constant_hr ? 'selected' : ''}}>{{__('HR')}}</option>
                                    <option value="{{url('role-permission/'.$constant_manager)}}" {{$role_id == $constant_manager ? 'selected' : ''}}>{{__('MANAGER')}}</option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <div class="content-header">
                        <section class="content">
                            <div class="container-fluid">
                                @if($role_id)
                                    <form method="post" action="{{route('role-permission')}}" data-parsley-validate>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
                                        @php($modules = getModules())

                                        @foreach($modules as $value)
                                            <div class="row">
                                                <div class="col-sm-3"><b>{{__($value->module)}}</b></div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <input type="checkbox" id="read_{{$value->id}}"  name="module_permission[{{$value->id}}][read]" value="1" {{ isset($module_permission[$value->id]['read']) && $module_permission[$value->id]['read'] == 1 ? 'checked' : '' }}><label for="read_{{$value->id}}"> &nbsp;<b> {{ __('Read') }} </b> </label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="checkbox" id="full_{{$value->id}}"  name="module_permission[{{$value->id}}][full]" value="1" {{ isset($module_permission[$value->id]['full']) && $module_permission[$value->id]['full'] == 1 ? 'checked' : '' }}><label for="full_{{$value->id}}"> &nbsp;<b> {{ __('Full') }} </b> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        @endforeach
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </form>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    @if($message = session('message'))
      swal("{{ $message }}");
    @endif
      
    @if(session()->has('message'))
      swal({
          title: "Role Permission",
          text: '{{ $message }}',
          icon: "success",
      })
  @endif
</script>