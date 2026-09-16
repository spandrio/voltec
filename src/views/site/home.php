<?php
/**
 * views/site/home.php
 * Renderizado por PhpRenderer en GET / dentro de layouts/site.php.
 */
?>
<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Consultora de energía IoT</span>
      <h1>Diseñamos, instalamos y <em>monitoreamos</em> la energía de tu organización.</h1>
      <p class="lead">Voltec Ergon es una consultora técnica que audita el consumo eléctrico de hogares e instituciones, instala sistemas de monitoreo IoT a medida y desarrolla el software para controlarlos — de punta a punta.</p>
      <div class="hero-actions">
        <a href="/servicios" class="btn btn-primary">Ver servicios</a>
        <a href="/trabajos" class="btn btn-ghost">Ver Eco Smart Grid →</a>
      </div>
      <div class="hero-stats">
        <div><div class="num">6</div><div class="lbl">Integrantes del equipo</div></div>
        <div><div class="num">3</div><div class="lbl">Comisiones técnicas</div></div>
        <div><div class="num">0.325</div><div class="lbl">kg CO₂ / kWh (factor AR)</div></div>
      </div>
    </div>

    <div class="dash-card">
      <div class="dash-top">
        <div class="name">ENERGHOST · Cocina — Heladera</div>
        <div class="live"><span class="dot"></span>EN VIVO</div>
      </div>
      <div class="dash-metrics">
        <div class="metric"><div class="l">Voltaje</div><div class="v">219.6 <span>V</span></div></div>
        <div class="metric"><div class="l">Corriente</div><div class="v">0.68 <span>A</span></div></div>
        <div class="metric"><div class="l">Potencia</div><div class="v">148 <span>W</span></div></div>
        <div class="metric"><div class="l">Hoy</div><div class="v">1.5 <span>kWh</span></div></div>
      </div>
      <div class="dash-chart">
        <div class="l">Consumo — últimas 12 h</div>
        <svg viewBox="0 0 300 60" width="100%" height="60" preserveAspectRatio="none">
          <polyline points="0,45 25,40 50,42 75,20 100,25 125,15 150,30 175,18 200,22 225,10 250,16 275,8 300,12"
            fill="none" stroke="#0FB88A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="dash-alert">
        <span>⚠️</span>
        <div><b>Consumo vampiro detectado.</b> El cargador del living lleva 2h 14min en standby a 3.2W. Tocá para apagar el relé.</div>
      </div>
    </div>
  </div>
</section>

<div class="stats-bar">
  <div class="wrap stats-grid">
    <div><div class="num">&lt;5W</div><div class="lbl">Umbral consumo vampiro</div></div>
    <div><div class="num">Wi-Fi</div><div class="lbl">Sincronización instantánea</div></div>
    <div><div class="num">5</div><div class="lbl">Meses de desarrollo (jun—oct)</div></div>
    <div><div class="num">1</div><div class="lbl">Sistema modular por artefacto</div></div>
  </div>
</div>

<section class="bg-white">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Lo que hacemos</span>
      <h2>Servicios pensados para que la energía deje de ser un número a fin de mes</h2>
      <p>Trabajamos de punta a punta: desde medir qué consume cada artefacto hasta entregar una app que te avisa y te deja actuar.</p>
    </div>
    <div class="service-grid">
      <div class="service-card">
        <div class="ico">01</div>
        <h4>Auditoría energética</h4>
        <p>Relevamos el consumo real de tu hogar o institución, artefacto por artefacto, y detectamos dónde se pierde energía.</p>
        <a href="/servicios" class="link">Ver más →</a>
      </div>
      <div class="service-card">
        <div class="ico">02</div>
        <h4>Instalación y monitoreo IoT</h4>
        <p>Instalamos módulos Eco Smart Grid (ESP32 + PZEM-004T) que miden voltaje, corriente y potencia en tiempo real.</p>
        <a href="/servicios" class="link">Ver más →</a>
      </div>
      <div class="service-card">
        <div class="ico">03</div>
        <h4>Desarrollo de software</h4>
        <p>Construimos dashboards y apps a medida — como Energhost en Flutter — conectados a Firebase para control remoto.</p>
        <a href="/servicios" class="link">Ver más →</a>
      </div>
      <div class="service-card">
        <div class="ico">04</div>
        <h4>Consultoría en sustentabilidad</h4>
        <p>Calculamos huella de carbono y proponemos acciones concretas para reducir el gasto energético y el impacto ambiental.</p>
        <a href="/servicios" class="link">Ver más →</a>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Cómo trabajamos</span>
      <h2>Un proceso claro, de la medición a la acción</h2>
    </div>
    <div class="process-grid">
      <div class="process-step">
        <div class="n">1</div>
        <h4>Diagnóstico</h4>
        <p>Relevamos el espacio y definimos qué artefactos monitorear según el consumo estimado.</p>
      </div>
      <div class="process-step">
        <div class="n">2</div>
        <h4>Diseño de la solución</h4>
        <p>Dimensionamos los módulos necesarios y definimos alertas, umbrales y reportes.</p>
      </div>
      <div class="process-step">
        <div class="n">3</div>
        <h4>Instalación y desarrollo</h4>
        <p>Montamos el hardware y configuramos la app Energhost para ese usuario o institución.</p>
      </div>
      <div class="process-step">
        <div class="n">4</div>
        <h4>Monitoreo y soporte</h4>
        <p>El sistema sigue midiendo, alertando y generando reportes — con acompañamiento nuestro.</p>
      </div>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="wrap">
    <div class="section-head" style="margin-bottom:34px;">
      <span class="eyebrow">Portafolio</span>
      <h2>El proyecto que más nos representa</h2>
    </div>
    <div class="case-card">
      <div>
        <div class="tags"><span>IoT</span><span>ESP32</span><span>Flutter</span><span>Firebase</span></div>
        <h3>Eco Smart Grid + App Energhost</h3>
        <p>Sistema modular que mide voltaje, corriente y potencia por artefacto, detecta consumo vampiro y permite apagar dispositivos de forma remota desde el celular.</p>
        <a href="/trabajos" class="btn btn-ghost">Ver caso completo →</a>
        <div class="case-stats">
          <div><div class="num">&lt;5W</div><div class="lbl">Umbral vampiro</div></div>
          <div><div class="num">0.49 kg</div><div class="lbl">CO₂/día — heladera</div></div>
        </div>
      </div>
      <div class="device-visual">
        <div class="ring r1"></div>
        <div class="ring r2"></div>
        <div class="core"><span>ESP32</span></div>
        <div class="float-tag t1">PZEM-004T</div>
        <div class="float-tag t2">Relé 220V</div>
        <div class="float-tag t3">OLED 0.96"</div>
      </div>
    </div>
  </div>
</section>

<section id="contacto">
  <div class="cta-band">
    <div>
      <h2>¿Listos para ver cuánto se está escapando?</h2>
      <p>Solicitá una auditoría energética y empezá a monitorear en tiempo real desde Energhost.</p>
    </div>
    <a href="/contacto" class="btn btn-primary">Solicitar auditoría energética</a>
  </div>
</section>
