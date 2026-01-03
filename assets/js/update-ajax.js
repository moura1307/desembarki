
function editarProduto(id) {
    // Busca os dados do produto via AJAX (usando o get_product.php que você já tem)
    fetch(`get_product.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-nome').value = data.nome;
            document.getElementById('edit-preco').value = data.preco;
            
            // Limpa e preenche o container de imagens no modal
            const container = document.getElementById('container-imagens-edit');
            container.innerHTML = '';
            
            if (data.imagens && data.imagens.length > 0) {
                data.imagens.forEach(url => {
                    addCampoEdit(url);
                });
            } else {
                addCampoEdit(); // Adiciona um campo vazio se não houver imagens
            }

            // Abre o modal do Bootstrap
            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
}

function addCampoEdit(valor = '') {
    const container = document.getElementById('container-imagens-edit');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input name="imagens[]" class="form-control" value="${valor}" placeholder="http://...">
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">Remover</button>
    `;
    container.appendChild(div);
}

// Lógica para salvar a edição via AJAX ou Redirecionamento
document.getElementById('formEditar').onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    // Como seu edit_product.php está configurado para receber POST
    // Vamos enviar os dados para ele.
    fetch('edit_product.php?id=' + document.getElementById('edit-id').value, {
        method: 'POST',
        body: formData
    }).then(() => {
        window.location.href = 'index.php?success=editado';
    }).catch(err => alert('Erro ao salvar: ' + err));
};