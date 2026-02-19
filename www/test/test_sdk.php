<!DOCTYPE html>
<html>
<head>
    <title>Test SDK</title>
    <style>body { font-family: monospace; background: #222; color: #0f0; padding: 20px; }</style>
</head>
<body>
    <h2>Diagnóstico de demisto-sdk</h2>
    <pre>
<?php
// 1. Ver quién está ejecutando el script (debería ser www-data)
echo "User: " . exec('whoami') . "\n";

// 2. Ver dónde cree el sistema que está el ejecutable
$path = exec('which demisto-sdk');
echo "Path detectado: " . ($path ? $path : "No encontrado en \$PATH") . "\n";

// 3. Intentar ejecutar el comando de versión
// Usamos 2>&1 para capturar errores si los hay
$cmd = 'demisto-sdk --version 2>&1';
echo "Ejecutando: $cmd \n\n";

$output = [];
$returnCode = 0;
exec($cmd, $output, $returnCode);

// 4. Mostrar resultados
if ($returnCode === 0) {
    echo "✅ ¡ÉXITO! El SDK funciona correctamente:\n";
    echo "----------------------------------------\n";
    echo implode("\n", $output);
} else {
    echo "❌ ERROR (Código $returnCode):\n";
    echo "----------------------------------------\n";
    echo implode("\n", $output);
    
    // Ayuda extra si falla
    echo "\n\n--- Variables de Entorno (Debug) ---\n";
    echo "PATH: " . getenv('PATH');
}
?>
    </pre>
</body>
</html>