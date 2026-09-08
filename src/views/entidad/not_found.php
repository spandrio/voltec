<?php
$id = $id ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Módulo no encontrado — Voltec Ergon</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --navy-deep:#0A2E6B;--blue-brand:#0057D6;--amber-alert:#FFC72C;--bg-light:#F4F7FB;
  --ink:#0B1220;--ink-soft:#42506B;--line:#DDE4EF;--danger:#D64545;
  --mono:'IBM Plex Mono',monospace;--display:'Space Grotesk',sans-serif;--body:'IBM Plex Sans',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:var(--body);background:var(--bg-light);color:var(--ink);min-height:100vh;
  display:flex;align-items:center;justify-content:center;padding:40px 20px;}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;max-width:480px;width:100%;
  padding:44px;text-align:center;box-shadow:0 20px 50px -30px rgba(10,46,107,.35);}
.brand{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:26px;}
.brand .mark{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,var(--navy-deep),var(--blue-brand));flex-shrink:0;position:relative;}
.brand .mark::after{content:"";position:absolute;inset:8px;border:2px solid var(--amber-alert);border-right-color:transparent;border-bottom-color:transparent;border-radius:2px;transform:rotate(45deg);}
.brand span{font-family:var(--display);font-weight:700;font-size:15px;color:var(--navy-deep);}
.code{font-family:var(--mono);font-size:13px;color:var(--danger);background:rgba(214,69,69,.08);
  display:inline-block;padding:4px 12px;border-radius:20px;font-weight:600;margin-bottom:16px;}
h1{font-family:var(--display);font-size:22px;color:var(--navy-deep);margin-bottom:10px;}
p{color:var(--ink-soft);font-size:14.5px;margin-bottom:26px;}
.link-back{display:inline-block;background:var(--navy-deep);color:#fff;text-decoration:none;
  padding:12px 22px;border-radius:8px;font-weight:600;font-size:14px;}
.link-back:hover{background:var(--blue-brand);}
</style>
</head>
<body>
  <div class="card">
    <a href="/" style="text-decoration:none;"><div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div></a>
    <span class="code">404</span>
    <h1>Módulo no encontrado</h1>
    <p>No existe ningún módulo con el id <strong><?= htmlspecialchars((string) $id) ?></strong> en el catálogo.</p>
    <a class="link-back" href="/entidad">← Volver al listado</a>
  </div>
</body>
</html>
