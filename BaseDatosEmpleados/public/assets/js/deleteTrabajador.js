(function () {

    
    let modalDelete = document.getElementById('modalDelete');
    let deleteTrabajador = document.getElementById('deleteTrabajador');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;
        if(deleteTrabajador) {
            deleteTrabajador.innerHTML = name;
        }
        let form = document.getElementById('modalDeleteResourceForm');
        form.action = action;
    });

})();