// js/map-init.js

document.addEventListener('DOMContentLoaded', () => {
  // Coordenadas iniciales centradas en la frontera de Ceuta
  const ceutaCoords = [35.888, -5.316];

  // Inicializar el mapa
  const map = L.map('map').setView(ceutaCoords, 13);

  // Cargar capa de OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 19,
  }).addTo(map);

  // Función para cargar marcadores desde el servidor (ejemplo con fetch)
  async function loadMarkers() {
    try {
      const response = await fetch('status.php?format=json');
      const data = await response.json();
      // data = [{ tipo: 'entry', lat: ..., lng: ..., tiempo: 12, estado: 'Fluido' }, ...]
      data.forEach(point => {
        const icon = point.tipo === 'entry'
          ? 'login'
          : 'logout';
        const marker = L.marker([point.lat, point.lng]).addTo(map);
        marker.bindPopup(`
          <strong>${point.tipo === 'entry' ? 'Entrada' : 'Salida'}</strong><br>
          Tiempo: ${point.tiempo} min<br>
          Estado: ${point.estado}
        `);
      });
    } catch (err) {
      console.error('Error cargando marcadores:', err);
    }
  }

  // Cargar marcadores iniciales
  loadMarkers();

  // Opcional: refrescar marcadores cada cierto tiempo (por ejemplo, cada 60s)
  setInterval(() => {
    // Limpia todas las capas de marcadores y vuelve a cargar
    map.eachLayer(layer => {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });
    loadMarkers();
  }, 60000);
});
