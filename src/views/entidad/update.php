<?php
/**
 * views/entidad/update.php
 * Renderizado por PhpRenderer en GET /entidad/update/{id}.
 * Variables disponibles: $producto (array), $categorias (array), $errores (array).
 *
 * El formulario HTML no puede enviar verbos PUT, así que el submit se
 * intercepta con JS y se manda por fetch() como PUT a /entidad/{id}.
 */
$producto = $producto ?? [];
$categorias = $categorias ?? [];
$errores = $errores ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar producto — Voltec Ergon</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --navy-deep:#0A2E6B;--blue-brand:#0057D6;--green-energy:#0FB88A;
  --amber-alert:#FFC72C;--bg-light:#F4F7FB;--ink:#0B1220;--ink-soft:#42506B;--line:#DDE4EF;
  --mono:'IBM Plex Mono',monospace;--display:'Space Grotesk',sans-serif;--body:'IBM Plex Sans',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:var(--body);background:var(--bg-light);color:var(--ink);min-height:100vh;
  display:flex;align-items:center;justify-content:center;padding:40px 20px;}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;max-width:560px;width:100%;
  padding:40px;box-shadow:0 20px 50px -30px rgba(10,46,107,.35);}
.brand{display:flex;align-items:center;gap:10px;margin-bottom:26px;}
.brand .mark{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,var(--navy-deep),var(--blue-brand));flex-shrink:0;position:relative;}
.brand .mark::after{content:"";position:absolute;inset:8px;border:2px solid var(--amber-alert);border-right-color:transparent;border-bottom-color:transparent;border-radius:2px;transform:rotate(45deg);}
.brand span{font-family:var(--display);font-weight:700;font-size:15px;color:var(--navy-deep);}
.eyebrow{font-family:var(--mono);font-size:11.5px;letter-spacing:.12em;text-transform:uppercase;color:var(--blue-brand);
  display:inline-flex;align-items:center;gap:7px;font-weight:500;margin-bottom:10px;}
.eyebrow::before{content:"";width:6px;height:6px;border-radius:50%;background:var(--green-energy);}
h1{font-family:var(--display);font-size:24px;color:var(--navy-deep);margin-bottom:24px;line-height:1.25;}
label{display:block;font-family:var(--mono);font-size:11px;text-transform:uppercase;letter-spacing:.05em;
  color:var(--ink-soft);margin-bottom:6px;margin-top:18px;}
label:first-of-type{margin-top:0;}
input,textarea,select{width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:8px;
  font-family:var(--body);font-size:14.5px;color:var(--ink);background:var(--bg-light);}
input:focus,textarea:focus,select:focus{outline:none;border-color:var(--blue-brand);background:#fff;}
textarea{resize:vertical;min-height:90px;}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.checkbox-row{display:flex;align-items:center;gap:10px;margin-top:18px;}
.checkbox-row input{width:auto;}
.checkbox-row label{margin:0;}
.btn{margin-top:26px;width:100%;background:var(--navy-deep);color:#fff;border:none;border-radius:8px;
  padding:14px;font-family:var(--body);font-weight:600;font-size:15px;cursor:pointer;transition:.18s;}
.btn:hover{background:var(--blue-brand);}
.btn:disabled{opacity:.6;cursor:not-allowed;}
.errors{background:#FBE6E3;border:1px solid #E7A79E;color:#8A2A1E;border-radius:8px;padding:12px 16px;
  margin-bottom:20px;font-size:13.5px;}
.errors ul{margin-left:18px;margin-top:4px;}
.link-back{display:inline-block;margin-top:20px;font-size:13.5px;color:var(--blue-brand);font-weight:500;text-decoration:none;}
</style>
</head>
<body>
  <div class="card">
    <div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div>
    <span class="eyebrow">Editar entidad #<?= htmlspecialchars((string) $producto['id']) ?></span>
    <h1>Editar producto</h1>

    <div id="errores-js" class="errors" style="display:none;">
      <strong>Revisá estos datos:</strong>
      <ul id="errores-lista-js"></ul>
    </div>

    <?php if (!empty($errores)): ?>
      <div class="errors">
        <strong>Revisá estos datos:</strong>
        <ul>
          <?php foreach ($errores as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form id="form-editar" method="POST" action="/entidad/<?= htmlspecialchars((string) $producto['id']) ?>">
      <label for="nombre">Nombre del producto</label>
      <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>

      <div class="row2">
        <div>
          <label for="precio">Precio (ARS)</label>
          <input type="number" id="precio" name="precio" step="0.01" min="0"
                 value="<?= htmlspecialchars((string) ($producto['precio'] ?? '0')) ?>" required>
        </div>
        <div>
          <label for="stock">Stock</label>
          <input type="number" id="stock" name="stock" step="1" min="0"
                 value="<?= htmlspecialchars((string) ($producto['stock'] ?? '0')) ?>" required>
        </div>
      </div>

      <label for="categoria_id">Categoría</label>
      <select id="categoria_id" name="categoria_id">
        <option value="">Sin categoría</option>
        <?php foreach ($categorias as $categoria): ?>
          <option value="<?= htmlspecialchars((string) $categoria['id']) ?>"
            <?= (string) ($producto['categoria_id'] ?? '') === (string) $categoria['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($categoria['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>

      <div class="checkbox-row">
        <input type="checkbox" id="disponible" name="disponible" value="1"
          <?= !empty($producto['disponible']) ? 'checked' : '' ?>>
        <label for="disponible">Disponible para la venta</label>
      </div>

      <button type="submit" class="btn" id="btn-guardar">Guardar cambios</button>
    </form>

    <a class="link-back" href="/entidad/<?= htmlspecialchars((string) $producto['id']) ?>">← Cancelar y volver al detalle</a>
  </div>

  <script>
    // El HTML no soporta el verbo PUT en un <form>, así que el submit se
    // intercepta acá y se envía por fetch como PUT en JSON.
    const form = document.getElementById('form-editar');
    const btn = document.getElementById('btn-guardar');
    const erroresBox = document.getElementById('errores-js');
    const erroresLista = document.getElementById('errores-lista-js');

    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      btn.disabled = true;
      btn.textContent = 'Guardando...';
      erroresBox.style.display = 'none';
      erroresLista.innerHTML = '';

      const formData = new FormData(form);
      const payload = {
        nombre: formData.get('nombre'),
        precio: formData.get('precio'),
        stock: formData.get('stock'),
        categoria_id: formData.get('categoria_id') || null,
        descripcion: formData.get('descripcion'),
        disponible: formData.get('disponible') === '1',
      };

      try {
        const res = await fetch(form.action, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(payload),
        });

        const data = await res.json().catch(() => ({}));

        if (res.status === 401) {
          window.location.href = '/auth/login';
          return;
        }

        if (!res.ok) {
          const errores = data.errores || [data.error || 'No se pudo guardar el producto.'];
          erroresLista.innerHTML = errores.map((e) => `<li>${e}</li>`).join('');
          erroresBox.style.display = 'block';
          btn.disabled = false;
          btn.textContent = 'Guardar cambios';
          return;
        }

        window.location.href = `/entidad/${data.id}`;
      } catch (err) {
        erroresLista.innerHTML = '<li>Error de red. Intentá nuevamente.</li>';
        erroresBox.style.display = 'block';
        btn.disabled = false;
        btn.textContent = 'Guardar cambios';
      }
    });
  </script>
</body>
</html>
