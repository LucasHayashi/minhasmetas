<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirmar exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Tem certeza que deseja realizar a exclusão da meta?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-success" id="btn-confirmar-exclusao">Sim</button>
        </div>
    </div>
</div>
<script>
    $("#btn-confirmar-exclusao").on("click", function() {
        let id = $(this).data("id");

        $.ajax({
            url: 'ajax.php',
            method: 'post',
            dataType: 'ajax.php',
            data: {
                acao: 'excluir-meta',
                id_meta: id
            },
            success: function(data) {
                console.log(data)
                if (data.status === 204) {
                    $('#tbl-minhas-metas').DataTable().ajax.reload();
                    $('#meuModal').modal('hide');
                } else {
                    let divError = $('#alert-js-error');
                    divError.append(`<div class="alert alert-${data.class}" role="alert">${data.message}</div>`)
                }
            }
        });
    })
</script>