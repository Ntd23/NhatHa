<script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('admin/assets/js/Chart.bundle.js') }}"></script>
<script src="{{ asset('admin/assets/js/chart.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="{{asset('admin/assets/sortable/jquery-ui.js')}}"></script>
 <script src="https://cdn.tiny.cloud/1/vacmpatwq2s22lssgvuypv9teodix62sqtbui82yqtupux4m/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
<script type="text/javascript">
 $('.editor').tinymce({
        height: 500,
        menubar: true,
        plugins: [
          'accordion', 'advlist', 'anchor', 'autolink', 'autosave',
        ],
        toolbar: 'undo redo | accordion accordionremove | ' +
          'importword exportword exportpdf | math | ' +
          'blocks fontfamily fontsize | bold italic underline strikethrough | ' +
          'align numlist bullist | link image | table media | ' +
          'lineheight outdent indent | forecolor backcolor removeformat | ' +
          'charmap emoticons | code fullscreen preview | save print | ' +
          'pagebreak anchor codesample | ltr rtl',
        menubar: 'file edit view insert format tools table help'
      });
</script>


