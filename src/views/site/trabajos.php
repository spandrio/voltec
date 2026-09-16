<?php
/**
 * views/site/trabajos.php
 * Renderizado por PhpRenderer en GET /trabajos dentro de layouts/site.php.
 */
?>
<section class="page-header">
  <div class="wrap">
    <span class="eyebrow">Trabajos</span>
    <h1>Eco Smart Grid + App Energhost</h1>
    <p class="lead">Nuestro caso insignia: un sistema IoT modular para el monitoreo, análisis y optimización del consumo energético en tiempo real.</p>
  </div>
</section>

<section class="bg-white" style="padding-top:20px;">
  <div class="wrap problem-grid" style="display:grid;grid-template-columns:1.1fr .9fr;gap:50px;align-items:start;">
    <div>
      <div class="section-head" style="margin-bottom:34px;">
        <span class="eyebrow">El problema</span>
        <h2>Tu factura te dice cuánto pagaste. No te dice por qué.</h2>
        <p>Un número acumulado a fin de mes no permite identificar qué artefacto gasta de más, ni cuánto se pierde en aparatos que "están apagados" pero siguen consumiendo.</p>
      </div>
      <div style="background:var(--bg-white);border:1px solid var(--line);border-radius:14px;padding:26px 28px;">
        <div style="display:flex;justify-content:space-between;padding:11px 0;border-bottom:1px dashed var(--line);font-size:14.5px;"><span>Factura eléctrica — Agosto</span><span style="font-family:var(--mono);font-size:11px;color:#B0392E;background:#FBE6E3;padding:3px 8px;border-radius:5px;">Sin detalle</span></div>
        <div style="display:flex;justify-content:space-between;padding:11px 0;border-bottom:1px dashed var(--line);font-size:14.5px;"><span>Consumo total</span><span>312 kWh</span></div>
        <div style="display:flex;justify-content:space-between;padding:11px 0;border-bottom:1px dashed var(--line);font-size:14.5px;"><span>¿Qué artefacto consumió más?</span><span>—</span></div>
        <div style="display:flex;justify-content:space-between;padding:11px 0;border-bottom:1px dashed var(--line);font-size:14.5px;"><span>¿Cuánto se perdió en standby?</span><span>—</span></div>
        <div style="display:flex;justify-content:space-between;padding:11px 0;font-weight:700;color:var(--navy-deep);font-family:var(--mono);font-size:14.5px;"><span>Total a pagar</span><span>$ 84.300</span></div>
      </div>
    </div>
    <div style="display:flex;flex-direction:column;gap:22px;">
      <div style="display:flex;gap:16px;">
        <div style="width:40px;height:40px;flex-shrink:0;border-radius:9px;background:rgba(0,87,214,.08);display:flex;align-items:center;justify-content:center;color:var(--blue-brand);font-family:var(--mono);font-weight:600;">01</div>
        <div><h4 style="font-family:var(--display);font-size:16px;margin-bottom:4px;color:var(--navy-deep);">Consumo vampiro invisible</h4><p style="font-size:14.5px;color:var(--ink-soft);">Dispositivos "apagados" que siguen tomando corriente de la red durante horas, todos los días del mes.</p></div>
      </div>
      <div style="display:flex;gap:16px;">
        <div style="width:40px;height:40px;flex-shrink:0;border-radius:9px;background:rgba(0,87,214,.08);display:flex;align-items:center;justify-content:center;color:var(--blue-brand);font-family:var(--mono);font-weight:600;">02</div>
        <div><h4 style="font-family:var(--display);font-size:16px;margin-bottom:4px;color:var(--navy-deep);">Cero trazabilidad por artefacto</h4><p style="font-size:14.5px;color:var(--ink-soft);">La factura mensual agrupa todo el consumo del hogar en un solo número, sin desglose posible.</p></div>
      </div>
      <div style="display:flex;gap:16px;">
        <div style="width:40px;height:40px;flex-shrink:0;border-radius:9px;background:rgba(0,87,214,.08);display:flex;align-items:center;justify-content:center;color:var(--blue-brand);font-family:var(--mono);font-weight:600;">03</div>
        <div><h4 style="font-family:var(--display);font-size:16px;margin-bottom:4px;color:var(--navy-deep);">Impacto ambiental invisible</h4><p style="font-size:14.5px;color:var(--ink-soft);">Nadie ve, en el momento, cuánto CO₂ genera dejar un electrodoméstico enchufado de más.</p></div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Arquitectura del sistema</span>
      <h2>Del enchufe a tu bolsillo, en milisegundos</h2>
      <p>El sensor mide, el ESP32 transmite, la nube sincroniza y Energhost reacciona — sin que el usuario tenga que recargar nada.</p>
    </div>
    <div class="flow" style="display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative;">
      <div class="flow-step" style="padding:0 14px;">
        <div class="process-step"><div class="n">1</div>
        <h4>Sensor PZEM-004T</h4>
        <p>Mide voltaje, corriente, potencia y energía acumulada del artefacto conectado, con aislamiento galvánico.</p></div>
      </div>
      <div class="flow-step" style="padding:0 14px;">
        <div class="process-step"><div class="n">2</div>
        <h4>Microcontrolador ESP32</h4>
        <p>Procesa las lecturas y las sube por Wi-Fi a Firebase Realtime Database y Blynk.</p></div>
      </div>
      <div class="flow-step" style="padding:0 14px;">
        <div class="process-step"><div class="n">3</div>
        <h4>Firebase + Google Sheets</h4>
        <p>Firebase sincroniza en tiempo real; Apps Script vuelca cada lectura a una planilla de auditoría accesible por QR.</p></div>
      </div>
      <div class="flow-step" style="padding:0 14px;">
        <div class="process-step"><div class="n">4</div>
        <h4>App Energhost (Flutter)</h4>
        <p>Escucha los cambios en Firebase y actualiza el dashboard al instante, sin recargar la pantalla.</p></div>
      </div>
      <div class="flow-step" style="padding:0 14px;">
        <div class="process-step"><div class="n">5</div>
        <h4>Control remoto</h4>
        <p>El usuario apaga un relé desde la app; el ESP32 detecta el cambio y corta la corriente en milisegundos.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="wrap" style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">
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
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:26px;">
        <div style="border:1px solid var(--line);border-radius:10px;padding:14px 16px;background:var(--bg-white);"><div style="font-family:var(--mono);font-size:11px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Microcontrolador</div><div style="font-size:13.5px;font-weight:500;">ESP32, Wi-Fi nativo</div></div>
        <div style="border:1px solid var(--line);border-radius:10px;padding:14px 16px;background:var(--bg-white);"><div style="font-family:var(--mono);font-size:11px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Sensor</div><div style="font-size:13.5px;font-weight:500;">PZEM-004T V3.0</div></div>
        <div style="border:1px solid var(--line);border-radius:10px;padding:14px 16px;background:var(--bg-white);"><div style="font-family:var(--mono);font-size:11px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Actuador</div><div style="font-size:13.5px;font-weight:500;">Módulo relé de alta capacidad</div></div>
        <div style="border:1px solid var(--line);border-radius:10px;padding:14px 16px;background:var(--bg-white);"><div style="font-family:var(--mono);font-size:11px;color:var(--blue-brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Pantalla local</div><div style="font-size:13.5px;font-weight:500;">OLED 0.96"</div></div>
      </div>
    </div>
  </div>
</section>

<section class="bg-navy">
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

<section>
  <div class="wrap" style="text-align:center;">
    <span class="eyebrow">¿Querés algo parecido?</span>
    <h2 style="margin-top:14px;font-size:30px;">Podemos auditar tu espacio con el mismo sistema</h2>
    <a href="/contacto" class="btn btn-primary" style="margin-top:22px;">Solicitar auditoría →</a>
  </div>
</section>

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
</script>
