<?php
require_once 'includes/config.php';

echo "<h1>✅ Sistema IEE - Verificación</h1>";

// 1. Verificar carpeta data
echo "<h3>1. Carpeta data:</h3>";
if (file_exists('../data/')) {
    echo "✅ data/ existe<br>";
} else {
    echo "❌ data/ no existe - se creará automáticamente<br>";
}

// 2. Verificar carpeta logs
echo "<h3>2. Carpeta logs:</h3>";
if (file_exists('../data/logs/')) {
    echo "✅ data/logs/ existe<br>";
} else {
    echo "🔄 Creando data/logs/...<br>";
    mkdir('../data/logs/', 0755, true);
    echo "✅ Creada<br>";
}

// 3. Probar escritura de log
echo "<h3>3. Prueba de log:</h3>";
$test = registrarLog('TEST_SISTEMA', ['mensaje' => 'Verificación manual exitosa']);
if ($test) {
    echo "✅ Log escrito correctamente<br>";
    $logFile = DATA_DIR . 'logs/iee_' . date('Y-m-d') . '.log';
    echo "📁 Archivo: " . basename($logFile) . "<br>";
} else {
    echo "❌ Error al escribir log<br>";
}

// 4. Estado de archivos JSON
echo "<h3>4. Archivos JSON:</h3>";
$jsonFiles = ['claves.json', 'diagnosticos.json', 'sesiones.json', 'intentos.json'];
foreach ($jsonFiles as $file) {
    $path = DATA_DIR . $file;
    if (file_exists($path)) {
        echo "✅ $file existe<br>";
    } else {
        echo "🔄 $file se creará al primer uso<br>";
    }
}

// 5. Configuración actual
echo "<h3>5. Configuración:</h3>";
echo "Sistema: " . SISTEMA_NOMBRE . " v" . SISTEMA_VERSION . "<br>";
echo "Prefijo Personas: " . CLAVE_PREFIJO_PERSONAS . "<br>";
echo "Prefijo Empresas: " . CLAVE_PREFIJO_EMPRESAS . "<br>";
echo "Email consultor: " . TU_EMAIL . "<br>";
echo "Entorno: " . $config['entorno'] . "<br>";
?>