<?php
/**
 * views/entidad/created.php
 * Renderizado por PhpRenderer en POST /entidad cuando los datos son válidos.
 * Variables disponibles: $nombre, $precio, $descripcion.
 */
$precioFmt = number_format((float) $precio, 2, ',', '.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producto creado — Voltec Ergon</title>
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
.badge{display:inline-flex;align-items:center;gap:6px;background:rgba(15,184,138,.1);color:var(--green-energy);
  font-family:var(--mono);font-size:12px;padding:6px 12px;border-radius:20px;margin-bottom:20px;font-weight:600;}
.badge::before{content:"";width:6px;height:6px;background:var(--green-energy);border-radius:50%;}
.result-row{display:flex;justify-content:space-between;padding:14px 0;border-bottom:1px dashed var(--line);font-size:14.5px;}
.result-row:last-child{border-bottom:none;}
.result-row .k{color:var(--ink-soft);font-family:var(--mono);font-size:11.5px;text-transform:uppercase;letter-spacing:.04em;}
.result-row .v{font-weight:600;color:var(--navy-deep);text-align:right;max-width:60%;}
.link-back{display:inline-block;margin-top:24px;font-size:13.5px;color:var(--blue-brand);font-weight:500;}
</style>
</head>
<body>
  <div class="card">
    <div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div>
    <span class="badge">Producto recibido</span>
    <h1><?= htmlspecialchars($nombre) ?></h1>
    <div class="result-row"><span class="k">Nombre</span><span class="v"><?= htmlspecialchars($nombre) ?></span></div>
    <div class="result-row"><span class="k">Precio</span><span class="v">$ <?= htmlspecialchars($precioFmt) ?></span></div>
    <div class="result-row"><span class="k">Descripción</span><span class="v"><?= htmlspecialchars($descripcion !== '' ? $descripcion : '—') ?></span></div>
    <a class="link-back" href="/create/entidad">← Cargar otro producto</a>
  </div>
</body>
</html>