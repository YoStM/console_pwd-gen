<?php

require './classes/Password.php';

require './classes/PwdGenerator.php';

use Classes\Password;

echo "Bienvenue !\nAvant de générer votre mot de passe nous allons vous poser quelques questions.\n";

$wrong_input = false;

do {
    echo "Pour la première question, vous avez le choix entre trois niveau de robustesse\n";
    echo 'Saisissez '.Password::STRONG." pour un niveau de robustesse élévé.\n";
    echo 'Saisissez '.Password::MEDIUM." pour un niveau de robustesse moyen.\n";
    echo 'Saisissez '.Password::WEAK." pour un niveau de robustesse faible.\n";
    $robustness = readline("Quel niveau de robustesse désirez-vous pour votre nouveau mot de passe ?\n");
    settype($robustness, 'integer');
    is_int($robustness) && Password::robustness_IsValid($robustness) ? $wrong_input = false : $wrong_input = true;
} while ($wrong_input);
echo 'Vous avez choisi un niveau de robustesse '.Password::display_robustnessAsStr($robustness)."\n";
sleep(1);
echo "Patientez pendant que le mot de passe est généré ... \n";
$pwd = new Password($robustness);
sleep(2);
echo "Voici votre nouveau mot de passe : \n";
echo $pwd->unvail_CharSequence();
