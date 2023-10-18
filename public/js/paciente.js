function alerta_eliminar_paciente(id, nombre){
    var formulario = $('#EditForm'+id);
    
    Swal.fire({
        title: '¿Esta seguro que desea eliminar al usuario <strong>' +nombre+ ' </strong>?',
        text: "No podra revertir esta decision!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borralo!',
        cancelButtonText: 'No, cancelar'
      }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire(
                '¡Se eliminará!',
                'El registro del usuario <strong>'+nombre+ ' </strong> se eliminará',
                'success'
               
            ).then((result)=>{
                formulario.submit();
                console.log("enviadoooo");
            });

        }
      })

    return false;
}