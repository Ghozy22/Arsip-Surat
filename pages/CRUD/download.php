<?php 


    if (isset($_GET['surat'])) {
    $surat    = $_GET['surat'];

    $back_dir    ="../../upload/";
    $surat = $back_dir.$_GET['surat'];
     
        if (file_exists($surat)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($surat));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($surat));
            ob_clean();
            flush();
            readfile($surat);
            
            exit;
        } 
        else {
            $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
            header("location: ../../index.php");
        }
    }
?>