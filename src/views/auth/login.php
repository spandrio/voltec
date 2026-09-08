<?php
$errores = $errores ?? [];
$old = $old ?? [];
$registrado = $registrado ?? false;
$redirect = $redirect ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesión — Voltec Ergon</title>
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
.card{background:#fff;border:1px solid var(--line);border-radius:16px;max-width:420px;width:100%;
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
input{width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:8px;
  font-family:var(--body);font-size:14.5px;color:var(--ink);background:var(--bg-light);}
input:focus{outline:none;border-color:var(--blue-brand);background:#fff;}
.btn{margin-top:26px;width:100%;background:var(--navy-deep);color:#fff;border:none;border-radius:8px;
  padding:14px;font-family:var(--body);font-weight:600;font-size:15px;cursor:pointer;transition:.18s;}
.btn:hover{background:var(--blue-brand);}
.errors{background:#FBE6E3;border:1px solid #E7A79E;color:#8A2A1E;border-radius:8px;padding:12px 16px;
  margin-bottom:20px;font-size:13.5px;}
.errors ul{margin-left:18px;margin-top:4px;}
.success{background:rgba(15,184,138,.1);border:1px solid rgba(15,184,138,.35);color:#0A7A5C;
  border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:13.5px;}
.foot{margin-top:22px;font-size:13px;color:var(--ink-soft);text-align:center;}
.foot a{color:var(--blue-brand);font-weight:600;text-decoration:none;}
</style>
</head>
<body>
  <div class="card">
    <a href="/" style="text-decoration:none;"><div class="brand"><div class="mark"></div><span>VOLTEC ERGON</span></div></a>
    <span class="eyebrow">Acceso</span>
    <h1>Iniciar sesión</h1>

    <?php if ($registrado): ?>
      <div class="success">Cuenta creada con éxito. Ya podés iniciar sesión.</div>
    <?php endif; ?>

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

    <form method="POST" action="/auth/login">
      <?php if ($redirect): ?>
        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
      <?php endif; ?>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Ej: harry@voltecergon.com"
             value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" class="btn">Ingresar</button>
    </form>

    <div class="foot">¿No tenés cuenta? <a href="/auth/register">Crear cuenta</a></div>
  </div>
</body>
</html>
