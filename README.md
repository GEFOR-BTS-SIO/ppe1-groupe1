<<<<<<< HEAD

=======
>>>>>>> 79dcd8b (modification README)
# Trombinoscope
Trombinoscope de l'école Gefor
## Configuration necessaire
            Version
PHP         8.2.0
MySql       8.0.31
Apache      2.4.54.2

## Installation

Effectuer les commandes ci-dessous dans l'ordre :

Installer le projet en local
    Ouvrir une console et faire :
    - `git clone https://github.com/GEFOR-BTS-SIO/ppe1-groupe1`
    Suivi de :
    - `symfony composer install`
  
Créer et mettre à jour la base de données :
    Ouvrir le fichier ENV et le paramétrer 
    - `DATABASE_URL="mysql://root@127.0.0.1:3306/projetx?serverVersion=8&charset=utf8mb4"`
    Puis effectuer dans la console 
    - `symfony console doctrine:schema:update --force`
  
Lancer le server symfony
- `symfony server:start`
  
Ouvrir un navigateur et saisir l'adresse :
- `localhost:8000`
#   p p e 1 - g r o u p e 1 
