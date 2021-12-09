(function () {

    
    let modalDelete = document.getElementById('modalDelete');
    let deleteDepartamento = document.getElementById('deleteDepartamento');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;
        if(deleteDepartamento) {
            deleteDepartamento.innerHTML = name;
        }
        let form = document.getElementById('modalDeleteResourceForm');
        form.action = action;
    });

})();