<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= SITE_NAME; ?></title>
    </head>
    <body style="padding:50px 0; margin:0;background-color: #ececec; font-family: sans-serif;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="font-family:sans-serif">
            <tbody>
                <tr>
                    <td style="border-top:5px solid #3b6f85;font-family:sans-serif;font-size:15px">
                        <table width="600" border="0" cellpadding="0" cellspacing="0" style="width:600px;margin:0 auto;background-color:yellow">
                            <tbody>
                                <tr>
                                    <td align="center" style="text-align:center;padding:10px 0px 10px; border-bottom:1px solid #ccc;">
                                        <a href="<?= base_url(); ?>" style="text-decoration:none;display:inline-block" target="_blank" >
                                        <img alt="<?= SITE_NAME; ?>-logo" src="<?= base_url("assets/frontend/img/chapter-logo-1.png"); ?>" style="width: 100px;" >
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family:sans-serif;padding:15px 20px">
                                        <?= $email_message; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center">
                                        <div style="height:10px"></div>
                                        </p>
                                        <div style="height:20px"></div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr style="background-color:#fff; padding:5px">
                                    <td style="text-align: center;"><a target="_blank" href="<?= base_url(); ?>">Go to Code Bank</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>