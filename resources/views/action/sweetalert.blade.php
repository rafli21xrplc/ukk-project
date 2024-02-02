<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function ask(params) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak akan dapat mengembalikannya!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setuju!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(params).submit();
            }
        });
    }
</script>
