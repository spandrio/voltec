<?php
$producto = $producto ?? [];
$precioFmt = number_format((float) ($producto['precio'] ?? 0), 2, ',', '.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($producto['nombre'] ?? 'Módulo') ?> — Voltec Ergon</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --navy-deep:#0A2E6B;--blue-brand:#0057D6;--green-energy:#0FB88A;
  --amber-alert:#FFC72C;--bg-light:#F4F7FB;--ink:#0B1220;--ink-soft:#42506B;--line:#DDE4EF;--danger:#D64545;
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
h1{font-family:var(--display);font-size:26px;color:var(--navy-deep);margin-bottom:22px;line-height:1.25;}
.badge{display:inline-flex;align-items:center;gap:6px;font-family:var(--mono);font-size:11.5px;
  padding:5px 11px;border-radius:20px;font-weight:600;margin-left:10px;vertical-align:middle;}
.badge.ok{background:rgba(15,184,138,.1);color:var(--green-energy);}
.badge.no{background:rgba(214,69,69,.1);color:var(--danger);}
.result-row{display:flex;justify-content:space-between;padding:14px 0;border-bottom:1px dashed var(--line);font-size:14.5px;gap:16px;}
.result-row:last-child{border-bottom:none;}
.result-row .k{color:var(--ink-soft);font-family:var(--mono);font-size:11.5px;text-transform:uppercase;letter-spacing:.04em;white-space:nowrap;}
.result-row .v{font-weight:600;color:var(--navy-deep);text-align:right;}
.actions{display:flex;gap:12px;margin-top:28px;}
.btn{flex:1;text-align:center;border-radius:8px;padding:13px;font-family:var(--body);font-weight:600;
  font-size:14px;cursor:pointer;transition:.18s;text-decoration:none;border:none;}
.btn-edit{background:var(--navy-deep);color:#fff;}
.btn-edit:hover{background:var(--blue-brand);}
.btn-delete{background:#fff;color:var(--danger);border:1.5px solid var(--danger);}
.btn-delete:hover{background:var(--danger);color:#fff;}
.btn-delete:disabled{opacity:.6;cursor:not-allowed;}
.link-back{display:inline-block;margin-top:22px;font-size:13.5px;color:var(--blue-brand);font-weight:500;text-decoration:none;}
</style>
</head>
<body>
  <div class="card">
    <a href="/" style="text-decoration:none;"><div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div></a>
    <span class="eyebrow">Catálogo Eco Smart Grid #<?= htmlspecialchars((string) $producto['id']) ?></span>
    <h1>
      <?= htmlspecialchars($producto['nombre'] ?? '') ?>
      <span class="badge <?= !empty($producto['disponible']) ? 'ok' : 'no' ?>">
        <?= !empty($producto['disponible']) ? 'Disponible' : 'No disponible' ?>
      </span>
    </h1>

    <div class="result-row"><span class="k">Precio</span><span class="v">$ <?= htmlspecialchars($precioFmt) ?></span></div>
    <div class="result-row"><span class="k">Stock</span><span class="v"><?= htmlspecialchars((string) ($producto['stock'] ?? 0)) ?></span></div>
    <div class="result-row"><span class="k">Categoría</span><span class="v"><?= htmlspecialchars($producto['categoria_nombre'] ?? 'Sin categoría') ?></span></div>
    <div class="result-row"><span class="k">Descripción</span><span class="v"><?= htmlspecialchars($producto['descripcion'] !== null && $producto['descripcion'] !== '' ? $producto['descripcion'] : '—') ?></span></div>

    <div class="actions">
      <a class="btn btn-edit" href="/entidad/update/<?= htmlspecialchars((string) $producto['id']) ?>">Editar</a>
      <button class="btn btn-delete" id="btn-eliminar" data-id="<?= htmlspecialchars((string) $producto['id']) ?>">Eliminar</button>
    </div>

    <a class="link-back" href="/entidad">← Volver al listado</a>
  </div>

  <script>
    document.getElementById('btn-eliminar').addEventListener('click', async (event) => {
      const btn = event.currentTarget;
      if (!confirm('¿Seguro que querés eliminar este módulo? Esta acción no se puede deshacer.')) {
        return;
      }

      btn.disabled = true;
      btn.textContent = 'Eliminando...';

      try {
        const res = await fetch(`/entidad/${btn.dataset.id}`, {
          method: 'DELETE',
          headers: { 'Accept': 'application/json' },
        });

        if (res.status === 401) {
          window.location.href = '/auth/login';
          return;
        }

        if (!res.ok) {
          const data = await res.json().catch(() => ({}));
          alert(data.error || 'No se pudo eliminar el módulo.');
          btn.disabled = false;
          btn.textContent = 'Eliminar';
          return;
        }

        window.location.href = '/entidad';
      } catch (err) {
        alert('Error de red. Intentá nuevamente.');
        btn.disabled = false;
        btn.textContent = 'Eliminar';
      }
    });
  </script>
</body>
</html>
