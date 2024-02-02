@if (session('success'))
    <script>
        Swal.fire({
            title: 'Pesan',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            title: 'Pesan',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if (session('warning'))
    <script>
        Swal.fire({
            title: 'Pesan',
            text: '{{ session('warning') }}',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
@endif
