<?php
/**
 * views/entidad/store.php
 * Renderizado por PhpRenderer en GET /create/entidad y, si falla la validación, en POST /entidad.
 * Variables disponibles: $errores (array), $old (array) — ambas opcionales.
 */
$errores = $errores ?? [];
$old = $old ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear producto — Voltec Ergon</title>
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
input,textarea{width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:8px;
  font-family:var(--body);font-size:14.5px;color:var(--ink);background:var(--bg-light);}
input:focus,textarea:focus{outline:none;border-color:var(--blue-brand);background:#fff;}
textarea{resize:vertical;min-height:90px;}
.btn{margin-top:26px;width:100%;background:var(--navy-deep);color:#fff;border:none;border-radius:8px;
  padding:14px;font-family:var(--body);font-weight:600;font-size:15px;cursor:pointer;transition:.18s;}
.btn:hover{background:var(--blue-brand);}
.errors{background:#FBE6E3;border:1px solid #E7A79E;color:#8A2A1E;border-radius:8px;padding:12px 16px;
  margin-bottom:20px;font-size:13.5px;}
.errors ul{margin-left:18px;margin-top:4px;}
.note{margin-top:26px;font-size:12px;color:var(--ink-soft);background:rgba(255,199,44,.12);
  border:1px solid rgba(255,199,44,.35);padding:10px 14px;border-radius:8px;}
</style>
</head>
<body>
  <div class="card">
    <div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div>
    <span class="eyebrow">Nueva entidad</span>
    <h1>Nuevo producto</h1>

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

    <form method="POST" action="/entidad">
      <label for="nombre">Nombre del producto</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ej: Toma inteligente Eco Smart Grid"
             value="<?= htmlspecialchars($old['nombre'] ?? '') ?>" required>

      <label for="precio">Precio (ARS)</label>
      <input type="number" id="precio" name="precio" step="0.01" min="0" placeholder="Ej: 45000"
             value="<?= htmlspecialchars($old['precio'] ?? '') ?>" required>

      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion"
                placeholder="Ej: Módulo de monitoreo de consumo eléctrico en tiempo real."><?= htmlspecialchars($old['descripcion'] ?? '') ?></textarea>

      <button type="submit" class="btn">Crear producto</button>
    </form>
    <div class="note">Este formulario todavía no guarda datos en base de datos: solo envía la información a /entidad para mostrarla.</div>
  </div>
</body>
</html>