<style>

.swal2-title, .swal2-content {
            font-family: 'Roboto', sans-serif; /* Aplicando a fonte Roboto */
}

</style>

<script>

    window.onload = function(){
        Swal.fire({
        title: "Parabéns!",
        text: "Você confirmou seu e-mail, já pode realizar seu login!",
        icon: "success",
        confirmButtonText: "OK",
        customClass: {
            title: 'swal2-title',  // Aplicando a fonte ao título
            content: 'swal2-content' // Aplicando a fonte ao conteúdo
        }}).then((result) =>{
            if(result.isConfirmed) {
                window.location.href = '?a=login';
            }
        });
}



</script>