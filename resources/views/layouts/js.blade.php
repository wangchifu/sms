<script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('js/pages/dashboard.js') }}"></script>

<!--from table-datatable-jquery -->
<script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}assets/"></script>
<script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
@yield('js')
<script>
<!-- Jquery Datatable -->
    let jquery_datatable = $("#table1").DataTable()
</script>

<script src="{{ asset('js/mazer.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    function sw_confirm(message,url) {
            Swal.fire({
                title: "操作確認",
                text: message,
                showCancelButton: true,
                confirmButtonText:"確定",
                cancelButtonText:"取消",
            }).then(function(result) {
               if (result.value) {
                window.location = url;
               }
               else {
                  return false;
               }
            });
        }
</script>