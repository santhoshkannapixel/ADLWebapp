<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    // toastr.success("success")
</script>

<script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
        toastr.{{ $message['level'] == 'danger' ? "error" : 'success' }}("{!! $message['message'] !!}")
    @endforeach
</script>
 
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>

{{ session()->forget('flash_notification') }}