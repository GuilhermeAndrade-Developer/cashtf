    <!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

    <head>
        <meta charset="utf-8"> <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Tell iOS not to automatically link certain text strings. -->
        <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

        <!-- Web Font / @font-face : BEGIN -->
        <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

        <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
        <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

        <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
        <!--[if !mso]><!-->
        <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
        <!--<![endif]-->

        <!-- Web Font / @font-face : END -->

        <!-- CSS Reset : BEGIN -->
        <style>
            /* What it does: Remove spaces around the email design added by some email clients. */
            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
            }

            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            /* What it does: Centers email on Android 4.4 */
            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }

            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }

            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode: bicubic;
            }

            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
                text-decoration: none;
            }

            /* What it does: A work-around for email clients meddling in triggered links. */
            a[x-apple-data-detectors],
            /* iOS */
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

            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }

            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
                color: inherit !important;
            }

            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img+div {
                display: none !important;
            }

            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */

            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u~div .email-container {
                    min-width: 320px !important;
                }
            }

            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u~div .email-container {
                    min-width: 375px !important;
                }
            }

            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
                u~div .email-container {
                    min-width: 414px !important;
                }
            }
        </style>

        <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
        <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

        <!-- CSS Reset : END -->

        <!-- Progressive Enhancements : BEGIN -->
        <style>
            /* What it does: Hover styles for buttons */
            .button-td,
            .button-a {
                transition: all 100ms ease-in;
            }

            /* Media Queries */
            @media screen and (max-width: 600px) {

                /* What it does: Adjust typography on small screens to improve readability */
                .email-container p {
                    font-size: 15px !important;
                }

            }
        </style>
    </head>

    <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fff;">
        <center style="width: 100%; background-color: #fff;">
            <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fff;">
    <tr>
    <td>
    <![endif]-->

            <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
            <!-- Preview Text Spacing Hack : BEGIN -->
            <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
            </div>
            <!-- Preview Text Spacing Hack : END -->

            <div style="max-width: 600px; margin: 0 auto; padding-top: 40px; padding-bottom: 40px; background-color: #fff;" class="email-container">
                <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->

                <!-- Email Body : BEGIN -->
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">

                    <tr>
                        <td style="padding: 20px 0; text-align: center; background-color: #fff;">
                            <img src="https://cashtf.com/images/logo.png" border="0" style="height: auto; background: #fff; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #ffffff;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding: 100px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #6A6A6A;">
                                        <h1 style="text-align:center; margin: 0 0 10px 0; font-family: sans-serif; font-size: 21px; line-height: 26px; color: #6A6A6A; font-weight: normal;">
                                            Olá <b>{{$data['name']}}</b>, infelizmente sua solicitação <b>não foi aprovada!</b><br>
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #FFFFFF; background-color: #00a7ff;">
                                        <p style="margin: 0; text-align:center">
                                            Precisa de ajuda? <a href="https://cashtf.com/" style="color: #fff; text-decoration: underline;">clique aqui</a>
                                        </p>
                                        <p style="margin: 0; text-align:center; margin-top: 10px;">
                                            Para saber mais sobre a <b>cashTF</b>, acesse nosso <a href="https://cashtf.com/" style="color: #fff; text-decoration: underline;">site</a>
                                        </p>
                                        <p style="margin: 0; text-align:center; margin-top: 10px;">
                                            Copyright ® 2020 <b>cashTF</b>. Todos os direitos reservados
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>

                <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </div>

            <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
        </center>
    </body>

    </html>
