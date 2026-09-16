<?php
/**
 * views/site/contacto.php
 * Renderizado por PhpRenderer en GET/POST /contacto dentro de layouts/site.php.
 * Variables disponibles: $enviado (bool), $errores (array), $old (array).
 */
$enviado = $enviado ?? false;
$errores = $errores ?? [];
$old = $old ?? [];
?>
<section class="page-header">
  <div class="wrap">
    <span class="eyebrow">Contacto</span>
    <h1>¿Listos para ver cuánto se está escapando?</h1>
    <p class="lead">Contanos qué espacio querés auditar y te respondemos con una propuesta de instalación.</p>
  </div>
</section>

<section class="bg-white" style="padding-top:20px;">
  <div class="wrap contact-grid">
    <div>
      <div class="contact-card">
        <div class="ico">@</div>
        <div><h5>Email</h5><a href="mailto:contacto@voltecergon.com.ar">contacto@voltecergon.com.ar</a></div>
      </div>
      <div class="contact-card">
        <div class="ico">#</div>
        <div><h5>Institución</h5><p>E.E.S.T. N°4 de Berazategui — Proyecto institucional con Fundación YPF</p></div>
      </div>
      <div class="contact-card">
        <div class="ico">~</div>
        <div><h5>Horarios de atención</h5><p>Lunes a viernes, horario escolar</p></div>
      </div>
      <div class="contact-card">
        <div class="ico">→</div>
        <div><h5>¿Ya sos cliente?</h5><a href="/auth/login">Ingresá al panel interno</a></div>
      </div>
    </div>

    <div class="contact-form">
      <?php if ($enviado): ?>
        <div style="background:rgba(15,184,138,.1);border:1px solid rgba(15,184,138,.35);border-radius:10px;padding:16px 18px;color:#0A7A5C;font-size:14.5px;">
          <b>¡Listo!</b> Recibimos tu consulta. Te vamos a contactar a la brevedad.
        </div>
      <?php else: ?>
        <?php if (!empty($errores)): ?>
          <div style="background:rgba(214,69,69,.08);border:1px solid rgba(214,69,69,.3);border-radius:10px;padding:14px 18px;margin-bottom:18px;color:#B0392E;font-size:13.5px;">
            <ul style="padding-left:18px;">
              <?php foreach ($errores as $error): ?>
                <li><?= html($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form method="POST" action="/contacto">
          <div class="field">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= html($old['nombre'] ?? '') ?>" placeholder="Tu nombre">
          </div>
          <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= html($old['email'] ?? '') ?>" placeholder="tu@email.com">
          </div>
          <div class="field">
            <label for="espacio">Tipo de espacio</label>
            <select id="espacio" name="espacio">
              <option value="hogar" <?= ($old['espacio'] ?? '') === 'hogar' ? 'selected' : '' ?>>Hogar</option>
              <option value="institucional" <?= ($old['espacio'] ?? '') === 'institucional' ? 'selected' : '' ?>>Institucional</option>
              <option value="comercial" <?= ($old['espacio'] ?? '') === 'comercial' ? 'selected' : '' ?>>Comercial</option>
            </select>
          </div>
          <div class="field">
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" placeholder="Contanos qué querés monitorear..."><?= html($old['mensaje'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Enviar consulta</button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head" style="margin:0 auto 30px;text-align:center;max-width:560px;">
      <span class="eyebrow">Preguntas frecuentes</span>
      <h2>Antes de escribirnos</h2>
    </div>
    <div class="faq-list" style="margin:0 auto;">
      <details class="faq-item">
        <summary>¿Cuánto tarda una instalación?</summary>
        <div class="a">Depende de la cantidad de artefactos a monitorear. Un módulo se instala y configura en menos de una hora.</div>
      </details>
      <details class="faq-item">
        <summary>¿Necesito internet en el lugar?</summary>
        <div class="a">Sí, los módulos usan Wi-Fi para sincronizar con Firebase y Blynk en tiempo real.</div>
      </details>
      <details class="faq-item">
        <summary>¿Puedo monitorear más de un artefacto?</summary>
        <div class="a">Sí, el sistema es modular: instalás un módulo Eco Smart Grid por cada artefacto que quieras medir y controlar.</div>
      </details>
    </div>
  </div>
</section>
