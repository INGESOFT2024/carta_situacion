import { Dropdown } from "bootstrap";
import L from 'leaflet';


const map = L.map('map', {
    center: [15.783471, -90.230759], 
    zoom: 7,
    layers: []
});


L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


const markerLayer = L.layerGroup().addTo(map);


const icon = L.icon({
    iconUrl: './images/operacion.png',  
    iconSize: [30, 30] 
});


const cargarOperaciones = async () => {
    try {
        const url = '/carta_situacion/API/operacion/mapa';
        const respuesta = await fetch(url);
        const datos = await respuesta.json();
        console.log(datos);

    
        markerLayer.clearLayers();

        datos.forEach(operacion => {
            const ubicacion = operacion.operacion_ubicacion.trim();
            const coordenadas = ubicacion.replace(/,/g, ' ').split(/\s+/);

            if (coordenadas.length === 2) {
                const lat = parseFloat(coordenadas[0]);
                const lng = parseFloat(coordenadas[1]);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const marker = L.marker([lat, lng], { icon: icon }).addTo(markerLayer);
                    marker.bindTooltip(operacion.operacion_nombre, {
                        permanent: true, 
                        direction: 'top',
                        className: 'tooltip',
                        offset: L.point(0, -20)  
                    }).openTooltip();
                    marker.bindPopup(` 
                        <b>${operacion.operacion_nombre}</b><br>
                        Dependencia: ${operacion.dependencia_nombre}<br>
                        Direccion: ${operacion.operacion_direccion}<br>
                        Cantidad Operaciones: ${operacion.operacion_cantidad}<br>
                        Fecha: ${operacion.operacion_fecha}
                    `);
                } else {
                    console.error(`Coordenadas inválidas para la operacion: ${operacion.operacion_nombre} - Coordenadas: ${lat}, ${lng}`);
                }
            } else {
                console.error(`Formato de coordenadas inválidas para la operacion: ${operacion.operacion_nombre} - Ubicación: ${ubicacion}`);
            }
        });
    } catch (error) {
        console.error('Error cargando las operaciones:', error);
    }
};


cargarOperaciones();
