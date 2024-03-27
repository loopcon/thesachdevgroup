
<!-- jQuery -->
<script src="{{url('public/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & public/Plugins -->

{{-- validate --}}
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>


<script src="{{url('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('public/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('public/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('public/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('public/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('public/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('public/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('public/dist/js/demo.js')}}"></script>
<!-- Page specific script -->

{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
{{-- colorpicker --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
 
{{-- ckeditor --}}
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});

$(document).ready(function () {
  $('.select2').select2();
});
</script>
@yield('javascript')
</body>
</html>