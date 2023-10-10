/*

! Alertas

* Funcion eliminar
Esta mostrara un mensaje que consultara si quiere eliminar el usuario, si el usuario lo acepta se borrara, de lo contrario no.
*/




function alerta_eliminar_usuario(id, name){
    var formulario = $('#EditForm'+id);
    
    Swal.fire({
        title: '¿Esta seguro que desea eliminar al usuario <strong>' +name+ ' </strong>?',
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
                'El registro del usuario <strong>'+name+ ' </strong> se eliminará',
                'success'
            ).then((result)=>{
                formulario.submit();
            });

        }
      })

    return false;
}

function alerta_eliminar_role(id, name){
    var formulario = $('#EditForm'+id);
    
    Swal.fire({
        title: '¿Esta seguro que desea eliminar el rol <strong>'+name+ ' </strong>?',
        text: "¡Los usuarios asociados a este rol se veran afectados, no podra revertir esta decision!",
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
                'El registro del rol <strong>'+name+ ' </strong> se eliminará',
                'success'
            ).then((result)=>{
                formulario.submit();
            });

        }
      })

    return false;
}
