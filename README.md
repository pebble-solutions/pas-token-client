# pas-token-client

Cette librairie permet de contrôler les token générés par Pebble Authenticator Server

## Installation

Créer le fichier _composer.json_ à la racine de votre projet si il n'existe pas déjà.

Ajouter la configuration suivante :

```JSON
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/pebble-solutions/pas-token-client"
        },
        {
            "type": "vcs",
            "url": "https://github.com/pebble-solutions/rsa-key-manager"
        }
    ],
    "require": {
        "pebble/pas-token-client": "dev-main"
    },
    "minimum-stability": "dev"
}
```

Mettez à jour votre projet via composer

```
composer update
```

Si votre projet n'est pas encore initalisé, créez un fichier _.gitignore_ à la racine et ajoutez la ligne suivante :

```
vendor/
```

## Configuration

Créer le dossier _/var/credentials/_ à la racine de votre projet et ajouter un fichier _pas.key.pub_ valide (voir la documentation concernant les clés publiques de pebble authenticator server.

## Utilisation

Si votre projet n'utilisait pas composer, ajouter la ligne suivante dans votre fichier racine (ex : index.php)

```PHP
require('vendor/autoload.php');
```

### Contrôler un token passé via l'en-tête Authorization

```PHP
use Pebble\Security\PAS\PasToken;

try {
  $token = new PasToken();
  $token->getTokenFromAuthorizationHeader()->decode();
  echo $token->getLogin();
}
catch (Throwable $e) {
  echo "Error : ".$e->getMessage();
}
```

### Contrôler un token récupéré précédemment


```PHP
use Pebble\Security\PAS\PasToken;

$monToken = "Un token à contrôler";

try {
  $token = new PasToken();
  $token->decode($monToken);
  echo $token->getLogin();
}
catch (Throwable $e) {
  echo "Error : ".$e->getMessage();
}
```
