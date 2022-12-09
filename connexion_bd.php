<?php



class DataLayer
{


    private $connexion;

    function __construct()
    {

        try {
            $this->connexion = new PDO("mysql:host=" . DB_HOSTNAME . "; dbname=" . DB_NAME, DB_USER, DB_PASS);

            //   echo " connexion réussie";


        } catch (PDOException  $th) {
            throw new Exception($th->getMessage(), 1);
        }
    }



    function getAllProducts(string $limit = "10",  string $categorie = null,  string $couleur = null, string $prix_inferieur = null, string $prix_superieur = null, $offset = "1")
    {

        $sql = "SELECT `article`.*, `categorie`.`titre` AS nom_categorie  FROM `article`, `categorie` WHERE `article`.`categorie` = `categorie`.`id`  ";

        try {
            if (!is_null($categorie) ||  !empty($categorie)) {

                $sql .= "  AND  `categorie`.`titre`  LIKE '%" .  $categorie . "%'";
            }
            if (!is_null($couleur) ||  !empty($couleur)) {

                $sql .= "  AND `article`.`couleur`  LIKE '%" .  $couleur . "%'";
            }

            if (!is_null($prix_inferieur) || is_numeric(($prix_inferieur))) {

                $sql .= "  AND `article`.`prix`  <=  " .  $prix_inferieur;
            }


            if (!is_null($prix_superieur) || is_numeric(($prix_superieur))) {

                $sql .= "  AND `article`.`prix`  >=  " .  $prix_superieur;
            }

            $sql .=  " LIMIT  $limit OFFSET $offset ;";

            // die($sql);

            $q =   $this->connexion->prepare($sql);


            $q->execute();

            $results = $q->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $th) {

            throw new Exception($th->getMessage(), 1);
        }
    }


    function getOneProductDetails(string $titre = null,  int $id = null, $limit = 1)
    {

        $sql = "SELECT `article`.*, `categorie`.`titre` AS nom_categorie  FROM `article`, `categorie` WHERE `article`.`categorie` = `categorie`.`id` ";

        try {

            if (!is_null($id) || is_numeric(($id))) {

                $sql .= "  AND `article`.`id`  = " .  $id;
            }

            if (!is_null($titre) ||  !empty($titre)) {

                $sql .= "  AND `article`.`titre`  LIKE '%" .  $titre . "%'";
            }

            $sql .=  " LIMIT  $limit ;";


            //  die($sql);

            $q =   $this->connexion->prepare($sql);


            $q->execute();

            $results = $q->fetch(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $th) {

            throw new Exception($th->getMessage(), 1);
        }
    }



    function getCategories()
    {

        $sql = "SELECT * FROM `categorie`;";

        try {
            $q =  $this->connexion->prepare($sql);
            $q->execute();

            $results = $q->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $th) {
            throw new Exception($th->getMessage(), 1);
        }
    }

    /**
     * Création d'un nouvel utilisateur
     * @return array $userDatas
     */

    function addUser( $userInfos)
    {

        $sql = " INSERT INTO `user` (email, nom, prenom, mot_de_passe) VALUES (:email, :nom, :prenom, :mot_de_passe) ";
        
      //  die($sql);

        try {

           
            $q =  $this->connexion->prepare($sql);

           // die($q);
           $r =  $q->execute(
            [
                ":email" =>$userInfos["email"],
                ":nom" => $userInfos["nom"],
                ":prenom" => $userInfos["prenom"],
                ":mot_de_passe" => password_hash($userInfos["mot_de_passe"], PASSWORD_BCRYPT)
            ]
        );

            if ($r) {

                
                $user = $this->authentifierUser( $userInfos["email"], $userInfos["mot_de_passe"]);

                   if ($user !== false) {
                 return $user;
                   }
                   else {
                    return  " erreur de récupération de l'utilisateur";
                   }
                

            } 

        } catch (PDOException $th) {
            throw new Exception($th->getMessage(), 1);
        }
    }


    /**
     * Authentification d'un utilisateur
     * @return array $userData
     */
    function authentifierUser(  string $userMail, string $userPass)
    {

        $sql = "SELECT * FROM `user` WHERE  `user`.`email` = :email ;";

        try {
            $q =  $this->connexion->prepare($sql);
            $q->execute( [ ":email" => $userMail]);

          $results = $q->fetch(PDO::FETCH_ASSOC);

        /*  var_dump($results);
          die();
*/
            if (  $results &&  password_verify($userPass, $results["mot_de_passe"])   ) {
              unset($results["mot_de_passe"]);

              return $results;


            }else {
               return false;
            }

        } catch (PDOException $th) {
            throw new Exception($th->getMessage(), 1);
        }
    }

    

    /*   array(
        ":nom_utilisateur" => $userInfos["nom_utilisateur"],
        ":nom" => $userInfos["nom"],
        ":prenom" => $userInfos["prenom"],
        ":mot_de_passe" => $userInfos["mot_de_passe"],
    ) */
}
