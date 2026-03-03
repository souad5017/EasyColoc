<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Invitation Colocation</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f3f4f6;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" 
                       style="background:#ffffff; padding:40px; border-radius:12px;">

                    <!-- Title -->
                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <h2 style="margin:0; color:#16a34a;">
                                Invitation à rejoindre une colocation 🏠
                            </h2>
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="color:#374151; font-size:15px; line-height:1.6;">

                            <p>Bonjour,</p>

                            <p>
                                <strong>{{ $invitation->sender->name }}</strong> 
                                vous a invité à rejoindre la colocation :
                                <strong>{{ $invitation->colocation->name }}</strong>.
                            </p>

                            <p>
                                Cliquez sur le bouton ci-dessous pour accepter l'invitation.
                            </p>

                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding:30px 0;">
                            <a href="{{ url('/invitations/accept/'.$invitation->token) }}"
                               style="background-color:#16a34a; 
                                      color:#ffffff; 
                                      padding:14px 28px; 
                                      text-decoration:none; 
                                      border-radius:8px; 
                                      font-weight:bold;">
                                Accepter l'invitation
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="color:#9ca3af; font-size:12px; text-align:center;">
                            Si vous n'êtes pas concerné, ignorez simplement cet email.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Colocation</title>
</head>
<body style="margin:0; padding:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#f8fafc; color: #1e293b;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:50px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" 
                       style="background:#ffffff; padding:0; border-radius:24px; overflow:hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">

                    <tr>
                        <td align="center" style="padding:40px 40px 20px 40px;">
                            <div style="background-color: #f0fdf4; width: 64px; height: 64px; line-height: 64px; border-radius: 100px; display: inline-block; margin-bottom: 20px;">
                                <span style="font-size: 32px;">🏠</span>
                            </div>
                            <h2 style="margin:0; color:#16a34a; font-size: 24px; font-weight: 800; letter-spacing: -0.5px;">
                                Rejoignez la colocation !
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 40px; color:#475569; font-size:16px; line-height:1.6; text-align: center;">
                            <p style="margin-bottom: 15px;">Bonjour,</p>
                            
                            <p style="margin-bottom: 20px;">
                                Bonne nouvelle ! <strong>{{ $invitation->sender->name }}</strong> 
                                vous a envoyé une invitation pour rejoindre la colocation :<br>
                                <span style="color: #1e293b; font-size: 20px; font-weight: 800; display: block; margin-top: 10px;">
                                    {{ $invitation->colocation->name }}
                                </span>
                            </p>

                            <p style="font-size: 14px; color: #64748b;">
                                Une fois membre, vous pourrez gérer les dépenses communes, suivre vos paiements et équilibrer les comptes facilement.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:40px;">
                            <a href="{{ url('/invitations/accept/'.$invitation->token) }}"
                               style="background-color:#16a34a; 
                                      color:#ffffff; 
                                      padding:16px 32px; 
                                      text-decoration:none; 
                                      border-radius:14px; 
                                      font-weight:bold;
                                      font-size: 16px;
                                      display: inline-block;
                                      box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);">
                                Accepter l'invitation
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px 40px; color:#94a3b8; font-size:12px; text-align:center;">
                            <p style="margin: 0 0 10px 0;">
                                Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer cet email en toute sécurité.
                            </p>
                            <p style="margin: 0; font-weight: bold; color: #64748b;">
                                &copy; {{ date('Y') }} EasyColoc. Tous droits réservés.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>