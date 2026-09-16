<?php
/**
 * views/layouts/site.php
 * Layout compartido por las páginas públicas de la consultora (home, servicios, equipo, trabajos, contacto).
 * Variables disponibles: $content (html ya renderizado de la vista), $active (string, ruta activa para resaltar el nav).
 */
$active = $active ?? '';
$navItems = [
  '/' => 'Inicio',
  '/servicios' => 'Servicios',
  '/equipo' => 'Equipo',
  '/trabajos' => 'Trabajos',
  '/contacto' => 'Contacto',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= html($title ?? 'Voltec Ergon') ?></title>
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
.nav-links{display:flex;gap:30px;font-size:14.5px;font-weight:500;color:var(--ink-soft);}
.nav-links a{position:relative;padding:4px 0;}
.nav-links a:hover{color:var(--blue-brand);}
.nav-links a.active{color:var(--navy-deep);font-weight:600;}
.nav-links a.active::after{
  content:"";position:absolute;left:0;right:0;bottom:-4px;height:2px;background:var(--green-energy);border-radius:2px;
}
.nav-cta{display:flex;gap:10px;align-items:center;}
@media(max-width:940px){.nav-links{display:none;}}

/* ---------- SECTION GENERIC ---------- */
section{padding:88px 0;}
.page-header{padding:64px 0 20px;}
.section-head{max-width:640px;margin-bottom:48px;}
.section-head h2{font-size:34px;margin-top:14px;}
.section-head p{color:var(--ink-soft);font-size:16px;margin-top:14px;}
.page-header h1{font-size:42px;margin-top:16px;line-height:1.1;}
.page-header p.lead{color:var(--ink-soft);font-size:17px;max-width:640px;margin-top:16px;}
.bg-white{background:var(--bg-white);}
.bg-navy{background:var(--navy-deep);color:#fff;}
.bg-navy .eyebrow{color:var(--amber-alert);}
.bg-navy .eyebrow::before{background:var(--amber-alert);box-shadow:0 0 0 3px rgba(255,199,44,.18);}
.bg-navy h2,.bg-navy h1{color:#fff;}
.bg-navy p{color:#B9C9E6;}

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

/* ---------- STATS BAR ---------- */
.stats-bar{background:var(--bg-white);border-top:1px solid var(--line);border-bottom:1px solid var(--line);padding:34px 0;}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;text-align:center;}
@media(max-width:760px){.stats-grid{grid-template-columns:1fr 1fr;}}
.stats-grid .num{font-family:var(--mono);font-size:28px;font-weight:600;color:var(--navy-deep);}
.stats-grid .lbl{font-size:12px;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.05em;margin-top:4px;}

/* ---------- SERVICE CARDS ---------- */
.service-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;}
@media(max-width:960px){.service-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.service-grid{grid-template-columns:1fr;}}
.service-card{background:var(--bg-white);border:1px solid var(--line);border-radius:14px;padding:26px;transition:.18s;}
.service-card:hover{border-color:var(--blue-brand);box-shadow:0 18px 34px -22px rgba(0,87,214,.4);transform:translateY(-2px);}
.service-card .ico{
  width:42px;height:42px;border-radius:10px;background:rgba(0,87,214,.08);color:var(--blue-brand);
  display:flex;align-items:center;justify-content:center;font-family:var(--mono);font-weight:700;font-size:15px;margin-bottom:16px;
}
.service-card h4{font-size:17px;margin-bottom:8px;}
.service-card p{font-size:14px;color:var(--ink-soft);margin-bottom:14px;}
.service-card .link{font-family:var(--mono);font-size:12.5px;color:var(--blue-brand);font-weight:600;}

.service-detail{background:var(--bg-white);border:1px solid var(--line);border-radius:16px;padding:32px;}
.service-detail-head{display:flex;gap:16px;align-items:flex-start;margin-bottom:16px;}
.service-detail .ico-lg{
  width:52px;height:52px;border-radius:12px;background:rgba(0,87,214,.08);color:var(--blue-brand);
  display:flex;align-items:center;justify-content:center;font-family:var(--mono);font-weight:700;font-size:18px;flex-shrink:0;
}
.service-detail h3{font-size:20px;}
.service-detail .tag{font-family:var(--mono);font-size:11px;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.05em;}
.service-detail p.desc{color:var(--ink-soft);font-size:14.5px;margin-bottom:16px;}
.feature-list{list-style:none;display:flex;flex-direction:column;gap:9px;}
.feature-list li{font-size:14px;color:var(--ink);display:flex;gap:8px;}
.feature-list li::before{content:"✓";color:var(--green-energy);font-weight:700;flex-shrink:0;}

/* ---------- PROCESS ---------- */
.process-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:26px;}
@media(max-width:900px){.process-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:560px){.process-grid{grid-template-columns:1fr;}}
.process-step .n{
  font-family:var(--mono);font-size:13px;color:var(--blue-brand);
  border:1.5px solid var(--blue-brand);width:34px;height:34px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;margin-bottom:16px;background:var(--bg-white);
}
.process-step h4{font-size:16px;margin-bottom:6px;}
.process-step p{font-size:13.5px;color:var(--ink-soft);}

/* ---------- PORTFOLIO / CASE STUDY ---------- */
.case-card{background:var(--bg-white);border:1px solid var(--line);border-radius:18px;padding:36px;display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;}
@media(max-width:900px){.case-card{grid-template-columns:1fr;}}
.case-card .tags{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px;}
.case-card .tags span{font-family:var(--mono);font-size:11px;background:rgba(0,87,214,.08);color:var(--blue-brand);padding:4px 9px;border-radius:6px;font-weight:600;}
.case-card h3{font-size:24px;margin-bottom:12px;}
.case-card p{color:var(--ink-soft);font-size:15px;margin-bottom:16px;}
.case-stats{display:flex;gap:26px;flex-wrap:wrap;margin-top:18px;}
.case-stats div{font-family:var(--mono);}
.case-stats .num{font-size:19px;font-weight:600;color:var(--navy-deep);}
.case-stats .lbl{font-size:11px;color:var(--ink-soft);text-transform:uppercase;}

/* ---------- PRODUCT DEVICE VISUAL ---------- */
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

/* ---------- TECH GRID ---------- */
.tech-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:14px;}
@media(max-width:900px){.tech-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:520px){.tech-grid{grid-template-columns:1fr 1fr;}}
.tech-card{background:var(--bg-white);border:1px solid var(--line);border-radius:12px;padding:16px 10px;text-align:center;}
.tech-card .name{font-family:var(--display);font-weight:600;font-size:13px;color:var(--navy-deep);}
.tech-card .desc{font-size:11px;color:var(--ink-soft);margin-top:3px;}

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

/* ---------- FAQ ---------- */
.faq-list{display:flex;flex-direction:column;gap:12px;max-width:760px;}
.faq-item{background:var(--bg-white);border:1px solid var(--line);border-radius:12px;overflow:hidden;}
.faq-item summary{padding:18px 22px;font-family:var(--display);font-weight:600;font-size:15px;color:var(--navy-deep);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:12px;}
.faq-item summary::-webkit-details-marker{display:none;}
.faq-item summary::after{content:"+";font-family:var(--mono);font-size:18px;color:var(--blue-brand);}
.faq-item[open] summary::after{content:"–";}
.faq-item .a{padding:0 22px 20px;color:var(--ink-soft);font-size:14px;}

/* ---------- CONTACT ---------- */
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:start;}
@media(max-width:900px){.contact-grid{grid-template-columns:1fr;}}
.contact-card{background:var(--bg-white);border:1px solid var(--line);border-radius:14px;padding:22px 24px;display:flex;gap:14px;align-items:flex-start;margin-bottom:14px;}
.contact-card .ico{width:38px;height:38px;border-radius:9px;background:rgba(0,87,214,.08);color:var(--blue-brand);display:flex;align-items:center;justify-content:center;font-family:var(--mono);font-weight:700;flex-shrink:0;}
.contact-card h5{font-size:14.5px;color:var(--navy-deep);margin-bottom:3px;}
.contact-card p, .contact-card a{font-size:13.5px;color:var(--ink-soft);}
.contact-form{background:var(--bg-white);border:1px solid var(--line);border-radius:16px;padding:30px;}
.field{margin-bottom:18px;}
.field label{display:block;font-family:var(--mono);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;color:var(--ink-soft);margin-bottom:7px;}
.field input,.field select,.field textarea{
  width:100%;border:1.5px solid var(--line);border-radius:8px;padding:11px 13px;font-family:var(--body);font-size:14px;color:var(--ink);background:var(--bg-light);
}
.field input:focus,.field select:focus,.field textarea:focus{outline:none;border-color:var(--blue-brand);}
.field textarea{resize:vertical;min-height:100px;}

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
.footer-grid{display:grid;grid-template-columns:1.2fr 1fr 1fr 1fr 1fr;gap:40px;padding-bottom:36px;border-bottom:1px solid var(--line);}
@media(max-width:900px){.footer-grid{grid-template-columns:1fr 1fr;}}
.footer-grid h5{font-family:var(--mono);font-size:11.5px;text-transform:uppercase;letter-spacing:.06em;color:var(--ink-soft);margin-bottom:14px;}
.footer-grid a,.footer-grid li{display:block;font-size:14px;color:var(--ink-soft);margin-bottom:9px;}
.footer-grid a:hover{color:var(--blue-brand);}
.footer-bottom{display:flex;justify-content:space-between;padding-top:22px;font-size:12.5px;color:var(--ink-soft);flex-wrap:wrap;gap:10px;}

@media(max-width:600px){
  .hero h1{font-size:34px;}
  .page-header h1{font-size:30px;}
  .cta-band{padding:34px 24px;}
  section{padding:60px 0;}
  .case-card{padding:26px;}
}
</style>
</head>
<body>

<header>
  <div class="nav">
    <a href="/" style="text-decoration:none;">
      <div class="brand">
        <div class="mark"></div>
        <div>VOLTEC ERGON<small>Consultora de energía IoT</small></div>
      </div>
    </a>
    <nav class="nav-links">
      <?php foreach ($navItems as $href => $label): ?>
        <a href="<?= html($href) ?>" class="<?= $active === $href ? 'active' : '' ?>"><?= html($label) ?></a>
      <?php endforeach; ?>
      <a href="/entidad">Catálogo de módulos</a>
    </nav>
    <div class="nav-cta">
      <a href="/auth/login" class="btn btn-ghost">Ingresar</a>
      <a href="/contacto" class="btn btn-primary">Solicitar auditoría</a>
    </div>
  </div>
</header>

<?= $content ?>

<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <div class="brand" style="margin-bottom:14px;">
          <div class="mark"></div>
          <div>VOLTEC ERGON<small>Consultora de energía IoT</small></div>
        </div>
        <p style="font-size:13.5px;color:var(--ink-soft);max-width:280px;">Diagnóstico, instalación y monitoreo del consumo energético residencial e institucional.</p>
      </div>
      <div>
        <h5>Consultora</h5>
        <a href="/servicios">Servicios</a>
        <a href="/equipo">Equipo</a>
        <a href="/trabajos">Trabajos</a>
        <a href="/contacto">Contacto</a>
      </div>
      <div>
        <h5>Producto</h5>
        <a href="/trabajos">Eco Smart Grid</a>
        <a href="/trabajos">App Energhost</a>
        <a href="/servicios">Huella de carbono</a>
      </div>
      <div>
        <h5>Institucional</h5>
        <a href="#">E.E.S.T. N°4 de Berazategui</a>
        <a href="#">Fundación YPF</a>
      </div>
      <div>
        <h5>Panel interno</h5>
        <a href="/entidad">Catálogo de módulos</a>
        <a href="/auth/login">Iniciar sesión</a>
        <a href="/auth/register">Crear cuenta</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Voltec Ergon. Proyecto técnico — Eco Smart Grid / Energhost.</span>
      <span>Factor de emisión: 0.325 kgCO₂/kWh (red eléctrica argentina)</span>
    </div>
  </div>
</footer>

</body>
</html>
