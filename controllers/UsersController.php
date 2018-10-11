<?php


class UsersController extends Controller {

    private $_usersManager;
    private $_postsManager;
    private $_commentsManager;
    

    public function __construct() {
        $this->_usersManager = new UsersManager();
        $this->_postsManager = new PostsManager();
        $this->_commentsManager = new CommentsManager();
    }


    public function connexionPage() {
        startSession();
        require_once('view/connexion_view.php');
    }
    

    public function registrationPage() {
        require_once('view/registration_view.php');
    }
    

    public function mySpacePage() {

        if (isset($_SESSION['id'])) {
            require_once('view/mySpace_view.php');
        } 
        else {
            require_once('view/connexion_view.php');
        }
    }
    

    public function administrationPage() {

        if (isset($_SESSION['userStatus']) && $_SESSION['userStatus'] == 'admin') {

            $nbOfUsers = $this->_usersManager->count('users');
            $nbOfPosts = $this->_postsManager->count('posts');
            $nbOfReportedComments = $this->_commentsManager->countReportedComments();

            require_once('view/administration_view.php');
        } 
        else {
            parent::errorPage('Vous n\'avez pas les droits d\'accès à cette page.');
        }

    }
    

    public function contactPage() {
        require_once('view/contact_view.php');
    }
    
    
    public function userRegistration($formPseudo, $pass1, $pass2, $email) {
    
        $msg = '';
        $dbPseudo = $this->_usersManager->getPseudo($formPseudo);
        $dbEmail = $this->_usersManager->getEmail($email);
    
        if (empty($dbPseudo)) {
    
            if(empty($dbEmail)) {
    
                if (strlen($pass1) >= 7) {
    
                    if ($pass1 == $pass2) {
                        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
                        $pseudo = htmlspecialchars($formPseudo);
                        // $key = md5(microtime(TRUE)*100000);
            
                        $this->_usersManager->addUser($pseudo, $pass1, $email);
            
                        // $subject = 'Activez votre compte';
                        // $header = 'From:localhost.com/inscription';
                        // $msg = "Bienvenue sur Localhost, \n
                        //         Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou le copier/coller dans votre navigateur internet : \n
                                
                        //         http://localhost/projet_perso_openclassrooms/index.php?action=activation&log=" . urlencode($pseudo) . "&key=" . urlencode($key) .
                                
                        //         "\n ----------------------------------------- \n 
                        //         Ceci est un mail automatique, merci de ne pas y répondre";
                        
                        // mail(
                        //     $email, 
                        //     $subject, 
                        //     $msg, 
                        //     $header);
            
                        $msg = 'success';
                        startSession();
                        $_SESSION['registrationConfirmationMsg'] = 'Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.';
                    }
                    else {
                        $msg = 'Les mots de passe ne sont pas identiques';
                    } 
        
                } 
                else {
                    $msg = 'Votre mot de passe doit contenir au moins 7 caractères';
                }
    
            }
            else {
                $msg = 'Vous possédez déjà un compte lié à cet email';
            }
        } 
        else {
            $msg = 'Ce pseudo est déjà pris';
        }
    
        echo $msg;
    }
    
    
    public function userConnexion($pseudo, $formPass) {
    
        $msg = '';
        $bddPass = $this->_usersManager->getPass(htmlspecialchars($pseudo));
    
        if (!empty($bddPass)) {
    
            if (password_verify($formPass, $bddPass)) {
                $user = $this->_usersManager->getUser(htmlspecialchars($pseudo), $bddPass);
        
                session_start();
                $_SESSION['id'] = $user->id();
                $_SESSION['userStatus'] = $user->userStatus();
                $_SESSION['pseudo'] = htmlspecialchars($pseudo);
                $_SESSION['avatar'] = $user->avatar();
        
                $msg = 'success';
            }
            else { 
                $msg = 'Identifiant ou mot de passe incorrect'; // mot de passe incorrect
            }
    
        }
        else {
            $msg = 'Identifiant ou mot de passe incorrect'; // identifiant incorrect
        }
    
        echo $msg;
    }
    
    
    public function updateAvatar($fileName, $fileSize, $fileError, $fileTmpName) {
    
        if (isset($_SESSION['id']) && isset($_SESSION['userStatus'])) {
    
            $errorMsg = '';
            $maxSize = 10000000;
            $valid_expansions = array('jpg', 'jpeg', 'png', 'gif');
            $uploaded_expansion = strtolower( substr( strrchr($fileName, '.'), 1) );
    
            if ($fileError == 0) {
    
                if ($fileSize > 0 && $fileSize <= $maxSize) {
    
                    if (in_array($uploaded_expansion, $valid_expansions)) {
                        $path = 'public/members/avatars/' . $_SESSION['id'] . '.' . $uploaded_expansion;
    
                        // if (!file_exists($path)) {
                            $moving = move_uploaded_file($fileTmpName, $path);
                         

                            if ($moving) {
                                $newAvatarName = $_SESSION['id'] . '.' . $uploaded_expansion;
    
                                // ajout de l'avatar en bdd :
                                $this->_usersManager->updateAvatar($_SESSION['id'], $newAvatarName);
                                $_SESSION['avatar'] = $newAvatarName;
    
                                $this->mySpacePage();
                            }
                            else {
                                $errorMsg = 'Erreur lors de l\'importation de votre image';
                            }
                        // }
                    } 
                    else {
                        $errorMsg = 'L\'Extension de votre image est invalide';
                    }
                }
                else {
                    $errorMsg = 'La taille de votre image est invalide (jusqu\'à 10000000 octets)';
                }  
            }
            else {
                $errorMsg = 'Erreur lors du transfert de votre image';
            }
    
            if (!empty($errorMsg)) {
                @unlink($path);
                mySpacePage();
            }
        } 
        else {
            parent::errorPage('Vous ne pouvez pas effectuer cette action. Veuillez vous connecter.');
        }
    }

}

