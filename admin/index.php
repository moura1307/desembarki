<?php
require_once 'auth.php';
require_once 'db.php';

$messages = [];
if (isset($_GET['success'])) {
  $messages[] = ['type' => 'success', 'text' => 'Operação realizada com sucesso!'];
}
if (isset($_GET['error'])) {
  $messages[] = ['type' => 'danger', 'text' => 'Erro: ' . htmlspecialchars($_GET['error'])];
}

// Query corrigida: usa produto_tamanhos e GROUP_CONCAT para listar tudo em uma linha
$sql = "SELECT p.*, 
        GROUP_CONCAT(DISTINCT pi.caminho_arquivo) as todas_imagens,
        GROUP_CONCAT(DISTINCT t.tamanho SEPARATOR ', ') as todos_tamanhos
        FROM produtos p 
        LEFT JOIN produto_imagens pi ON p.id = pi.produto_id 
        LEFT JOIN produto_tamanhos t ON p.id = t.produto_id
        GROUP BY p.id 
        ORDER BY p.id DESC";
        
$products = $pdo->query($sql)->fetchAll();
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Admin - Desembarki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4">Gerenciar Produtos</h1>

    <?php foreach ($messages as $m): ?>
      <div class="alert alert-<?= $m['type'] ?>"><?= $m['text'] ?></div>
    <?php endforeach; ?>

    <div class="card mb-5 shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Adicionar Novo Produto</h5>
        <form action="createproduct.php" method="post">
          <input type="hidden" name="action" value="add">
          <div class="mb-3">
            <label class="form-label">Nome do Produto</label>
            <input name="nome" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="2"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Gramatura (g)</label>
              <input name="gramatura" type="number" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Tamanhos</label>
              <div id="container-tamanhos">
                <div class="input-group mb-2">
                  <input name="tamanhos[]" class="form-control" placeholder="mm, cm, m, etc.">
                </div>
              </div>
              <button type="button" class="btn btn-sm btn-secondary" onclick="addCampo('container-tamanhos')">+ Tamanho</button>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">URLs das Imagens</label>
            <div id="container-imagens">
              <div class="input-group mb-2">
                <input name="imagens[]" class="form-control" placeholder="http://...">
              </div>
            </div>
            <button type="button" class="btn btn-sm btn-secondary" onclick="addCampo('container-imagens')">+ Imagem</button>
          </div>
          <button type="submit" class="btn btn-primary w-100">Salvar Produto</button>
        </form>
      </div>
    </div>

    <h3 class="mb-3">Lista de Produtos</h3>
    <table class="table table-hover bg-white border shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Foto</th>
          <th>Nome / Slug</th>
          <th>Gramatura</th>
          <th>Tamanhos</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
        <tr class="align-middle">
          <td><?= $p['id'] ?></td>
          <td>
            <?php if (!empty($p['todas_imagens'])): ?>
              <img src="<?= explode(',', $p['todas_imagens'])[0] ?>" width="50" height="50" class="rounded border" style="object-fit: cover;">
            <?php endif; ?>
          </td>
          <td>
            <strong><?= htmlspecialchars($p['nome']) ?></strong><br>
            <small class="text-muted"><?= htmlspecialchars($p['slug'] ?? '') ?></small>
          </td>
          <td><?= $p['gramatura'] ? $p['gramatura'] . 'g' : '-' ?></td>
          <td><?= htmlspecialchars($p['todos_tamanhos'] ?? 'Nenhum') ?></td>
          <td>
            <button class="btn btn-sm btn-outline-primary" onclick="editarProduto(<?= $p['id'] ?>)">Editar</button>
            <a href="deleteproduct.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir?')">Remover</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="formEditar">
          <div class="modal-header">
            <h5 class="modal-title">Editar Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="edit-id">
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input name="name" id="edit-nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Descrição</label>
              <textarea name="descricao" id="edit-descricao" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Gramatura</label>
              <input name="gramatura" id="edit-gramatura" type="number" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Tamanhos</label>
              <div id="container-tamanhos-edit"></div>
              <button type="button" class="btn btn-sm btn-secondary mt-1" onclick="addCampo('container-tamanhos-edit')">+ Tamanho</button>
            </div>
            <div class="mb-3">
              <label class="form-label">Imagens</label>
              <div id="container-imagens-edit"></div>
              <button type="button" class="btn btn-sm btn-secondary mt-1" onclick="addCampo('container-imagens-edit')">+ Imagem</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function addCampo(containerId, valor = '') {
      const inputName = containerId.includes('tamanhos') ? 'tamanhos[]' : 'imagens[]';
      const div = document.createElement('div');
      div.className = 'input-group mb-2';
      div.innerHTML = `<input name="${inputName}" class="form-control" value="${valor}">
                       <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">X</button>`;
      document.getElementById(containerId).appendChild(div);
    }

    function editarProduto(id) {
      fetch(`get_product.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
          // Campos que já funcionam
          document.getElementById('edit-id').value = data.id;
          document.getElementById('edit-nome').value = data.nome;
          document.getElementById('edit-gramatura').value = data.gramatura || '';
          
          // ADICIONE ESTA LINHA:
          document.getElementById('edit-descricao').value = data.descricao || '';
          
          // Limpa e preenche Tamanhos
          const contTam = document.getElementById('container-tamanhos-edit');
          contTam.innerHTML = '';
          (data.tamanhos || []).forEach(t => addCampo('container-tamanhos-edit', t));

          // Limpa e preenche Imagens
          const contImg = document.getElementById('container-imagens-edit');
          contImg.innerHTML = '';
          (data.imagens || []).forEach(img => addCampo('container-imagens-edit', img));

          new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    }

    document.getElementById('formEditar').onsubmit = function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch(`edit_product.php?id=${document.getElementById('edit-id').value}`, { method: 'POST', body: formData })
        .then(() => window.location.reload());
    };
  </script>
</body>
</html>