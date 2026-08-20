<?php
/**
 * views/entidad/index.php
 * Renderizado por PhpRenderer en GET /entidad.
 * Variables disponibles: $productos (array), $limit (int|null) — el límite aplicado, si lo hubo.
 */
$productos = $productos ?? [];
$totalDisponible = $totalDisponible ?? count($productos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Listado de productos — Voltec Ergon</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --navy-deep:#0A2E6B;--blue-brand:#0057D6;--green-energy:#0FB88A;
  --amber-alert:#FFC72C;--bg-light:#F4F7FB;--ink:#0B1220;--ink-soft:#42506B;--line:#DDE4EF;
  --mono:'IBM Plex Mono',monospace;--display:'Space Grotesk',sans-serif;--body:'IBM Plex Sans',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:var(--body);background:var(--bg-light);color:var(--ink);min-height:100vh;padding:48px 20px;}
.wrap{max-width:760px;margin:0 auto;}
.brand{display:flex;align-items:center;gap:10px;margin-bottom:30px;}
.brand .mark{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,var(--navy-deep),var(--blue-brand));flex-shrink:0;position:relative;}
.brand .mark::after{content:"";position:absolute;inset:8px;border:2px solid var(--amber-alert);border-right-color:transparent;border-bottom-color:transparent;border-radius:2px;transform:rotate(45deg);}
.brand span{font-family:var(--display);font-weight:700;font-size:15px;color:var(--navy-deep);}
.top-row{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:26px;gap:16px;flex-wrap:wrap;}
.eyebrow{font-family:var(--mono);font-size:11.5px;letter-spacing:.12em;text-transform:uppercase;color:var(--blue-brand);
  display:inline-flex;align-items:center;gap:7px;font-weight:500;margin-bottom:10px;}
.eyebrow::before{content:"";width:6px;height:6px;border-radius:50%;background:var(--green-energy);}
h1{font-family:var(--display);font-size:26px;color:var(--navy-deep);}
.count{font-family:var(--mono);font-size:12.5px;color:var(--ink-soft);}
.btn{background:var(--navy-deep);color:#fff;border:none;border-radius:8px;padding:11px 18px;
  font-family:var(--body);font-weight:600;font-size:13.5px;text-decoration:none;transition:.18s;white-space:nowrap;}
.btn:hover{background:var(--blue-brand);}
.list{display:flex;flex-direction:column;gap:12px;}
.item{background:#fff;border:1px solid var(--line);border-radius:12px;padding:18px 20px;
  display:flex;justify-content:space-between;align-items:center;gap:16px;text-decoration:none;color:inherit;transition:.15s;}
.item:hover{border-color:var(--blue-brand);box-shadow:0 10px 24px -16px rgba(0,87,214,.4);}
.item .id{font-family:var(--mono);font-size:11px;color:var(--blue-brand);background:rgba(0,87,214,.08);
  padding:3px 9px;border-radius:6px;margin-bottom:6px;display:inline-block;}
.item .name{font-family:var(--display);font-size:16px;color:var(--navy-deep);font-weight:600;}
.item .price{font-family:var(--mono);font-size:16px;font-weight:600;color:var(--green-energy);white-space:nowrap;}
.empty{background:#fff;border:1px dashed var(--line);border-radius:12px;padding:36px;text-align:center;
  color:var(--ink-soft);font-size:14px;}
.hint{margin-top:26px;font-size:12px;color:var(--ink-soft);}
.hint code{font-family:var(--mono);background:#fff;border:1px solid var(--line);padding:1px 6px;border-radius:4px;}
</style>
</head>
<body>
  <div class="wrap">
    <div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div>

    <div class="top-row">
      <div>
        <span class="eyebrow">Listado de entidad</span>
        <h1>Productos</h1>
      </div>
      <a class="btn" href="/create/entidad">+ Nuevo producto</a>
    </div>

    <p class="count">
      Mostrando <?= count($productos) ?> de <?= $totalDisponible ?> producto<?= $totalDisponible === 1 ? '' : 's' ?>
      <?= isset($limit) ? " (limit={$limit})" : "" ?>
    </p>
    <br>

    <?php if (empty($productos)): ?>
      <div class="empty">No hay productos para mostrar.</div>
    <?php else: ?>
      <div class="list">
        <?php foreach ($productos as $producto): ?>
          <a class="item" href="/entidad/<?= urlencode($producto['id']) ?>">
            <div>
              <span class="id">#<?= htmlspecialchars($producto['id']) ?></span>
              <div class="name"><?= htmlspecialchars($producto['name']) ?></div>
            </div>
            <div class="price">$ <?= number_format((float) $producto['price'], 0, ',', '.') ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <p class="hint">Probá <code>/entidad?limit=2</code> para limitar la cantidad de resultados.</p>
  </div>
</body>
</html>