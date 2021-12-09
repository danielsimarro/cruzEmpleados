(function () {

    
    let modalDelete = document.getElementById('modalDelete');
    let deletePuesto = document.getElementById('deletePuesto');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.dataset.name;
        if(deletePuesto) {
            deletePuesto.innerHTML = name;
        }
        let form = document.getElementById('modalDeleteResourceForm');
        form.action = action;
    });

})();