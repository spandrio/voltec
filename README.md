# Voltec Ergon

**Descripcion:**
EcoSmart Grid es un sistema IoT modular para el monitoreo, analisis y optimizacion del consumo energetico residencial e institucional en tiempo real. Mediante modulos fisicos con microcontrolador ESP32 y sensor PZEM-004T, el sistema mide voltaje, corriente, potencia y energia acumulada de cualquier artefacto electrico, envia los datos a la nube (Firebase + Blynk) y los visualiza desde la aplicacion movil **Energhost**, desarrollada con Flutter y Dart. Incorpora deteccion automatica de consumo vampiro, calculo del costo en pesos argentinos, estimacion de huella de carbono y control remoto de dispositivos por rele.

Integrantes:

- {Apellido, Nombre} | [@spandrio](https://github.com/spandrio)
- {Apellido, Nombre} | [@username](https://github.com/username)
- {Apellido, Nombre} | [@username](https://github.com/username)
- {Apellido, Nombre} | [@username](https://github.com/username)
- {Apellido, Nombre} | [@username](https://github.com/username)
- {Apellido, Nombre} | [@username](https://github.com/username)

Proyecto institucional **E.E.S.T N°4 de Berazategui y Fundacion YPF**.

## Elevator's Pitch

- Para **YPF y la comunidad educativa de la E.E.S.T N°4 de Berazategui**
- Quienes **no tienen herramientas accesibles para saber cuanto consume cada dispositivo electrico, detectar perdidas por consumo vampiro en standby ni conocer el impacto ambiental real de su consumo**
- El **EcoSmart Grid** es un **sistema IoT modular de monitoreo y control energetico**
- Que **mide en tiempo real el consumo de cada artefacto, detecta automaticamente consumos innecesarios, calcula el costo en pesos y la huella de carbono, y permite apagar dispositivos de forma remota desde el celular**
- Diferente a **los medidores electricos convencionales que solo registran el consumo total acumulado sin identificar dispositivos, sin generar alertas y sin ofrecer control remoto**
- Nuestro proyecto **no solo registra datos, sino que los interpreta: convierte informacion electrica abstracta en metricas visuales, alertas inteligentes y acciones concretas que reducen el gasto energetico y la emision de CO₂**.

## Stack tecnologico

| Capa | Tecnologia |
|------|-----------|
| Hardware | ESP32 · PZEM-004T V3.0 · Modulo rele · Pantalla OLED 0.96" |
| Firmware | Arduino IDE (C++) |
| Cloud | Firebase Realtime Database · Blynk 2.0 · Google Sheets + Apps Script |
| App movil | Flutter / Dart |
| Diseno 3D | Tinkercad · Fusion 360 · Ultimaker Cura · Impresoras Kuttercraft |

## Requisitos

- PHP 8.1 o superior.
- Extension PDO habilitada.
- MySQL o PostgreSQL segun la configuracion en el archivo `.env`.

## Migraciones

Coloca tus archivos `.sql` en `src/database/migrations/` y ejecuta:

```bash
composer migrate
```

## Licencia

Este proyecto esta licenciado bajo la [Licencia MIT](./LICENSE).

---

Generado por la [plantilla](https://github.com/PDI-EEST4/slim-template-2026), a discrecion de los integrantes del proyecto.