<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="" />

    <link rel="icon" href="../assets/images/cropped-logo-unico-32x32.png" sizes="32x32" />
    <link rel="icon" href="../assets/images/cropped-logo-unico-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../assets/images/cropped-logo-unico-180x180.png" />

    <title>San Gabriel | Dashboard</title>

    <link rel="stylesheet" href="../assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/neon-core.css">
    <link rel="stylesheet" href="../assets/css/neon-theme.css">
    <link rel="stylesheet" href="../assets/css/neon-forms.css">

    <script src="../assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">

    <script src="../assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="../assets/js/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="../assets/css/custom.css">
    <script>
        function proceso(txtfechainicial, txtfechafinal, boton){

            switch(boton){
                case "Filtrar":
                    var parametros = {
                        "txtfechainicial" : txtfechainicial,
                        "txtfechafinal" : txtfechafinal,
                        "btnbutton" : boton
                    }
                    break;
            }
            $.ajax({
                data: parametros,
                url: '../index.php?accion=payFilters',
                type:'post',
                beforeSend:
                    function(){
                        $('#filtro').html('Cargando...');
                    },
                success:
                    function(response){
                        $('#filtro').html(response);
                    }
            });
        }
    </script>

    <script>
        function allowOnlyAlphabets(event) {
            const charCode = event.keyCode;

            let mensualidad = 11200;

            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)) {
                return false;
            } else {
                const cont = document.getElementById("txtcantidadbeneficiarios").value;
                if(cont > 0){
                    switch (cont) {
                        case '1':
                            mensualidad = 11200;
                            break;
                        case '2':
                            mensualidad = 11200;
                            break;
                        case '3':
                            mensualidad = 11200;
                            break;
                        case '4':
                            mensualidad = 14000;
                            break;
                        case '5':
                            mensualidad = 16800;
                            break;
                        case '6':
                            mensualidad = 19600;
                            break;
                        case '7':
                            mensualidad = 22400;
                            break;
                        case '8':
                            mensualidad = 25200;
                            break;
                        case '9':
                            mensualidad = 28300;
                            break;
                        case '10':
                            mensualidad = 31400;
                            break;
                        case '11':
                            mensualidad = 34500;
                            break;
                        case '12':
                            mensualidad = 37600;
                            break;
                        case '13':
                            mensualidad = 40700;
                            break;
                        default:
                            mensualidad  = 0;
                    }
                    document.getElementById("mensualidad").innerHTML = "<h4><b>"+mensualidad+"</b></h4>";
                    document.getElementById("txtmensualidad").setAttribute('value',mensualidad);
                }else{
                    document.getElementById("mensualidad").innerHTML = "<h4><b>11200</b></h4>";
                    document.getElementById("txtmensualidad").setAttribute('value',11200);
                }
                return true;
            }
        }
    </script>
</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->