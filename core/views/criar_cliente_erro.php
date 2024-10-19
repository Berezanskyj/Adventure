<style>

.swal2-title, .swal2-content {
            font-family: 'Roboto', sans-serif; /* Aplicando a fonte Roboto */
}

</style>

<script>

    window.onload = function(){
        Swal.fire({
            icon: "Erro!",
            title: "Parece que aconteceu um erro.",
            text: "Por favor, tente novamente.",
            confirmButtonText: "OK",
        customClass: {
            title: 'swal2-title',  // Aplicando a fonte ao título
            content: 'swal2-content' // Aplicando a fonte ao conteúdo
        }}).then((result) =>{
            if(result.isConfirmed) {
                window.location.href = '?a=inicio';
            }
        });
            
    }



</script>