<?php

class Util
{

    public static function calculateAge($birthday){
        list($ano,$mes,$dia) = explode('-',$birthday);
        $ano_diferencia  = date('Y') - $ano;
        $mes_diferencia = date('m') - $mes;
        $dia_diferencia   = date('d') - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

    public static function getDateRecord(){
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/Bogota'));
        return $date->format('d-m-Y h:i:s');
    }

    public static function messageAlert($message){
        ?>
        <script>
            alert('<?= $message ?>');
            history.back();
        </script>
        <?php
        exit;
    }

    public static function confirmationProcess($message, $url){
        ?>
        <script>
            alert('<?= $message ?>');
            location.href='<?= $url ?>';
        </script>
        <?php
    }
}