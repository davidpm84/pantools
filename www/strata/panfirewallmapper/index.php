<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Palo Alto Networks - Firewall Mapper</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    :root {
      --pan-orange: #fca311;
      --pan-dark: #14213d;
      --pan-light: #e5e5e5;
      --sidebar-width: 300px;
    }

    body {
      background-color: #f6f9ff;
      font-family: 'Nunito', sans-serif;
      color: #444444;
    }

    /* HEADER */
    .header {
      background-color: #fff;
      height: 60px;
      box-shadow: 0px 2px 20px rgba(1, 41, 112, 0.1);
      z-index: 997;
      padding-left: 20px;
    }

    .logo span {
      color: var(--pan-dark) !important;
    }

    /* SIDEBAR */
    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      bottom: 0;
      width: var(--sidebar-width);
      z-index: 996;
      transition: all 0.3s;
      /* padding: 20px;  <-- Quitamos el padding global para gestionarlo por hijos */
      background-color: #fff;
      box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
      
      /* NUEVO: Flexbox para empujar el botón al final */
      display: flex;
      flex-direction: column;
    }

    /* Ajuste para el padding interno */
    .sidebar-nav {
      padding: 20px; /* Padding movido aquí */
      margin: 0;
      list-style: none;
      overflow-y: auto; /* Scroll solo en la lista */
    }

    .sidebar-nav .nav-item {
      margin-bottom: 5px;
      font-size: 15px;
      color: #4154f1;
      padding: 10px 15px;
      border-radius: 4px;
      background: #f6f9ff;
      display: flex;
      align-items: center;
    }

    .sidebar-nav .nav-item i {
      font-size: 1.2rem;
      margin-right: 10px;
      color: var(--pan-orange);
    }

    .sidebar-nav ul {
        padding-left: 0;
        list-style: none;
        width: 100%;
    }

    /* MAIN CONTENT */
    #main {
      margin-top: 60px;
      margin-left: var(--sidebar-width);
      padding: 20px 30px;
      transition: all 0.3s;
    }

    @media (max-width: 1199px) {
      #main { margin-left: 0; }
      .sidebar { left: -300px; }
    }

    /* CARDS */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
      margin-bottom: 30px;
    }

    .card-body {
      padding: 20px 20px;
    }

    .pagetitle h1 {
      font-size: 24px;
      margin-bottom: 0;
      font-weight: 600;
      color: var(--pan-dark);
    }

    /* BUTTONS */
    .btn-primary {
      background-color: var(--pan-dark);
      border-color: var(--pan-dark);
    }
    .btn-primary:hover {
      background-color: var(--pan-orange);
      border-color: var(--pan-orange);
      color: #000;
    }

    /* CUSTOMIZACION DE LA TABLA GENERADA POR PHP (Sin tocar el PHP) */
    table {
        width: 100%;
        margin-bottom: 1rem;
        vertical-align: top;
        border-color: #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    th {
        background-color: var(--pan-dark) !important;
        color: white !important;
        padding: 12px !important;
        font-weight: 600;
    }
    td {
        padding: 10px !important;
        background-color: white;
    }
    tr:nth-child(even) td {
        background-color: #f8f9fa;
    }
    
    /* Clases originales del PHP */
    .red {
        background-color: #ffcccc !important; /* Rojo más suave */
        color: #b71c1c !important;
        font-weight: bold;
    }
    .green {
        background-color: #d4edda !important; /* Verde más suave */
        color: #155724 !important;
        font-weight: bold;
    }
    .orange {
        background-color: #fff3cd !important;
        color: #856404 !important;
        font-weight: bold;
    }

  </style>
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center text-decoration-none">
        <i class="bi bi-bricks fs-2 me-2" style="color: #fca311;"></i>
        <span class="d-none d-lg-block fs-4 text-dark font-monospace">
          Firewall<span style="color: #fca311; font-weight: 800;">Mapper</span>
        </span>
      </a>
    </div>
  </header><?php
  $DBFiles = glob("*.csv");
  ini_set('display_errors', 0);
  error_reporting(E_ALL & ~E_NOTICE);
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Model Sizing & Feature Comparison</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Analysis</li>
        </ol>
      </nav>
    </div><section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Upload Configuration</h5>
              
              <form class="row g-3" action="" method="post" enctype="multipart/form-data">
    
                <div class="col-md-6">
                  <label for="file" class="form-label fw-bold">1. Upload TSF file (.tgz)</label>
                  <input class="form-control" type="file" name="file" id="file" required>
                </div>

                <div class="col-md-6">
                   <label for="panosversion" class="form-label fw-bold">2. Select DB Target Version</label>
                   <select class="form-select" name="panosversion">
                    <?php
                      if (empty($DBFiles)) {
                        echo '<option value="a">DB/csv file not found</option>';
                      } else {
                        for ($i = 0; $i < count($DBFiles); $i++) {
                          $nombreArchivo = basename($DBFiles[$i]);
                          echo '<option value="' . $nombreArchivo . '">' . $nombreArchivo . '</option>';
                        }
                      }
                    ?>
                   </select>
                </div>

                <div class="col-md-6">
                  <label for="throughput" class="form-label text-muted">(Optional) Est. Threat Prevention Throughput (Gbps):</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-speedometer2"></i></span>
                    <input type="text" class="form-control" id="throughput" name="throughput" value="0">
                  </div>
                </div>
                
                <div class="col-12 text-end mt-4">
                  <button type="submit" name="submit" class="btn btn-primary btn-lg px-5 shadow-sm"><i class="bi bi-search me-2"></i> Compare Models</button>
                </div>
              </form></div>
          </div>

        </div>
      </div>
    </section>

  <?php
  // =========================================================================================
  // LOGIC BLOCK STARTS - (Code logic preserved as requested)
  // =========================================================================================
  $target_dir = "uploads/";
  // Fix for potential undefined key warning if file not uploaded yet
  if(isset($_FILES["file"]["name"])){
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  }
  
  $uploadOk = 1;
  $desc_completada=0;
  
  function eliminarDirectorio($directorio) {
    if (!is_dir($directorio)) {
        return;
    }
    $archivos = array_diff(scandir($directorio), array('.', '..'));
    foreach ($archivos as $archivo) {
        if (is_dir("$directorio/$archivo")) {
            eliminarDirectorio("$directorio/$archivo");
        } else {
            unlink("$directorio/$archivo");
        }
    }
    rmdir($directorio);
  }

  // obtener valores del post y generar consulta SQL
  if (isset($_POST['submit'])){

    $throughput = isset($_POST['throughput']) ? $_POST['throughput'] : 0;
    $panosversion = $_POST['panosversion'];

    if ($uploadOk == 0) {
      echo "<div class='alert alert-danger'>El fichero no cumple los requisitos.</div>";
    } else {
      $rutaDestino = $target_dir;
      // Ensure directory exists
      if (!is_dir($rutaDestino)) { mkdir($rutaDestino, 0777, true); }

      if (move_uploaded_file($_FILES["file"]["tmp_name"], $rutaDestino . $_FILES["file"]["name"])) {
          
          try {
            exec("tar -xzf $target_file -C $target_dir");
            $desc_completada=1;
          } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error al descomprimir: " . $e->getMessage() . "</div>";
            $desc_completada=0;
          }

      $running_config = $target_dir . "opt/pancfg/mgmt/saved-configs/.merged-running-config.xml";
      $sdb_interfaces = $target_dir . "tmp/cli/logs/sdb.txt";
      $hw_price = "hardwareprice.txt";
      $clifile = '';
      $edldomain = '';
      $edls=0;
      $archivo = glob($target_dir . "tmp/cli/*.txt");
      if (!empty($archivo)) { $clifile = $archivo[0]; }
      
      $archivo = glob($target_dir . "opt/pancfg/mgmt/devices/localhost.localdomain/*.dbl");
      if (!empty($archivo)) { $edldomain = $archivo; $edls=$edls+count($archivo); }

      $archivo = glob($target_dir . "opt/pancfg/mgmt/devices/localhost.localdomain/*.ubl");
      if (!empty($archivo)) { $edlurl = $archivo; $edls=$edls+count($archivo); }

      $archivo = glob($target_dir . "opt/pancfg/mgmt/devices/localhost.localdomain/*.ebl");
      if (!empty($archivo)) { $edlip = $archivo; $edls=$edls+count($archivo); }
      
        $ini_vsys=0; $fin_vsys=0; $ini_system=0; $fin_system=0; $ini_zone=0; $fin_zone=0;
        $ini_dhcp=0; $fin_dhcp=0; $ini_secrules=0; $fin_secrules=0; $ini_natrules=0;
        $fin_natrules=0; $ini_vrouter=0; $fin_vrouter=0;
        $posicionesZone = array(); $posicionesEndZone = array();
        $posicionesReglasSeg = array(); $posicionesEndReglasSeg = array();
        $posicionesNat = array(); $posicionesEndNat = array();
        $posicionesAddress = array(); $posicionesEndAddress = array();
        $posicionNat=0; $posicionVR=0;
        $posicionesEndVR = array(); $posicionesVR = array();

        $patternvsys = '/<entry name="vsys\d+"(.*?)>/';
        $patternvr = '/<entry name="([^"]+)">/';
        $encontradoVsys = false; $encontradoZone = false; $encontradoEndZone = false;
        $natrules = 0; $Addresses = 0; $fqdn = 0;

        $encontradoNat = false; $encontradoVR = false; $encontradoVR2 = false;
        $encontradoVR3 = false; $encontradoVR4 = false; $encontradoVR5 = false;
        $encontradoVR_linea=0; $encontradoVR2_linea=0;
        
        $entrar = true; $entrar2 = false; $entrar3 = 0;
        $numeroSesiones=0;

        $patron_mac = '/total\s+ARP\s+entries\s+in\s+table\s+:\s+(\d+)/';
        $mac_table=0;
        $patron_serial = '/serial:\s+(\d+)/i';
        $serial="";
        $patron_sesiones = '/Number of allocated sessions:\s+(\d+)/';
        $patron_GPUsers = '/Total Current Users: (\d+)/';
        $UsuariosGP=0;
        $patron_lic = '/Feature:\s+(.+)/';
        $subscriptions = [];
        $patron_modelo = '/model:\s+(.+)/';
        $modelo="";
        $panorama=0;
        $patron_panorama= '/<panorama-server>([\w.-]+)<\/panorama-server>/';
        $patron_interfaces = '/^.*\.status:.*\'link\': Up.*$/';
        $forwardProxyReady = 'no'; 
        $inboundProxyReady = 'no'; 
        $CDLenabled = 'no';
        $contadoresSecciones = array();
        $analizando = false; 

        $lines = file($running_config); 
        $lineas_clifile = file($clifile); 
        $linesSdb = file($sdb_interfaces); 
        if (file_exists($hw_price)) {
          $lineshwprice = file($hw_price);
        } else {
          $lineshwprice = ""; 
        }

        $numEDLDomain=0;
        foreach ($edldomain as $archivo) {
          $lineas_edldomain = file($archivo);
          $numEDLDomain = $numEDLDomain + count($lineas_edldomain);
        }
        
        $numEDLURL=0;
        foreach ($edlurl as $archivo) {
          $lineas_edlurl = file($archivo);
          $numEDLURL = $numEDLURL + count($lineas_edlurl);
        }

        $numEDLIP=0;
        foreach ($edlip as $archivo) {
          $lineas_edlip = file($archivo);
          $numEDLIP = $numEDLIP + count($lineas_edlip);
        }

    $puertosProcesados = array(); 
    $conteoSettingType = array(); 

    foreach ($linesSdb as $lineaSdb) {
      if (preg_match($patron_interfaces, $lineaSdb, $coincidencias)) {
          preg_match("/'setting': (\d+Gb)/", $lineaSdb, $matchesSetting);
          $settingValue = $matchesSetting[1];

          preg_match("/'type': (\w+(-\w+)*)/", $lineaSdb, $matchesType);
          $typeValue = $matchesType[1];
          
          if ($typeValue === "Internal") { continue; }
          preg_match("/sys\.s(\d+)\.p(\d+)/", $lineaSdb, $matches);
          $numeroS = $matches[1];
          $numeroP = $matches[2];
          $numeroPuerto = "s$numeroS.p$numeroP";

          if (in_array($numeroPuerto, $puertosProcesados)) { continue; }

          $puertosProcesados[] = $numeroPuerto;

          if (isset($conteoSettingType[$settingValue][$typeValue])) {
              $conteoSettingType[$settingValue][$typeValue]++;
          } else {
              $conteoSettingType[$settingValue][$typeValue] = 1;
          }
      }
    }

    foreach ($lineas_clifile as $num_linea => $linea_cli) {
        if (trim($linea_cli) === "> show session all") {
          $analizando = true; continue;
      }
      if ($analizando && strpos($linea_cli, '>') === 0) {
          $analizando = false; continue;
      }
      if ($analizando && !empty(trim($linea_cli)) && !preg_match('/^(ID|Application|^-+|vsys|Vsys)/', $linea_cli)) {
        $columnas = preg_split('/\s+/', trim($linea_cli));
        $aplicacion = $columnas[1];
        if (isset($contadoresSecciones[$aplicacion])) {
            $contadoresSecciones[$aplicacion]++;
        } else {
            $contadoresSecciones[$aplicacion] = 1;
        }
      }

      if (strpos($linea_cli, 'EAL Ingest FQDN') !== false) {
        $CDLenabled='yes';
      }
      
      if (strpos($linea_cli, 'Forward Proxy Ready') !== false) {
        $valor = trim(substr($linea_cli, strpos($linea_cli, ':') + 1));
        if ($valor === 'yes') { $forwardProxyReady = 'yes'; }
      } elseif (strpos($linea_cli, 'Inbound Proxy Ready') !== false) {
        $valor = trim(substr($linea_cli, strpos($linea_cli, ':') + 1));
        if ($valor === 'yes') { $inboundProxyReady = 'yes'; }
      }

      if (preg_match($patron_mac, $linea_cli, $matches)) {
        $mac_table = $matches[1];
      }
      if (preg_match($patron_serial, $linea_cli, $matches)) {
        $serial = $matches[1];
      }
      if (preg_match_all($patron_lic, $linea_cli, $matches)) {
        $subscriptions = array_merge($subscriptions, $matches[1]);
      }
      if ($numeroSesiones==0){ 
        if (preg_match($patron_sesiones, $linea_cli, $matches)) {
          $numeroSesiones = $matches[1];
        }
      }
      if (preg_match($patron_GPUsers, $linea_cli, $matches)) {
        $UsuariosGP = $matches[1];
      }
      if ($modelo==""){
        if (preg_match($patron_modelo, $linea_cli, $matches)) {
          $modelo = $matches[1];
        }
      }
    }

    foreach ($lines as $num_linea => $linea) {
     if (!$encontradoVsys_guia && strpos($linea, "<vsys>") !== false) {
          $posicionVsys = $num_linea;
        } elseif ($posicionVsys==$num_linea-1 && strpos($linea, "<entry name=") !== false) {
          $ini_vsys = $posicionVsys;
          $encontradoVsys_guia = true;
        } else {
          $posicionVsys = 0;
        }
        if ($encontradoVsys_guia && strpos($linea, "</vsys>") !== false) {
          $fin_vsys = $num_linea;
          $encontradoNat = false;
        }
        if ($fin_system==0 ){
          if (trim($linea) == "<deviceconfig>") { 
            $ini_system = $num_linea;
          }
          if (trim($linea) == "</deviceconfig>") { 
            $fin_system = $num_linea;
          }
        }

        if (!$encontradoVsys && preg_match($patternvsys, $linea)) {
          $encontradoVsys = true;
        } elseif ($encontradoVsys) {
          if (strpos($linea, '<zone>') !== false) {
            $encontradoZone = true;
            $posicionesZone[] = $num_linea;
          } elseif (strpos($linea, '</zone>') !== false) {
            $encontradoEndZone = true;
            $posicionesEndZone[] = $num_linea;
            $diferencia_lineas = abs(end($posicionesEndZone) - end($posicionesZone));
            if ($diferencia_lineas < 5) {
              $encontradoVsys = true;
            } else {
              $encontradoVsys = false;
            }
          }
        }

        if (trim($linea) == "<dhcp>") { 
          $ini_dhcp = $num_linea;
        }
        if (trim($linea) == "</dhcp>") { 
          $fin_dhcp = $num_linea;
        }
        if (trim($linea) == "<security>") { 
          $posicionesReglasSeg[] = $num_linea;
        }
        if (trim($linea) == "</security>") { 
          $posicionesEndReglasSeg[] = $num_linea;
        }

        if (!$encontradoNat && strpos($linea, "<nat>") !== false) {
          $posicionNat = $num_linea;
        } elseif ($posicionNat==$num_linea-1 && strpos($linea, "<rules>") !== false) {
          $posicionesNat[] = $posicionNat;
          $encontradoNat = true;
        } else {
          $posicionNat = 0;
        }
        if ($encontradoNat && strpos($linea, "</nat>") !== false) {
          $posicionesEndNat[] = $num_linea;
          $encontradoNat = false;
        }

        if (!$encontradoAddress && trim($linea) == "<address>") {
              $posicionAddress = $num_linea;
        } elseif ($posicionAddress==$num_linea-1 && strpos($linea, "<entry name=") !== false) {
          $posicionesAddress[] = $num_linea-1;
          $encontradoAddress = true;
        } else {
          $posicionAddress = 0;
        }

        if ($encontradoAddress && strpos($linea, "</address>") !== false) {
          $posicionesEndAddress[] = $num_linea;
          $encontradoAddress = false;
        }

        if ((!$encontradoVR) && (trim($linea) == "<virtual-router>")) {
            $encontradoVR = true;
            $encontradoVR_linea=$num_linea;
        }
    
        if ( (preg_match('/<entry name="([^"]+)">/', $linea, $matches)  ) && ($encontradoVR_linea==$num_linea-1)) {
          $posicionesVR[] = $encontradoVR_linea;
          $encontradoVR2=true;
        } else {
          $encontradoVR = false;
        }

        if (($encontradoVR2) && (trim($linea) == "</entry>")) {
          $encontradoVR3 = true;
          $encontradoVR3_linea=$num_linea;
        }

        if ($encontradoVR2 && $encontradoVR3 && ($encontradoVR3_linea==$num_linea-1) && preg_match('/<\/virtual-router>/', $linea)) {
            $posicionesEndVR[] = $num_linea;
            $encontradoVR2 = false;
            $encontradoVR3 = false;
        }

        if (preg_match($patron_panorama, $linea, $matches)) {
          $panorama = 1;
        }
    }
    $vsys=0; $zonas=0; $dhcp=0; $dhcprelay=0; $secrules=0; $vrouters=0; $vrt=0; $sys=0;
    $hostname=""; $decryptionrules=0;
    $sizeZoneArray = count($posicionesZone);
    $sizeReglasSegArray = count($posicionesReglasSeg);
    $sizeReglasNatArray = count($posicionesNat);
    $sizeAddressArray = count($posicionesAddress);
    $sizeVR = count($posicionesVR);
    $checkVR2 = false; $checkVR1 = false;
    $encontradoVR3_linea = 0;
    
    foreach ($lines as $num_línea => $línea) {
      $decryptionrules += substr_count($línea, '<ssl-forward-proxy/>');
      $decryptionrules += substr_count($línea, '<ssl-inbound-inspection>');

        if ($num_línea >= ($ini_vsys - 1) && $num_línea <= ($fin_vsys - 1)) {
          if (preg_match($patternvsys, $línea)) {
            $vsys++;
          }
        }
      
      if ($num_línea >= ($ini_system - 1) && $num_línea <= ($fin_system - 1)) {
        if ((strpos($línea, "<hostname>") !== false) && $fin_system>=1) {
          $etiquetaInicio = "<hostname>";
          $etiquetaFin = "</hostname>";
          $inicio = strpos($línea, $etiquetaInicio) + strlen($etiquetaInicio);
          $fin = strpos($línea, $etiquetaFin);
          $hostname = trim(substr($línea, $inicio, $fin - $inicio));
        }
      }

      for ($i = 0; $i < $sizeZoneArray; $i++) {
        if ($num_línea >= ($posicionesZone[$i] - 1) && $num_línea <= ($posicionesEndZone[$i] - 1)) {
          if (trim($línea) == "</entry>") {  
            $zonas++;
          }
        }
      }

      if ($num_línea >= ($ini_dhcp - 1) && $num_línea <= ($fin_dhcp - 1)) {
        if (trim($línea) == "</server>") { 
          $dhcp++;
        }elseif (trim($línea) == "</relay>") { 
          $dhcprelay++;
        }
      }

      for ($i = 0; $i < $sizeReglasSegArray; $i++) {
        if ($num_línea >= ($posicionesReglasSeg[$i] - 1) && $num_línea <= ($posicionesEndReglasSeg[$i] - 1)) {
          if (trim($línea) == "</entry>") {  
            $secrules++;
          }
        }
      }
    
      for ($i = 0; $i < $sizeReglasNatArray; $i++) {
        if ($num_línea >= ($posicionesNat[$i] - 1) && $num_línea <= ($posicionesEndNat[$i] - 1)) {
          if (trim($línea) == "</entry>") {  
            $natrules++;
          }
        }
      }

      for ($i = 0; $i < $sizeAddressArray; $i++) {
        if ($num_línea >= ($posicionesAddress[$i] - 1) && $num_línea <= ($posicionesEndAddress[$i] - 1)) {
          if (trim($línea) == "</entry>") {  
            $Addresses++;
          }
          if (strpos($línea, "</fqdn>") !== false){
            $fqdn++;
          }
        }
      }

      for ($i = 0; $i < $sizeVR; $i++) {
        if ($num_línea >= ($posicionesVR[$i] - 1) && $num_línea <= ($posicionesEndVR[$i] - 1) ) {
          if (trim($línea) == "<protocol>" ) {
            $vrouters++;
          }
        }
      }
    }

    eliminarDirectorio($target_dir);
    $directorio = $target_dir;

    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    foreach ($lineshwprice as $lineahwprice) {
      if ($modelo == $lineahwprice) {
      }
    }
?>
 
    <div class="pagetitle mt-4">
      <h1>Results Analysis</h1>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Comparison Matrix</h5>
          <div class="table-responsive">

<?php
$arrayModelo = array();
$encontradoModelo = false;
$csvFile = $panosversion;
$file = fopen($csvFile, 'r');

if ($file) {
  while (($line = fgetcsv($file, 0, ';')) !== false) {
    
    // 1. NUEVO: Si la línea empieza por '#', la saltamos (ignora cabeceras)
    if (substr($line[0], 0, 1) === '#') { continue; }

    foreach ($line as $index => $column) {
        if ($index === 0) {
            // 2. MEJORA: Usamos trim() para asegurar que "PA-440 " sea igual a "PA-440"
            if (trim($modelo) == trim($column)) {
                $encontradoModelo = true;
            }
        }
        if ($encontradoModelo) {
            $arrayModelo[$index] = $column;
        }
    }
    if ($encontradoModelo) {
        break; 
    }
  }
  fclose($file);
} else {
    echo '<div class="alert alert-warning">No se pudo abrir el archivo CSV.</div>';
}

    // TABLE HEADERS
    echo '<table class="table table-striped table-hover">';
    echo '<thead class="table-dark">';
    echo '<tr>';
    echo '<th>Firewall</th>';
    echo '<th>TP Throughput (Gb/s)</th>';
    echo '<th>Sessions</th>';
    echo '<th>Sec. Policies</th>';
    echo '<th>NAT Rules</th>';
    echo '<th>Zones</th>';
    echo '<th>Add. Objects</th>';
    echo '<th>FQDN Objects</th>';
    echo '<th>EDL</th>';
    echo '<th>EDL IPs</th>';
    echo '<th>EDL Domains</th>';
    echo '<th>EDL URL</th>';
    echo '<th>VR</th>';
    echo '<th>Base Vsys</th>';
    echo '<th>Max. Vsys</th>';
    echo '<th>ARP Table</th>';
    echo '<th>DHCP Servers</th>';
    echo '<th>DHCP Relays</th>';
    echo '<th>GP Users</th>';
    echo '<th>Decrypt Rules</th>';
    echo '<th>Interfaces in use</th>';
    if ($lineshwprice!=""){
      echo '<th>Base HW Price</th>';
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // CURRENT DEVICE ROW
    echo '<tr class="table-info">';
    echo '<td><strong>' . $hostname .' (Current)</strong></td>';
    echo '<td>'. $throughput.' / '.$arrayModelo[1].'</td>';
    echo '<td>' .$numeroSesiones .' / '.$arrayModelo[3]. '</td>';
    echo '<td>' .$secrules . ' / '.$arrayModelo[4].'</td>';
    echo '<td>' . $natrules . ' / '.$arrayModelo[5].'</td>';
    echo '<td>' .$zonas . ' / '.$arrayModelo[6].'</td>';
    echo '<td>'. $Addresses .' / '.$arrayModelo[7].'</td>';
    echo '<td>'. $fqdn .' / '.$arrayModelo[8].'</td>';
    echo '<td>'. $edls .' / '.$arrayModelo[9].'</td>';
    echo '<td>' .$numEDLIP .' / '.$arrayModelo[10]. '</td>';
    echo '<td>' .$numEDLDomain . ' / '.$arrayModelo[11].'</td>';
    echo '<td>' .$numEDLURL . ' / '.$arrayModelo[12].'</td>';
    echo '<td>' .$vrouters . ' / '.$arrayModelo[13].'</td>';
    echo '<td>' . $vsys .' / '.$arrayModelo[14].'</td>';
    echo '<td>' . $vsys .' / '.$arrayModelo[15].'</td>';
    echo '<td>' .$mac_table .' / '.$arrayModelo[16]. '</td>';
    echo '<td>' . ($dhcp-$dhcprelay) .' / '.$arrayModelo[17]. '</td>';
    echo '<td>' . $dhcprelay . ' / '.$arrayModelo[18].'</td>';
    echo '<td>' .$UsuariosGP . ' / '.$arrayModelo[19].'</td>';
    echo '<td>' .$decryptionrules . ' / '.$arrayModelo[20].'</td>';
    echo '<td>';
    foreach ($conteoSettingType as $setting => $conteoType) {
      foreach ($conteoType as $type => $conteo) {
          echo "$conteo-$type-$setting<br>";
      }
    }
    echo '</td>';

    if ($lineshwprice!=""){
      foreach ($lineshwprice as $lineahwprice) {
        $parts = explode(';', $lineahwprice);
        $model_tmp = trim($parts[0]);
        if ($model_tmp === $modelo) {
          $formattedPrice = number_format($parts[1], 0, '.', '.');
          echo '<td>' . $formattedPrice . '$</td>';
          break;
        }
      }
    }
    echo '</tr>';

$dhcpservers=$dhcp-$dhcprelay;
$modelorecomendado = array();   
$modelodb = array();

$file = fopen($csvFile, 'r');

if ($file) {
// Skip first line logic if needed (already handled by logic above for arrayModelo)
// Reset file pointer might be needed if using same handle, but here we reopen it.

$numerolinea=1;
$primerValorRecomendado = null;
  
  // COMPARISON ROWS
  while (($line = fgetcsv($file, 0, ';')) !== false) {
    if (substr($line[0], 0, 1) === '#') { continue; }
    if (in_array("break", $line)) {
      break; 
    }
    echo '<tr>';
    $modelorecomendado[$numerolinea]=1;
    $modelorecomendadovsyslicense[$numerolinea]=0;
    
    foreach ($line as $index => $column) {
        
        if ($index === 0) {
          echo '<td><b>' .  $column . '</b></td>';
          $modelodb[$numerolinea]=$column;

        }else if ($index === 1 && floatval(str_replace(',', '.', $column)) >= $throughput) {
          echo '<td class="green">' . $throughput . '/' . $column . '</td>';
        } else if ($index === 1 && floatval(str_replace(',', '.', $column)) < $throughput) {
          echo '<td class="red">' . $throughput . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        }else if ($index === 2 ) {
           // index 2 skipped in original code logic for display but exists in CSV
        }else if ($index === 3 && floatval(str_replace(',', '.', $column)) >= $numeroSesiones) {
            echo '<td class="green">' . $numeroSesiones . '/' . $column . '</td>';
        } else if ($index === 3 && floatval(str_replace(',', '.', $column)) < $numeroSesiones) {
          echo '<td class="red">' . $numeroSesiones . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        }else if ($index === 4 && floatval(str_replace(',', '.', $column)) >= $secrules) {
            echo '<td class="green">' . $secrules . '/' . $column . '</td>';
        } else if ($index === 4 && floatval(str_replace(',', '.', $column)) < $secrules) {
          echo '<td class="red">' . $secrules . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        }else if ($index === 5 && floatval(str_replace(',', '.', $column)) >= $natrules) {
            echo '<td class="green">' . $natrules . '/' . $column . '</td>';
        } else if ($index === 5 && floatval(str_replace(',', '.', $column)) < $natrules) {
          echo '<td class="red">' . $natrules . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 6 && floatval(str_replace(',', '.', $column)) >= $zonas) {
          echo '<td class="green">' . $zonas . '/' . $column . '</td>';
        } else if ($index === 6 && floatval(str_replace(',', '.', $column)) < $zonas) {
          echo '<td class="red">' . $zonas . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 7 && floatval(str_replace(',', '.', $column)) >= $Addresses) {
          echo '<td class="green">' . $Addresses . '/' . $column . '</td>';
        } else if ($index === 7 && floatval(str_replace(',', '.', $column)) < $Addresses) {
          echo '<td class="red">' . $Addresses . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 8 && floatval(str_replace(',', '.', $column)) >= $fqdn) {
          echo '<td class="green">' . $fqdn . '/' . $column . '</td>';
        } else if ($index === 8 && floatval(str_replace(',', '.', $column)) < $fqdn) {
          echo '<td class="red">' . $fqdn . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 9 && floatval(str_replace(',', '.', $column)) >= $edls) {
          echo '<td class="green">' . $edls . '/' . $column . '</td>';
        } else if ($index === 9 && floatval(str_replace(',', '.', $column)) < $edls) {
          echo '<td class="red">' . $edls . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 10 && floatval(str_replace(',', '.', $column)) >= $numEDLIP) {
          echo '<td class="green">' . $numEDLIP . '/' . $column . '</td>';
        } else if ($index === 10 && floatval(str_replace(',', '.', $column)) < $numEDLIP) {
          echo '<td class="red">' . $numEDLIP . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 11 && floatval(str_replace(',', '.', $column)) >= $numEDLDomain) {
          echo '<td class="green">' . $numEDLDomain . '/' . $column . '</td>';
        } else if ($index === 11 && floatval(str_replace(',', '.', $column)) < $numEDLDomain) {
          echo '<td class="red">' . $numEDLDomain . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 12 && floatval(str_replace(',', '.', $column)) >= $numEDLURL) {
          echo '<td class="green">' . $numEDLURL . '/' . $column . '</td>';
        } else if ($index === 12 && floatval(str_replace(',', '.', $column)) < $numEDLURL) {
          echo '<td class="red">' . $numEDLURL . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 13 && floatval(str_replace(',', '.', $column)) >= $vrouters) {
          echo '<td class="green">' . $vrouters . '/' . $column . '</td>';
        } else if ($index === 13 && floatval(str_replace(',', '.', $column)) < $vrouters) {
          echo '<td class="red">' . $vrouters . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 14 && floatval(str_replace(',', '.', $column)) >= $vsys) {
          echo '<td class="green">' . $vsys . '/' . $column . '</td>';
        } else if ($index === 14 && floatval(str_replace(',', '.', $column)) < $vsys) {
          echo '<td class="orange">' . $vsys . '/' .  $column . '</td>';
          $modelorecomendadovsyslicense[$numerolinea]=1;
        } else if ($index === 15 && floatval(str_replace(',', '.', $column)) >= $vsys) {
          echo '<td class="green">' . $vsys . '/' . $column . '</td>';
        } else if ($index === 15 && floatval(str_replace(',', '.', $column)) < $vsys) {
          echo '<td class="red">' . $vsys . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 16 && floatval(str_replace(',', '.', $column)) >= $mac_table) {
          echo '<td class="green">' . $mac_table . '/' . $column . '</td>';
        } else if ($index === 16 && floatval(str_replace(',', '.', $column)) < $mac_table) {
          echo '<td class="red">' . $mac_table . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 17 && floatval(str_replace(',', '.', $column)) >= $dhcpservers) {
          echo '<td class="green">' . $dhcpservers . '/' . $column . '</td>';
        } else if ($index === 17 && floatval(str_replace(',', '.', $column)) < $dhcpservers) {
          echo '<td class="red">' . $dhcpservers . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 18 && floatval(str_replace(',', '.', $column)) >= $dhcprelay) {
          echo '<td class="green">' . $dhcprelay . '/' . $column . '</td>';
        } else if ($index === 18 && floatval(str_replace(',', '.', $column)) < $dhcprelay) {
          echo '<td class="red">' . $dhcprelay . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 19 && floatval(str_replace(',', '.', $column)) >= $UsuariosGP) {
          echo '<td class="green">' . $UsuariosGP . '/' . $column . '</td>';
        } else if ($index === 19 && floatval(str_replace(',', '.', $column)) < $UsuariosGP) {
          echo '<td class="red">' . $UsuariosGP . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else if ($index === 20 && floatval(str_replace(',', '.', $column)) >= $decryptionrules) {
          echo '<td class="green">' . $decryptionrules . '/' . $column . '</td>';
        } else if ($index === 20 && floatval(str_replace(',', '.', $column)) < $decryptionrules) {
          echo '<td class="red">' . $decryptionrules . '/' .  $column . '</td>';
          $modelorecomendado[$numerolinea]=0;
        } else {
          echo '<td >' .  $column . '</td>';
        }
    }
  
    echo '<td >Check Manually</td>';
    if ($lineshwprice!=""){
      foreach ($lineshwprice as $lineahwprice) {
        $parts = explode(';', $lineahwprice);
        $model_tmp = trim($parts[0]);
        if ($model_tmp === $modelodb[$numerolinea]) {
          $formattedPrice = number_format($parts[1], 0, '.', '.');
          echo '<td>' . $formattedPrice . '$</td>';
          break;
        }
      }
    }
    echo '</tr>';
    $numerolinea++;
}

if (empty($primerValorRecomendado)) {
  foreach ($modelorecomendado as $key => $value) {
      if ($value == 1) {
          $primerValorRecomendado = $modelodb[$key];
          $VsysLicense=$modelorecomendadovsyslicense[$key];
          break;
      }
  }
}
fclose($file);
} else {
    // Already handled open fail
}
echo '</tbody></table></div>'; // Close table responsive div

// RECOMMENDATIONS BLOCK
echo '<div class="mt-4 p-3 bg-light border rounded">';
echo '<h4 style="color: green; font-weight: bold;">Recommended Model: ' . $primerValorRecomendado . '*</h4>';

if ($VsysLicense==1){
  echo '<p style="color: red; font-weight: bold;">Note: Vsys extension License Needed!</p>';
}
if ($inboundProxyReady=="yes" || $forwardProxyReady=="yes"){
  echo '<p style="color: red; font-weight: bold;">Note: The device performs SSL decryption, check the amount of traffic being decrypted!</p>';
}
if ($panorama && $secrules==0){
  echo '<p style="color: red;">Warning: The firewall is managed by Panorama and no policies are found locally. NAT and security policies should be checked through Panorama.</p>';
}
echo "<small class='text-muted'>* The information provided on this website is intended for informational purposes based on the obtained data. However, it is important to note that obtaining the actual recommendation for the equipment to acquire may require reviewing additional specific information. Please consider consulting further resources for a comprehensive decision.</small>";
echo '</div>';

$top10Aplicaciones = array();
foreach ($contadoresSecciones as $aplicacion => $contador) {
    if (count($top10Aplicaciones) < 10) {
        $top10Aplicaciones[$aplicacion] = $contador;
    } else {
        break;
    }
}
?>
    </div>
    </div>

    <div class="pagetitle">
      <h1>Traffic & Usage Insights</h1>
    </div>

    <section class="section">
          <div class="card">
            <div class="card-body pt-3">
            <div class="row">
            <div class="col-md-6">
                <h5 class="card-title"><i class="bi bi-pie-chart-fill me-2" style="color: var(--pan-orange);"></i> Top 10 Applications</h5>
                <div id="donutchart" style="width: 100%; height: 400px;"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                  google.charts.load("current", {packages:["corechart"]});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var dataArr = [['Task', 'Value']];
                    var top10Aplicaciones = <?php echo json_encode($top10Aplicaciones); ?>;
                    for (var appName in top10Aplicaciones) {
                      dataArr.push([appName, top10Aplicaciones[appName]]);
                    }
                    var data = google.visualization.arrayToDataTable(dataArr);
                    var options = {
                      title: '',
                      pieHole: 0.4,
                      colors: ['#fca311', '#14213d', '#e5e5e5', '#8d99ae', '#2b2d42'] // Custom palette
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data, options);
                  }
                </script>
            </div>
            
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12 mb-4">
                        <h5 class="card-title"><i class="bi bi-shield-lock-fill me-2" style="color: var(--pan-orange);"></i> Decryption & CDL</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                SSL-Decrypt Inbound
                                <span class="badge bg-primary rounded-pill"><?php echo $inboundProxyReady ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                SSL-Decrypt Forward
                                <span class="badge bg-primary rounded-pill"><?php echo $forwardProxyReady ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                CDL Enabled
                                <span class="badge bg-primary rounded-pill"><?php echo $CDLenabled ?></span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-12">
                        <h5 class="card-title"><i class="bi bi-card-checklist me-2" style="color: var(--pan-orange);"></i> Active Licenses</h5>
                        <ul class="list-group list-group-flush">   
                            <?php   
                            foreach ($subscriptions as $sub) {
                              echo '<li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>' . $sub . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>

  </section>
</main>

<?php
  } else {
    echo "<div class='alert alert-warning m-4'>Ha habido un problema al subir el fichero.</div>";
  }
}
}
?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      
      <li class="nav-heading text-uppercase text-muted small fw-bold mb-2 ps-3">Device Info</li>

      <li class="nav-item">
          <i class="bi bi-info-circle"></i>
          <span>Mapper Version: 2.0</span>
      </li>
      <li class="nav-item">
          <i class="bi bi-database"></i>
          <span>DB PAN-OS: <?php echo preg_replace('/^DB-PANFW-v([\d.]+)\.csv$/', '$1', $panosversion); ?></span>
      </li>
      <li class="nav-item">
          <i class="bi bi-hdd-network"></i>
          <span>Hostname: <strong class="text-dark"><?php echo $hostname ?></strong></span>
      </li>
      <li class="nav-item">
          <i class="bi bi-box-seam"></i>
          <span>Model: <?php echo $modelo ?></span>
      </li>
      <li class="nav-item">
          <i class="bi bi-upc-scan"></i>
          <span>Serial: <?php echo $serial ?></span>
      </li>
    
      <li class="nav-heading text-uppercase text-muted small fw-bold mt-4 mb-2 ps-3">File Checks</li>
      
      <?php
      // Check list generation
      function printCheck($label, $condition) {
          $color = $condition ? 'color: #198754;' : 'color: #dc3545;';
          $icon = $condition ? 'bi-check-lg' : 'bi-x-lg';
          $text = $condition ? 'Found' : 'Not Found';
          echo '<li class="nav-item" style="font-size: 0.9rem;">';
          echo '<i class="bi ' . $icon . '" style="' . $color . ' margin-right: 8px;"></i>';
          echo '<span>' . $label . ': <span style="' . $color . '">' . $text . '</span></span>';
          echo '</li>';
      }

      printCheck("CLI File", !empty($clifile));
      printCheck("Config File", !empty($running_config));
      printCheck("SDB File", !empty($sdb_interfaces));
      printCheck("DB/CSV", !empty($DBFiles));
      printCheck("EDL Files", !empty($archivo));
      printCheck("HW Price", $lineshwprice!="");
      
      echo '<li class="nav-item" style="font-size: 0.9rem;">';
      $zipColor = ($desc_completada==1) ? 'color: #198754;' : 'color: #dc3545;';
      echo '<i class="bi bi-file-zip" style="' . $zipColor . ' margin-right: 8px;"></i>';
      echo '<span>Unzip: <span style="' . $zipColor . '">' . (($desc_completada==1) ? 'OK' : 'Error') . '</span></span>';
      echo '</li>';

      echo '<li class="nav-item" style="font-size: 0.9rem;">';
      $panColor = ($panorama==1) ? 'color: #0d6efd;' : 'color: #6c757d;';
      echo '<i class="bi bi-sliders" style="' . $panColor . ' margin-right: 8px;"></i>';
      echo '<span>Panorama: <span style="' . $panColor . '">' . (($panorama==1) ? 'Managed' : 'Unmanaged') . '</span></span>';
      echo '</li>';
      ?>
    </ul>
    <div class="mt-auto p-3 border-top">
        <a href="http://localhost/index.php" class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to PANTools
        </a>
    </div>
  </aside></body>
</html>