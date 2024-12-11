// En el archivo donde necesitas la clave (por ejemplo, en `nasa_api.php`)

require_once 'config.php';  // Incluir el archivo de configuración con la clave

// Función para obtener la foto del día de la NASA
function getPhotoOfTheDay() {
    // Usamos la constante API_KEY directamente
    $url = "https://api.nasa.gov/planetary/apod?api_key=" . API_KEY;
    $response = file_get_contents($url);

    if ($response === FALSE) {
        return false;  // Error al obtener los datos
    }

    return json_decode($response, true);  // Decodificar la respuesta JSON
}

// Función para obtener los asteroides cercanos
function getAsteroids($startDate, $endDate) {
    // Usamos la constante API_KEY directamente
    $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=" . $startDate . "&end_date=" . $endDate . "&api_key=" . API_KEY;
    $response = file_get_contents($url);

    if ($response === FALSE) {
        return false;  // Error al obtener los datos
    }

    return json_decode($response, true);  // Decodificar la respuesta JSON
}
