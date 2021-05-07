<?php

/**
 * Class MailManager
 */
class MailManager {

    // FOR MAIL VERIFICATION
    static public function mailVerification(array $array): string {
        return ' <html lang="fr"> ' .
            '<body> ' .
            '<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;500&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">' .
            '<div style="background-color: #fff; width: 100%; height: auto;padding: 50px 0 150px 0;font-family: \'Montserrat\', sans-serif; color : #fff;">
                        <div style="background-color: #111C30; width: 80%;max-width: 700px; height: auto; margin:50px auto; ">
                            <img alt="Hungry Nuggets" src="' . $array['imgTop'] . '" style="width: 100%;">
                            <br>
                            <h1 style="margin: 60px 60px 35px 60px; color: #fff; font-weight:600; letter-spacing: 1px;">Bienvenue ' . $array['user']['nickname_admin'] . ' !</h1>
                            <h3 style="font-family:\'Dosis\', sans-serif; color : #fff;margin: 0 60px;font-weight: 300;font-size:26px;">Ton compte administrateur à bien été créé ! Encore deux petites étapes et c\'est finis, dans un premier temps nous avons besoin de savoir si ton adresse mail est la bonne, clique sur le lien suivant pour nous le confirmer :</h3>
                            <div style="margin: 15px 60px;">
                                <a href="https://monitoring.hungry nuggets.com/?connection&registration&user=' . urlencode($array['user']['nickname_admin']) . '&key=' . urlencode($array['user']['confirmation_key_admin']) . '" style="text-decoration: none; color: #F4CA34; font-weight: 300;font-size: 20px;">https://monitoring.hungry nuggets.com/<br>?connection&amp;registration&user=' . urlencode($array['user']['nickname_admin']) . '&key=' . urlencode($array['user']['confirmation_key_admin']) . '</a>
                            </div>
                            <h3 style="font-family:\'Dosis\', sans-serif; color : #fff;margin: 0 60px;font-weight: 300;font-size:26px;">Ensuite un des administrateurs déjà actif examinera ta candidature, si tu as le feu vert, tu recevras un petit message et tu pourras te connecter tout de suite après ! </h3>
                            <hr style="width: 70% ;border-bottom: 1px solid #F4CA34; margin : 40px auto;">
                            <div>
                                <p style="font-family:\'Dosis\', sans-serif; color : #fff;margin: 0 60px;font-weight: 300;font-size:22px;">
                                <span style="text-decoration: none; color: #F4CA34; font-weight: 300;">Nota Bene</span> : 
                                    <br><br>
                                    Ton pseudo est : <span style="font-weight: 700;">' . $array['user']['nickname_admin'] . '</span><br>
                                    Ton mot de passe est : secret ;)
                                    <br><br>
                                   Tu pourras changer tes infos personnels par la suite, mais garde les précieusement, tu en auras besoin pour te connecter !
                                    </p>
                            </div>
                            <hr style="width: 70% ;border-bottom: 1px solid #F4CA34; margin : 40px auto;">
                            <div style="text-align: center;">
                            <img alt="Hungry Nuggets" src="' . $array['imgBottom'] . '" style="width: 40%; margin : 45px auto 100px 45px;">
</div>
                        </div>
                        <p style="font-size: 0.6em; letter-spacing: 1px; text-align: center; color : #111">HUNGRY NUGGETS © 2021 Hungry Nuggets, All rights reserved.</p>
                        </div>
                    </body>
                </html>';
    }

    // MAIL ON NEW CONFIRMED VERIFICATION
    static public function mailValidation(array $array): string {
    return ' <html lang="fr"> ' .
        '<body> ' .
        '<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;500&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">' .
        '<div style="background-color: #fff; width: 100%; height: auto;padding: 50px 0 150px 0;font-family: \'Montserrat\', sans-serif; color : #fff;">
                        <div style="background-color: #111C30; width: 80%;max-width: 700px; height: auto; margin:50px auto; ">
                        <img alt="Hungry Nuggets" src="' . $array['imgTop'] . '" style="width: 100%;">
                            <br>
                           <h1 style="margin: 60px 60px 35px 60px; color: #fff; font-weight:600; letter-spacing: 1px;">Hello !</h1>
                            <h3 style="font-family:\'Dosis\', sans-serif; color : #fff;margin: 0 60px;font-weight: 300;font-size:26px;">Le monitoring des sites Hungry Nuggets à accueillis un nouvel utilisateur et il vient de confirmer son adresse e-mail ! <span style="color:#F4CA34;">'.$array['user'].'</span>  est déjà visible dans le tableau de bord et attend le feu vert :)</h3>
                            <hr style="width: 70% ;border-bottom: 1px solid #F4CA34; margin : 40px auto;">
                            <div style="text-align: center; width: 100%;">
                            <img alt="Hungry Nuggets" src="' . $array['imgBottom'] . '" style="width: 40%; margin : 45px auto 100px auto;">
</div>
                        </div>
                        <p style="font-size: 0.6em; letter-spacing: 1px; text-align: center; color : #111">HUNGRY NUGGETS © 2021 Hungry Nuggets, All rights reserved.</p>
                        </div>
                    </body>
                </html>';
    }
}