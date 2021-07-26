<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 funciona para la mayoria de los casos -->
    <meta name="viewport" content="width=device-width"> <!-- Forzar la escala inicial no deberia ser necesario -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use la ultima version (edge) del motor de renderizado IE -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Deshabilite la escala automatica en iOS 10 Mail por completo -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Dile a iOS que no enlace automaticamente ciertas cadenas de texto. -->
    <title>Monster Miles</title> <!-- La etiqueta del titulo se muestra en las notificaciones por correo electronico, como Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTA: Si no se requieren fuentes web, las lineas 10 a 27 se pueden eliminar de forma segura. -->

    <!-- Desktop Outlook se ahoga en las referencias de fuentes web y el valor predeterminado es Times New Roman, por lo que forzamos una fuente alternativa segura. -->
    <!--[if mso]>
        <style>
            * {
                font-family: Arial, sans-serif!important;
            }
        </style>
    <![endif]-->

    <!-- Todos los demas clientes obtienen la referencia de la fuente web; algunos renderizaran la fuente y otros fallaran silenciosamente a los fallbacks. Mas sobre eso aqui: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insertar referencia de fuente web, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');

        /* cyrillic-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 300;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gTD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        /* cyrillic */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 300;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3g3D_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* vietnamese */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 300;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gbD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 300;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gfD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 300;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gnD_vx3rCs.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        /* cyrillic-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WRhyyTh89ZNpQ.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        /* cyrillic */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459W1hyyTh89ZNpQ.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* vietnamese */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WZhyyTh89ZNpQ.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WdhyyTh89ZNpQ.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WlhyyTh89Y.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        /* cyrillic-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_dJE3gTD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        /* cyrillic */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_dJE3g3D_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* vietnamese */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_dJE3gbD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_dJE3gfD_vx3rCubqg.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_dJE3gnD_vx3rCs.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* Que hace: elimina espacios alrededor del dise&ntilde;o de correo electronico agregado por algunos clientes de correo electronico. */
        /* Cuidado: puede eliminar el relleno / margen y agregar un color de fondo para componer una ventana de respuesta. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* Que hace: detiene a los clientes de correo electronico cambiando el tama&ntilde;o del texto peque&ntilde;o. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* Que hace: Centra el correo electronico en Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* Que hace: obliga a los clientes de correo Samsung Android a usar toda la ventana grafica */
        #MessageViewBody, #MessageWebViewDiv{
            width: 100% !important;
        }

        /* Que hace: evita que Outlook agregue espacio adicional a las tablas. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* Que hace: reemplaza el estilo de negrita predeterminado. */
        th {
          font-weight: normal;
        }

        /* Que hace: soluciona el problema de relleno del webkit. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* Que hace: evita que Windows 10 Mail subraye enlaces a pesar de CSS en linea. Los estilos para los enlaces subrayados deben estar en linea. */
        a {
            text-decoration: none;
        }

        /* Que hace: utiliza un mejor metodo de representacion al cambiar el tama&ntilde;o de las imagenes en IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* Que hace: una solucion para clientes de correo electronico que se entrometen en enlaces activados. */
        a[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Que hace: evita que Gmail cambie el color del texto en los hilos de conversacion. */
        .im {
            color: inherit !important;
        }

        /* Que hace: evita que Gmail muestre un boton de descarga en imagenes grandes no vinculadas. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
    }
    /* Si lo anterior no funciona, agregue una clase .g-img a cualquier imagen en cuestion. */
    img.g-img + div {
       display: none !important;
    }

        /* Que hace: elimina el canal derecho de la aplicacion Gmail para iOS: https://github.com/TedGoas/Cerberus/issues/89 */
        /* Cree una de estas consultas de medios para cada tama&ntilde;o de ventana adicional que desee corregir */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- Que hace: hace que las imagenes de fondo en Outlook de 72ppi se procesen con el tama&ntilde;o correcto. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!-- CSS Reset : END -->

    <!-- Mejoras progresivas : BEGIN -->
    <style>

        /* Que hace: estilos de desplazamiento para botones */
        .button-td,
        .button-a,
        .button-td-secondary,
        .button-a-secondary {
            transition: all 100ms ease-in;
        }
      .button-td-primary:hover,
      .button-a-primary:hover {
          background: #ffffff !important;
            border-color: #223c56 !important;
          color: #02405f !important;
      }

        .button-td-secondary:hover,
        .button-a-secondary:hover {
            background: #bc272d !important;
            border-color: #bc272d !important;
            color: #FFFFFF!important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* Que hace: fuerza las celdas de la tabla en filas de ancho completo. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* Y el centro justifica estos. */
            .stack-column-center {
                text-align: center !important;
            }

            /* Que hace: Clase de utilidad generica para centrar. util para imagenes, botones y tablas anidadas. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* Que hace: ajusta los estilos en pantallas peque&ntilde;as para mejorar la legibilidad */
            .email-container h1 {
                font-size: 20px !important;
                margin-bottom: 10px!important;
            }

            .email-container h1 a {
                margin-top: 10px;
            }

            .email-container h1 a {
                margin-bottom: 10px;
            }

            .email-container h2 {
                font-size: 16px !important;
                font-weight: normal!important;
            }

            .email-container p {
                font-size: 16px !important;
                font-weight: normal!important;
            }
        }

    </style>
    <!-- Mejoras progresivas : END -->

    <!-- Estilos solo para outlook no compatibles con tipografia web -->
    <!--[if mso]>
    <style type=”text/css”>
        .fallback-font {
            font-family: Arial, sans-serif!important;
        }
    </style>
    <![endif]-->
    <!-- Estilos solo para outlook no compatibles con tipografia web END -->



</head>
<!--
  El color de fondo del correo electronico (#222222) se define en tres lugares:
    1. Body Tag: para la mayoria de los clientes de correo electronico
    2. Central Tag: para aplicaciones moviles de Gmail e Inbox y versiones web de Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
    3. mso condicional: para Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f6f6f6;">
  <center style="width: 100%; background-color: #f6f6f6;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f6f6f6;">
    <tr>
    <td>
    <![endif]-->

        <!-- Texto de encabezado oculto visualmente : BEGIN -->
        <div class="fallback-font" style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Montserrat', sans-serif;">
            Canjea tus Monster Miles por productos
        </div>
        <!-- Texto de encabezado oculto visualmente : END -->

        <!-- Cree un espacio en blanco despues del texto de vista previa deseado para que los clientes de correo electronico no tomen otro texto que distraiga en la vista previa de la bandeja de entrada. Extender segun sea necesario. -->
        <!-- Vista previa Hack de espaciado de texto : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Montserrat', sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Vista previa Hack de espaciado de texto : END -->


        <!-- Tabla con imagen de fondo al 100% del ancho del mail -->
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
                <td background="https://librecomunicacion.net/clientes/monster/fondo.jpg" bgcolor="#000000" valign="middle">
                    <!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;">
                    <v:fill type="tile" src="https://librecomunicacion.net/clientes/monster/fondo.jpg" color="#000000" />
                    <v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
                    <![endif]-->
                    <div>
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="email-container">
                            <tr style="line-height: 0;">
                                <td style="text-align: center; line-height: 0;" class="center-on-narrow">
                                    <img src="https://librecomunicacion.net/clientes/monster/logo.png" width="500" height="" alt="header transparente" border="0" style="width: 100%; max-width: 500px; height: auto; ">
                                </td>
                            </tr>
                        </table>
                    </div>
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
                </td>
            </tr>
        </table>
        <!-- Tabla con imagen de fondo al 100% del ancho del mail end -->



        <!-- Cuerpo del Email : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto; background-color: #ffffff;" class="email-container">

          <!-- Texto-->
          <tr style="background-color: #85bf00;">
              <td style="padding: 10px; vertical-align: middle;">
                  
                  <h1 class="fallback-font" style="margin: 0px!important; font-family: 'Montserrat', sans-serif; font-size: 18px; color: #FFFFFF; text-align: center; font-weight: 700;">
                      <strong>USUARIO HABILITADO</strong>
                  </h1>

              </td>
          </tr>
          <!-- Texto end-->

          <!-- Texto-->
          <tr style="background-color: #FFFFFF;">
              <td style="padding: 40px; padding-bottom: 0;">

                  <h2 class="fallback-font" style="margin: 0 0 10px; font-family: 'Montserrat', sans-serif; font-size: 20px; line-height: 30px; color: #575756; text-align: center; font-weight: 700;">
                      <strong>Hola {{ $user->name }}, </strong>
                  </h2>

                  <p class="fallback-font" style="margin: 0 0 10px; font-family: 'Montserrat', sans-serif; font-size: 16px; line-height: 26px; color: #575756; text-align: center; font-weight: 400;">
                      Ya estas aprobado y habilitado para ingresar a la plataforma Monster Miles y canjear puntos por productos.
                  </p>

                  <p class="fallback-font" style="margin: 0 0 10px; font-family: 'Montserrat', sans-serif; font-size: 16px; line-height: 26px; color: #575756; text-align: center; font-weight: 400;">
                      Si pensas que existe alguna equivocación con este mensaje por favor escribinos a <a style="color: #85bf00;" href="mailto:info@monstermiles.com">info@monstermiles.com</a>
                  </p>

              </td>
          </tr>
          <!-- Texto end-->

          <!-- PUNTOS RESTANTES -->
          <tr>
            <td style="padding: 40px; padding-bottom: 0;">

                <h3 class="fallback-font" style="margin: 0 0 10px; font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; color: #575756; text-align: center; font-weight: 700;">
                    <strong>En este momento tenés {{ number_format($user->points, 0, ',', '.') }} Monster Miles en tu cuenta.</strong>
                </h3>

            </td>
          </tr>
          <!-- PUNTOS RESTANTES end -->

          <!-- IMG : BEGIN -->
          <tr>
              <td style="text-align: center">
                  <img src="https://librecomunicacion.net/clientes/monster/productos.jpg" width="600" height="" alt="productos monster miles" border="0" style="width: 100%; max-width: 600px; height: auto; background: #ffffff; margin: auto; display: block; margin-bottom: 0;" class="g-img">
              </td>
          </tr>
          <!-- IMG : END -->

          <!-- Boton : BEGIN -->
          <tr style="background-color: #000000;">
              <td style="background-color: #000000; text-align: center; padding: 40px;">

                <p class="fallback-font" style="margin: 0 0 10px; font-family: 'Montserrat', sans-serif; font-size: 16px; line-height: 26px; color: #FFFFFF; text-align: center; font-weight: 400;">
                  <strong>Entrá ya mismo a la plataforma y canjea puntos por productos</strong>
                </p>
                  <!-- Button : BEGIN -->
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                      <tr>
                          <td class="button-td button-td-primary" style="border-radius: 4px; background: #85bf00;">
                              <a class="fallback-font button-a button-a-primary" target="_blank" rel="noopener" href="#" style="background: #85bf00; border: 1px solid #85bf00; font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; font-weight: 700; text-decoration: none; padding: 13px 17px; color: #FFFFFF; display: block; border-radius: 4px;">INGRESAR
                              </a>
                          </td>
                      </tr>
                  </table>
                  <!-- Button : END -->
              </td>
          </tr>
          <!-- Boton : END -->

          <!-- RRSS : BEGIN -->
          <tr style="background-color: #f6f6f6;">
              <td style="background-color: #f6f6f6;">
                  <table cellspacing="0" cellpadding="0" border="0" width="100%" align="center">
                      <tr>
                          <td style="padding: 20px; text-align: center;">

                              <a target="_blank" href="#" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: none;"><img data-file-id="374627" height="20" src="https://gallery.mailchimp.com/0b2bb5a0f281db7cdf23e47a3/images/e68ccd8b-8c21-4d8e-acae-a0b21432a3cf.png" style="border: 0px;width: 20px;height: 20px;margin: 0px;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="20"></a>

                              &nbsp;&nbsp;

                              <a target="_blank" href="#" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: none;"><img data-file-id="374635" height="20" src="https://gallery.mailchimp.com/0b2bb5a0f281db7cdf23e47a3/images/34ecbe94-68b6-4612-9779-fd4cac0889b1.png" style="border: 0px;width: 20px;height: 20px;margin: 0px;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="20"></a>

                              &nbsp;&nbsp;

                              <a target="_blank" href="#" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: none;"><img data-file-id="374631" height="20" src="https://gallery.mailchimp.com/0b2bb5a0f281db7cdf23e47a3/images/8bc56989-11be-4375-87c5-17dcc1bcd33b.png" style="border: 0px;width: 20px;height: 20px;margin: 0px;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="20"></a>
                          </td>

                      </tr>

                  </table>
              </td>
          </tr>
          <!-- RRSS : END -->

        </table>
        <!-- Cuerpo del Email : END -->

  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  </center>
</body>
</html>