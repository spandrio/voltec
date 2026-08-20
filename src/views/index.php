<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Voltec Ergon — Eco Smart Grid & Energhost</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>

:root{
  --navy-deep:#0A2E6B;
  --blue-brand:#0057D6;
  --blue-bright:#2B7FFF;
  --green-energy:#0FB88A;
  --amber-alert:#FFC72C;
  --bg-light:#F4F7FB;
  --bg-white:#FFFFFF;
  --ink:#0B1220;
  --ink-soft:#42506B;
  --line:#DDE4EF;
  --mono:'IBM Plex Mono', monospace;
  --display:'Space Grotesk', sans-serif;
  --body:'IBM Plex Sans', sans-serif;
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  font-family:var(--body);
  color:var(--ink);
  background:var(--bg-light);
  line-height:1.55;
  -webkit-font-smoothing:antialiased;
}
img,svg{display:block;max-width:100%;}
a{color:inherit;text-decoration:none;}
.wrap{max-width:1180px;margin:0 auto;padding:0 28px;}
.eyebrow{
  font-family:var(--mono);
  font-size:12.5px;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:var(--blue-brand);
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-weight:500;
}
.eyebrow::before{
  content:"";
  width:7px;height:7px;border-radius:50%;
  background:var(--green-energy);
  box-shadow:0 0 0 3px rgba(15,184,138,.18);
}
h1,h2,h3{font-family:var(--display);font-weight:700;letter-spacing:-0.01em;color:var(--navy-deep);}
.btn{
  font-family:var(--body);
  font-weight:600;
  font-size:15px;
  padding:13px 24px;
  border-radius:8px;
  display:inline-flex;
  align-items:center;
  gap:8px;
  border:1.5px solid transparent;
  cursor:pointer;
  transition:.18s ease;
}
.btn-primary{background:var(--navy-deep);color:#fff;}
.btn-primary:hover{background:var(--blue-brand);transform:translateY(-1px);}
.btn-ghost{border-color:var(--line);color:var(--navy-deep);background:#fff;}
.btn-ghost:hover{border-color:var(--blue-brand);color:var(--blue-brand);}

/* ---------- HEADER ---------- */
header{
  position:sticky;top:0;z-index:100;
  background:rgba(244,247,251,.88);
  backdrop-filter:blur(10px);
  border-bottom:1px solid var(--line);
}
.nav{display:flex;align-items:center;justify-content:space-between;padding:16px 28px;max-width:1180px;margin:0 auto;}
.brand{display:flex;align-items:center;gap:10px;font-family:var(--display);font-weight:700;font-size:17px;color:var(--navy-deep);}
.brand .mark{
  width:32px;height:32px;border-radius:7px;
  background:linear-gradient(135deg,var(--navy-deep),var(--blue-brand));
  position:relative;flex-shrink:0;
}
.brand .mark::after{
  content:"";position:absolute;inset:9px;
  border:2px solid var(--amber-alert);border-right-color:transparent;border-bottom-color:transparent;
  border-radius:2px;transform:rotate(45deg);
}
.brand small{display:block;font-family:var(--mono);font-weight:400;font-size:10px;letter-spacing:.08em;color:var(--ink-soft);text-transform:uppercase;margin-top:1px;}
.nav-links{display:flex;gap:32px;font-size:14.5px;font-weight:500;color:var(--ink-soft);}
.nav-links a:hover{color:var(--blue-brand);}
.nav-cta{display:flex;gap:10px;align-items:center;}
@media(max-width:880px){.nav-links{display:none;}}

/* ---------- HERO ---------- */
.hero{padding:76px 0 60px;position:relative;overflow:hidden;}
.hero::before{
  content:"";position:absolute;top:-180px;right:-180px;width:520px;height:520px;
  background:radial-gradient(circle,rgba(0,87,214,.10),transparent 70%);
  pointer-events:none;
}
.hero-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:56px;align-items:center;}
@media(max-width:960px){.hero-grid{grid-template-columns:1fr;}}
.hero h1{font-size:48px;line-height:1.08;margin:18px 0 20px;}
.hero h1 em{font-style:normal;color:var(--blue-brand);}
.hero p.lead{font-size:17px;color:var(--ink-soft);max-width:520px;margin-bottom:30px;}
.hero-actions{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:34px;}
.hero-stats{display:flex;gap:28px;flex-wrap:wrap;border-top:1px solid var(--line);padding-top:22px;}
.hero-stats div{font-family:var(--mono);}
.hero-stats .num{font-size:22px;font-weight:600;color:var(--navy-deep);}
.hero-stats .lbl{font-size:11.5px;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.06em;}

/* ---- Dashboard signature widget ---- */
.dash-card{
  background:var(--navy-deep);
  border-radius:18px;
  padding:26px;
  color:#fff;
  box-shadow:0 30px 60px -20px rgba(10,46,107,.45);
  position:relative;
}
.dash-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.dash-top .name{font-family:var(--mono);font-size:12.5px;letter-spacing:.06em;color:#AFC6EE;}
.dash-top .live{display:flex;align-items:center;gap:6px;font-family:var(--mono);font-size:11px;color:var(--green-energy);}
.dash-top .live .dot{width:6px;height:6px;background:var(--green-energy);border-radius:50%;animation:pulse 1.6s infinite;}
@keyframes pulse{0%,100%{opacity:1;}50%{opacity:.25;}}
.dash-metrics{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;}
.metric{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:14px 16px;}
.metric .l{font-size:11px;color:#9FB6E0;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
.metric .v{font-family:var(--mono);font-size:22px;font-weight:600;}
.metric .v span{font-size:12px;color:#9FB6E0;font-weight:400;}
.dash-chart{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;margin-bottom:14px;}
.dash-chart .l{font-size:11px;color:#9FB6E0;text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px;}
.dash-alert{
  display:flex;gap:10px;align-items:flex-start;
  background:rgba(255,199,44,.12);
  border:1px solid rgba(255,199,44,.35);
  border-radius:10px;padding:12px 14px;font-size:12.5px;color:#FFE9AE;
}
.dash-alert b{color:var(--amber-alert);}

/* ---------- SECTION GENERIC ---------- */
section{padding:88px 0;}
.section-head{max-width:640px;margin-bottom:48px;}
.section-head h2{font-size:34px;margin-top:14px;}
.section-head p{color:var(--ink-soft);font-size:16px;margin-top:14px;}
.bg-white{background:var(--bg-white);}
.bg-navy{background:var(--navy-deep);color:#fff;}
.bg-navy .eyebrow{color:var(--amber-alert);}
.bg-navy .eyebrow::before{background:var(--amber-alert);box-shadow:0 0 0 3px rgba(255,199,44,.18);}
.bg-navy h2{color:#fff;}
.bg-navy p{color:#B9C9E6;}

/* ---------- PROBLEM ---------- */
.problem-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:50px;align-items:start;}
@media(max-width:900px){.problem-grid{grid-template-columns:1fr;}}
.factura{background:var(--bg-white);border:1px solid var(--line);border-radius:14px;padding:26px 28px;}
.factura .row{display:flex;justify-content:space-between;padding:11px 0;border-bottom:1px dashed var(--line);font-size:14.5px;}
.factura .row:last-child{border-bottom:none;}
.factura .row.total{font-weight:700;color:var(--navy-deep);font-family:var(--mono);}
.factura .tag{font-family:var(--mono);font-size:11px;color:#B0392E;background:#FBE6E3;padding:3px 8px;border-radius:5px;}
.problem-list{display:flex;flex-direction:column;gap:22px;}
.problem-item{display:flex;gap:16px;}
.problem-item .ico{
  width:40px;height:40px;flex-shrink:0;border-radius:9px;
  background:rgba(0,87,214,.08);display:flex;align-items:center;justify-content:center;
  color:var(--blue-brand);font-family:var(--mono);font-weight:600;
}
.problem-item h4{font-family:var(--display);font-size:16px;margin-bottom:4px;color:var(--navy-deep);}
.problem-item p{font-size:14.5px;color:var(--ink-soft);}

/* ---------- HOW IT WORKS (flow) ---------- */
.flow{display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative;}
@media(max-width:960px){.flow{grid-template-columns:1fr;gap:18px;}}
.flow-step{position:relative;padding:0 14px;text-align:left;}
.flow-step .n{
  font-family:var(--mono);font-size:12px;color:var(--blue-brand);
  border:1.5px solid var(--blue-brand);width:30px;height:30px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;margin-bottom:16px;background:var(--bg-white);position:relative;z-index:2;
}
.flow-step h4{font-size:15px;font-family:var(--display);color:var(--navy-deep);margin-bottom:6px;}
.flow-step p{font-size:13px;color:var(--ink-soft);}
.flow::before{
  content:"";position:absolute;top:15px;left:8%;right:8%;height:1.5px;
  background:repeating-linear-gradient(90deg,var(--line) 0 8px,transparent 8px 14px);
  z-index:1;
}
@media(max-width:960px){.flow::before{display:none;}}

/* ---------- PRODUCT ---------- */
.product-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;}
@media(max-width:900px){.product-grid{grid-template-columns:1fr;}}
.spec-list{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:26px;}
.spec{border:1px solid var(--line);border-radius:10px;padding:14px 16px;background:var(--bg-white);}
.spec .k{font-family:var(--mono);font-size:11px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;}
.spec .v{font-size:13.5px;color:var(--ink);font-weight:500;}
.device-visual{
  aspect-ratio:1/1;border-radius:20px;
  background:linear-gradient(160deg,var(--navy-deep),var(--blue-brand) 120%);
  position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;
}
.device-visual .ring{position:absolute;border:1px solid rgba(255,255,255,.14);border-radius:50%;}
.device-visual .ring.r1{width:70%;height:70%;}
.device-visual .ring.r2{width:48%;height:48%;}
.device-visual .core{
  width:26%;height:26%;background:#fff;border-radius:14px;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 20px 40px rgba(0,0,0,.25);
}
.device-visual .core span{font-family:var(--mono);color:var(--navy-deep);font-weight:700;font-size:13px;}
.device-visual .float-tag{
  position:absolute;background:rgba(255,255,255,.95);color:var(--navy-deep);
  font-family:var(--mono);font-size:11px;padding:6px 10px;border-radius:7px;font-weight:600;
  box-shadow:0 10px 20px rgba(0,0,0,.15);
}
.float-tag.t1{top:14%;left:10%;}
.float-tag.t2{bottom:16%;right:8%;}
.float-tag.t3{top:50%;right:2%;}

/* ---------- IMPACT / CALCULATOR ---------- */
.impact-grid{display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;}
@media(max-width:900px){.impact-grid{grid-template-columns:1fr;}}
.calc{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);
  border-radius:16px;padding:30px;
}
.calc label{display:block;font-family:var(--mono);font-size:11.5px;color:#9FB6E0;text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px;}
.calc input[type=range]{width:100%;accent-color:var(--green-energy);margin-bottom:8px;}
.calc .val-row{display:flex;justify-content:space-between;font-family:var(--mono);font-size:13px;color:#B9C9E6;margin-bottom:24px;}
.calc .val-row b{color:#fff;font-size:16px;}
.calc-result{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.calc-result .box{background:rgba(255,255,255,.08);border-radius:12px;padding:16px;}
.calc-result .box .l{font-size:11px;color:#9FB6E0;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
.calc-result .box .v{font-family:var(--mono);font-size:24px;font-weight:600;color:var(--green-energy);}
.calc-result .box.amber .v{color:var(--amber-alert);}
.impact-copy .stat-row{display:flex;gap:30px;margin-top:30px;flex-wrap:wrap;}
.impact-copy .stat-row div{font-family:var(--mono);}
.impact-copy .stat-row .num{font-size:28px;font-weight:600;color:#fff;}
.impact-copy .stat-row .lbl{font-size:11.5px;color:#9FB6E0;text-transform:uppercase;}

/* ---------- TEAM ---------- */
.team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
@media(max-width:860px){.team-grid{grid-template-columns:1fr;}}
.team-card{background:var(--bg-white);border:1px solid var(--line);border-radius:14px;padding:26px;}
.team-card .tag{
  display:inline-block;font-family:var(--mono);font-size:11px;padding:4px 10px;border-radius:6px;
  background:rgba(0,87,214,.08);color:var(--blue-brand);margin-bottom:16px;font-weight:600;
}
.team-card h3{font-size:19px;margin-bottom:10px;}
.team-card ul{margin-top:14px;padding-left:18px;color:var(--ink-soft);font-size:13.5px;}
.team-card ul li{margin-bottom:6px;}

/* ---------- TIMELINE ---------- */
.timeline{display:flex;flex-direction:column;border-left:2px solid var(--line);margin-left:8px;}
.t-item{position:relative;padding:0 0 40px 32px;}
.t-item:last-child{padding-bottom:0;}
.t-item::before{
  content:"";position:absolute;left:-7px;top:2px;width:12px;height:12px;border-radius:50%;
  background:var(--bg-light);border:2.5px solid var(--blue-brand);
}
.t-item .when{font-family:var(--mono);font-size:12px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:5px;}
.t-item h4{font-family:var(--display);font-size:17px;color:var(--navy-deep);margin-bottom:6px;}
.t-item p{font-size:14px;color:var(--ink-soft);max-width:560px;}

/* ---------- CTA / FOOTER ---------- */
.cta-band{
  background:linear-gradient(120deg,var(--navy-deep),var(--blue-brand));
  border-radius:22px;padding:56px;margin:0 28px;
  display:flex;justify-content:space-between;align-items:center;gap:30px;flex-wrap:wrap;color:#fff;
  max-width:1180px;margin-left:auto;margin-right:auto;
}
.cta-band h2{color:#fff;font-size:28px;max-width:460px;}
.cta-band p{color:#CFE0FF;margin-top:10px;max-width:460px;}
.cta-band .btn-primary{background:#fff;color:var(--navy-deep);}
.cta-band .btn-primary:hover{background:var(--amber-alert);color:var(--navy-deep);}

footer{padding:56px 0 30px;}
.footer-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr;gap:40px;padding-bottom:36px;border-bottom:1px solid var(--line);}
@media(max-width:800px){.footer-grid{grid-template-columns:1fr 1fr;}}
.footer-grid h5{font-family:var(--mono);font-size:11.5px;text-transform:uppercase;letter-spacing:.06em;color:var(--ink-soft);margin-bottom:14px;}
.footer-grid a,.footer-grid li{display:block;font-size:14px;color:var(--ink-soft);margin-bottom:9px;}
.footer-grid a:hover{color:var(--blue-brand);}
.footer-bottom{display:flex;justify-content:space-between;padding-top:22px;font-size:12.5px;color:var(--ink-soft);flex-wrap:wrap;gap:10px;}

@media(max-width:600px){
  .hero h1{font-size:34px;}
  .cta-band{padding:34px 24px;}
  section{padding:60px 0;}
}
</style>
</head>
<body>

<header>
  <div class="nav">
    <div class="brand">
      <div class="mark"></div>
      <div>VOLTEC ERGON<small>Consultora de energía IoT</small></div>
    </div>
    <nav class="nav-links">
      <a href="#producto">Producto</a>
      <a href="#funcionamiento">Cómo funciona</a>
      <a href="#impacto">Impacto ambiental</a>
      <a href="#equipo">Equipo</a>
      <a href="#cronograma">Cronograma</a>
    </nav>
    <div class="nav-cta">
      <a href="#contacto" class="btn btn-primary">Solicitar auditoría</a>
    </div>
  </div>
</header>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Eco Smart Grid + App Energhost</span>
      <h1>La energía que se<br>escapa, ahora <em>se ve</em>.</h1>
      <p class="lead">Voltec Ergon desarrolló un sistema de monitoreo eléctrico en tiempo real que detecta consumo vampiro, calcula tu huella de carbono y te deja apagar tus artefactos desde el celular — antes de que llegue la factura.</p>
      <div class="hero-actions">
        <a href="#producto" class="btn btn-primary">Ver el dispositivo</a>
        <a href="#funcionamiento" class="btn btn-ghost">Cómo funciona →</a>
      </div>
      <div class="hero-stats">
        <div><div class="num">&lt;5W</div><div class="lbl">Umbral consumo vampiro</div></div>
        <div><div class="num">0.325</div><div class="lbl">kg CO₂ por kWh (AR)</div></div>
        <div><div class="num">Wi-Fi</div><div class="lbl">Sincronización instantánea</div></div>
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

<section class="bg-white">
  <div class="wrap problem-grid">
    <div>
      <div class="section-head" style="margin-bottom:34px;">
        <span class="eyebrow">El problema</span>
        <h2>Tu factura te dice cuánto pagaste. No te dice por qué.</h2>
        <p>Un número acumulado a fin de mes no permite identificar qué artefacto gasta de más, ni cuánto se pierde en aparatos que "están apagados" pero siguen consumiendo.</p>
      </div>
      <div class="factura">
        <div class="row"><span>Factura eléctrica — Agosto</span><span class="tag">Sin detalle</span></div>
        <div class="row"><span>Consumo total</span><span>312 kWh</span></div>
        <div class="row"><span>¿Qué artefacto consumió más?</span><span>—</span></div>
        <div class="row"><span>¿Cuánto se perdió en standby?</span><span>—</span></div>
        <div class="row total"><span>Total a pagar</span><span>$ 84.300</span></div>
      </div>
    </div>
    <div class="problem-list">
      <div class="problem-item">
        <div class="ico">01</div>
        <div><h4>Consumo vampiro invisible</h4><p>Dispositivos "apagados" que siguen tomando corriente de la red durante horas, todos los días del mes.</p></div>
      </div>
      <div class="problem-item">
        <div class="ico">02</div>
        <div><h4>Cero trazabilidad por artefacto</h4><p>La factura mensual agrupa todo el consumo del hogar en un solo número, sin desglose posible.</p></div>
      </div>
      <div class="problem-item">
        <div class="ico">03</div>
        <div><h4>Impacto ambiental invisible</h4><p>Nadie ve, en el momento, cuánto CO₂ genera dejar un electrodoméstico enchufado de más.</p></div>
      </div>
    </div>
  </div>
</section>

<section id="funcionamiento">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Arquitectura del sistema</span>
      <h2>Del enchufe a tu bolsillo, en milisegundos</h2>
      <p>El sensor mide, el ESP32 transmite, la nube sincroniza y Energhost reacciona — sin que el usuario tenga que recargar nada.</p>
    </div>
    <div class="flow">
      <div class="flow-step">
        <div class="n">1</div>
        <h4>Sensor PZEM-004T</h4>
        <p>Mide voltaje, corriente, potencia y energía acumulada del artefacto conectado, con aislamiento galvánico.</p>
      </div>
      <div class="flow-step">
        <div class="n">2</div>
        <h4>Microcontrolador ESP32</h4>
        <p>Procesa las lecturas y las sube por Wi-Fi a Firebase Realtime Database y Blynk.</p>
      </div>
      <div class="flow-step">
        <div class="n">3</div>
        <h4>Firebase + Google Sheets</h4>
        <p>Firebase sincroniza en tiempo real; Apps Script vuelca cada lectura a una planilla de auditoría accesible por QR.</p>
      </div>
      <div class="flow-step">
        <div class="n">4</div>
        <h4>App Energhost (Flutter)</h4>
        <p>Escucha los cambios en Firebase y actualiza el dashboard al instante, sin recargar la pantalla.</p>
      </div>
      <div class="flow-step">
        <div class="n">5</div>
        <h4>Control remoto</h4>
        <p>El usuario apaga un relé desde la app; el ESP32 detecta el cambio y corta la corriente en milisegundos.</p>
      </div>
    </div>
  </div>
</section>

<section id="producto" class="bg-white">
  <div class="wrap product-grid">
    <div class="device-visual">
      <div class="ring r1"></div>
      <div class="ring r2"></div>
      <div class="core"><span>ESP32</span></div>
      <div class="float-tag t1">PZEM-004T</div>
      <div class="float-tag t2">Relé 220V</div>
      <div class="float-tag t3">OLED 0.96"</div>
    </div>
    <div>
      <span class="eyebrow">Hardware</span>
      <h2 style="font-size:32px;margin:14px 0 14px;">Eco Smart Grid</h2>
      <p style="color:var(--ink-soft);font-size:15.5px;">Un módulo inteligente por artefacto: mide, decide y corta el suministro, con carcasa propia impresa en 3D y pantalla local de diagnóstico.</p>
      <div class="spec-list">
        <div class="spec"><div class="k">Microcontrolador</div><div class="v">ESP32, Wi-Fi nativo</div></div>
        <div class="spec"><div class="k">Sensor</div><div class="v">PZEM-004T V3.0</div></div>
        <div class="spec"><div class="k">Actuador</div><div class="v">Módulo relé de alta capacidad</div></div>
        <div class="spec"><div class="k">Pantalla local</div><div class="v">OLED 0.96"</div></div>
        <div class="spec"><div class="k">Carcasa</div><div class="v">Diseño CAD, impresión 3D</div></div>
        <div class="spec"><div class="k">Identificación</div><div class="v">Fichas intercambiables multicolor</div></div>
      </div>
    </div>
  </div>
</section>

<section id="impacto" class="bg-navy">
  <div class="wrap impact-grid">
    <div class="impact-copy">
      <span class="eyebrow">Huella de carbono</span>
      <h2 style="font-size:32px;margin:14px 0 14px;">Cada kWh que ahorrás, se traduce en CO₂ que no emitís</h2>
      <p>Energhost calcula tu huella de carbono usando el factor de emisión promedio de la red eléctrica argentina: 0.325 kg de CO₂ por cada kWh consumido.</p>
      <div class="stat-row">
        <div><div class="num">0.49 kg</div><div class="lbl">CO₂/día — heladera típica</div></div>
        <div><div class="num">0.10 kg</div><div class="lbl">CO₂ — 1h de licuadora</div></div>
      </div>
    </div>
    <div class="calc">
      <label for="kwh">Simulá tu consumo (kWh este mes)</label>
      <input type="range" id="kwh" min="10" max="500" value="150">
      <div class="val-row"><span>Consumo estimado</span><b id="kwhVal">150 kWh</b></div>
      <div class="calc-result">
        <div class="box"><div class="l">Huella de carbono</div><div class="v" id="co2Val">48.75 kg</div></div>
        <div class="box amber"><div class="l">Costo estimado</div><div class="v" id="costVal">$ 40.500</div></div>
      </div>
    </div>
  </div>
</section>

<section id="equipo" class="bg-white">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Organización</span>
      <h2>Tres comisiones, un mismo sistema</h2>
      <p>Seis integrantes divididos por especialidad técnica, coordinados desde la consultora Voltec Ergon.</p>
    </div>
    <div class="team-grid">
      <div class="team-card">
        <span class="tag">Comisión</span>
        <h3>Software</h3>
        <p style="color:var(--ink-soft);font-size:14px;">Programación del ESP32, configuración de Firebase y Blynk, y desarrollo de la lógica del sistema.</p>
        <ul>
          <li>Consola Blynk 2.0 y tokens de conexión</li>
          <li>Apps Script → Google Sheets</li>
          <li>App Energhost en Flutter/Dart</li>
        </ul>
      </div>
      <div class="team-card">
        <span class="tag">Comisión</span>
        <h3>Hardware</h3>
        <p style="color:var(--ink-soft);font-size:14px;">Montaje físico, conexiones eléctricas, soldadura y verificaciones de seguridad.</p>
        <ul>
          <li>Ensamblaje ESP32 + PZEM-004T + relés</li>
          <li>Verificación con tester y multímetro</li>
          <li>Cableado definitivo del sistema</li>
        </ul>
      </div>
      <div class="team-card">
        <span class="tag">Comisión</span>
        <h3>Diseño y presentación</h3>
        <p style="color:var(--ink-soft);font-size:14px;">Modelado e impresión 3D, estética del stand y preparación de la exposición.</p>
        <ul>
          <li>Carcasas en Tinkercad / Fusion 360</li>
          <li>Impresión multicolor con Kuttercraft</li>
          <li>Banner, QR y defensa oral</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="cronograma">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Cronograma</span>
      <h2>Junio a diciembre</h2>
    </div>
    <div class="timeline">
      <div class="t-item">
        <div class="when">Junio — Julio</div>
        <h4>Investigación y primeras pruebas</h4>
        <p>Configuración de entornos y primeras pruebas de comunicación entre sensores y microcontroladores.</p>
      </div>
      <div class="t-item">
        <div class="when">Agosto — Septiembre</div>
        <h4>Fabricación y ensamblaje</h4>
        <p>Impresión de piezas, ensamblaje físico y cableado definitivo del sistema.</p>
      </div>
      <div class="t-item">
        <div class="when">Octubre</div>
        <h4>Auditoría energética real</h4>
        <p>Medición de consumos en oficinas, laboratorios y espacios institucionales de la escuela.</p>
      </div>
      <div class="t-item">
        <div class="when">Noviembre — Diciembre</div>
        <h4>Puesta en escena</h4>
        <p>Preparación estética del stand, banner, simulacros de defensa oral y optimización final del prototipo.</p>
      </div>
    </div>
  </div>
</section>

<section id="contacto">
  <div class="cta-band">
    <div>
      <h2>¿Listos para ver cuánto se está escapando?</h2>
      <p>Solicitá una auditoría energética con Eco Smart Grid y empezá a monitorear en tiempo real desde Energhost.</p>
    </div>
    <a href="#" class="btn btn-primary">Solicitar auditoría energética</a>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <div class="brand" style="margin-bottom:14px;">
          <div class="mark"></div>
          <div>VOLTEC ERGON<small>Consultora de energía IoT</small></div>
        </div>
        <p style="font-size:13.5px;color:var(--ink-soft);max-width:280px;">Monitoreo, análisis y optimización del consumo energético residencial e institucional.</p>
      </div>
      <div>
        <h5>Producto</h5>
        <a href="#producto">Eco Smart Grid</a>
        <a href="#funcionamiento">Cómo funciona</a>
        <a href="#impacto">Huella de carbono</a>
      </div>
      <div>
        <h5>Consultora</h5>
        <a href="#equipo">Equipo</a>
        <a href="#cronograma">Cronograma</a>
        <a href="#contacto">Contacto</a>
      </div>
      <div>
        <h5>App</h5>
        <a href="#">Energhost — Dashboard</a>
        <a href="#">Alertas de consumo</a>
        <a href="#">Control remoto</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Voltec Ergon. Proyecto técnico — Eco Smart Grid / Energhost.</span>
      <span>Factor de emisión: 0.325 kgCO₂/kWh (red eléctrica argentina)</span>
    </div>
  </div>
</footer>

<script>
const kwhInput = document.getElementById('kwh');
const kwhVal = document.getElementById('kwhVal');
const co2Val = document.getElementById('co2Val');
const costVal = document.getElementById('costVal');
const TARIFA = 270; // $/kWh estimado

function updateCalc(){
  const kwh = parseFloat(kwhInput.value);
  kwhVal.textContent = kwh + ' kWh';
  co2Val.textContent = (kwh * 0.325).toFixed(2) + ' kg';
  costVal.textContent = '$ ' + Math.round(kwh * TARIFA).toLocaleString('es-AR');
}
kwhInput.addEventListener('input', updateCalc);
updateCalc();

// Live-feel jitter on hero dashboard numbers
const metrics = document.querySelectorAll('.dash-metrics .v');
setInterval(() => {
  if(metrics.length < 3) return;
  const base = [219.6, 0.68, 148];
  metrics[0].innerHTML = (base[0] + (Math.random()-0.5)*0.6).toFixed(1) + ' <span>V</span>';
  metrics[1].innerHTML = (base[1] + (Math.random()-0.5)*0.05).toFixed(2) + ' <span>A</span>';
  metrics[2].innerHTML = Math.round(base[2] + (Math.random()-0.5)*6) + ' <span>W</span>';
}, 2200);
</script>
