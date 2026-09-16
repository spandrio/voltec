<?php
/**
 * views/site/servicios.php
 * Renderizado por PhpRenderer en GET /servicios dentro de layouts/site.php.
 */
?>
<section class="page-header">
  <div class="wrap">
    <span class="eyebrow">Servicios</span>
    <h1>Todo lo que necesitás para dejar de adivinar cuánto consumís.</h1>
    <p class="lead">Desde la medición inicial hasta el software que te avisa y te deja actuar — cubrimos cada etapa del monitoreo energético.</p>
  </div>
</section>

<section class="bg-white" style="padding-top:20px;">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:26px;">

      <div class="service-detail">
        <div class="service-detail-head">
          <div class="ico-lg">01</div>
          <div>
            <h3>Auditoría energética</h3>
            <span class="tag">Diagnóstico · Relevamiento</span>
          </div>
        </div>
        <p class="desc">Relevamos el consumo real de cada artefacto de tu hogar, oficina o espacio institucional para identificar dónde se pierde energía y dinero.</p>
        <ul class="feature-list">
          <li>Medición de voltaje, corriente y potencia por artefacto</li>
          <li>Detección de consumo vampiro en standby (&lt;5W)</li>
          <li>Informe con costo estimado en pesos argentinos</li>
          <li>Cálculo de huella de carbono (0.325 kg CO₂/kWh)</li>
        </ul>
      </div>

      <div class="service-detail" style="border-color:var(--blue-brand);">
        <div class="service-detail-head">
          <div class="ico-lg">02</div>
          <div>
            <h3>Instalación y monitoreo IoT</h3>
            <span class="tag">Hardware · Eco Smart Grid</span>
          </div>
        </div>
        <p class="desc">Instalamos un módulo Eco Smart Grid por artefacto: mide, decide y corta el suministro cuando hace falta.</p>
        <ul class="feature-list">
          <li>Microcontrolador ESP32 con Wi-Fi nativo</li>
          <li>Sensor PZEM-004T V3.0 con aislamiento galvánico</li>
          <li>Relé de corte remoto y pantalla OLED de diagnóstico</li>
          <li>Sincronización en tiempo real con Firebase y Blynk</li>
        </ul>
      </div>

      <div class="service-detail">
        <div class="service-detail-head">
          <div class="ico-lg">03</div>
          <div>
            <h3>Desarrollo de software</h3>
            <span class="tag">App · Dashboard</span>
          </div>
        </div>
        <p class="desc">Construimos la capa de software que convierte los datos del sensor en información útil y accionable.</p>
        <ul class="feature-list">
          <li>App Energhost en Flutter/Dart, multiplataforma</li>
          <li>Alertas automáticas de consumo vampiro</li>
          <li>Control remoto de relé desde el celular</li>
          <li>Auditoría exportada a Google Sheets vía Apps Script</li>
        </ul>
      </div>

      <div class="service-detail">
        <div class="service-detail-head">
          <div class="ico-lg">04</div>
          <div>
            <h3>Consultoría en sustentabilidad</h3>
            <span class="tag">Impacto ambiental</span>
          </div>
        </div>
        <p class="desc">Traducimos los datos de consumo en recomendaciones concretas para reducir el gasto energético y la emisión de CO₂.</p>
        <ul class="feature-list">
          <li>Cálculo de huella de carbono por dispositivo o edificio</li>
          <li>Priorización de qué artefactos reemplazar o reprogramar</li>
          <li>Reportes pensados para instituciones educativas</li>
          <li>Seguimiento periódico de la reducción lograda</li>
        </ul>
      </div>

    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head" style="margin:0 auto 40px;text-align:center;max-width:560px;">
      <span class="eyebrow">Stack técnico</span>
      <h2>Las herramientas con las que construimos</h2>
    </div>
    <div class="tech-grid">
      <div class="tech-card"><div class="name">ESP32</div><div class="desc">Microcontrolador</div></div>
      <div class="tech-card"><div class="name">PZEM-004T</div><div class="desc">Sensor V3.0</div></div>
      <div class="tech-card"><div class="name">Firebase</div><div class="desc">Realtime DB</div></div>
      <div class="tech-card"><div class="name">Blynk 2.0</div><div class="desc">IoT cloud</div></div>
      <div class="tech-card"><div class="name">Flutter</div><div class="desc">App Energhost</div></div>
      <div class="tech-card"><div class="name">Fusion 360</div><div class="desc">Diseño 3D</div></div>
    </div>
  </div>
</section>

<section class="bg-navy">
  <div class="wrap" style="text-align:center;">
    <span class="eyebrow">¿Necesitás algo puntual?</span>
    <h2 style="margin-top:14px;font-size:30px;">Cada instalación es distinta. Hablemos de la tuya.</h2>
    <p style="max-width:520px;margin:14px auto 30px;">Contanos el espacio que querés monitorear y armamos una propuesta a medida.</p>
    <a href="/contacto" class="btn btn-primary" style="background:#fff;color:var(--navy-deep);">Solicitar auditoría →</a>
  </div>
</section>
