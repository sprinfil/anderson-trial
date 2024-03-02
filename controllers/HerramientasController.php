<?php

class HerramientasController
{
        static public function alert_succes($url, $mensaje)
        {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>';
                echo 'Swal.fire({';
                echo '  title: "' . $mensaje . '",';
                echo '  icon: "success",';
                echo '  showCancelButton: false,';
                echo '  showConfirmButton: false, ';
                echo '  timer: 800, ';
                echo '}).then((result) => {';
                echo '    window.location.href = "' . $url . '" ;';
                echo '});';
                echo '</script>';
        }

        static public function alert_warning($url, $mensaje)
        {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>';
                echo 'Swal.fire({';
                echo '  title: "' . $mensaje . '",';
                echo '  icon: "warning",';
                echo '  showCancelButton: false,';
                echo '  showConfirmButton: false, ';
                echo '  timer: 800, ';
                echo '}).then((result) => {';
                echo '});';
                echo '</script>';
        }
}

