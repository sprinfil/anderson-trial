function alert_eliminar(e){
    e.preventDefault();
    var url = e.currentTarget.getAttribute('href');
    Swal.fire({
        title: "¿Seguro que desea eliminar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=url;
        }
      });
}