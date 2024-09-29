// Uso do SweetAlert2
// Receber o seletor apagar e percorrer a lista de registros
document.querySelectorAll('.btnDelete').forEach( function(button){

    // Aguardar o clique do usuário no botão apagar
    button.addEventListener('click', function(event){
        event.preventDefault();

        // Receber define a Entidade a ser deletda, o atributo que possui o id do registro e seu respectivo valor a ser excluído
        var deleteEntidade = this.getAttribute('data-delete-entidade');
        var deleteId = this.getAttribute('data-delete-id');
        var valueRecord = this.getAttribute('data-value-record');


        // SweetAlert
        Swal.fire({
            title: 'Deletar ' + deleteEntidade + '\n' + valueRecord + ' ?',
            text: 'Você não poderá reverter esta ação!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0d6efd',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Sim, Excluir!"
        }).then((result) => {
            // Carregar a página responsável em excluir se o usuário confirmar a exclusão
            if (result.isConfirmed) {

                document.getElementById(`formDelete${deleteId}`).submit();
            }
        });
    });
})

// Uso do Select2
// Quando carregar a página execute o Select2
// Acrescentar a classe ".select2" em todos os selects que houver a necessidade de utilizar o select2
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap-5',
    });
});
