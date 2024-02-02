@if ($errors->any())
    <script>
        Swal.fire({
            title: 'Pesan',
            text: '{{ $errors->first() }}',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
@endif
