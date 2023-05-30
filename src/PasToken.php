<?php

namespace Pebble\Security\PAS;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Pebble\Security\PAS\Interfaces\PasTokenInterface;
use Pebble\Security\RSA\RsaKey;

class PasToken implements PasTokenInterface {

    /**
     * UID de l’utilisateur firebase
     */
    private string $sub;

    /**
     * Nom de la licence émétrice du PasToken
     */
    private string $iss;

    /**
     * Niveau global utilisateur entre 1 et 6. Tous les utilisateurs affectés à la licence disposent de ce niveau. Ce niveau détermine 
     * les droits généraux de l'utilisateur sur les données de l'API.
     * 1 : Utilisateur connecté
     * 2 : Utilisateur standard
     * 3 : Utilisateur VIP
     * 4 : Backoffice
     * 5 : Administrateur
     * 6 : Root (super-administrateur)
     */
    private int $type;

    /**
     * Syntaxe Version 1
     * Serveur d’accès à l’API. Il s’agit de l’URL racine de l’API sans le http.
     * Ex : local.fe.tld
     * 
     * Syntaxe Version 2
     * Nom de la base de données à connecter sur le serveur d’API.
     * Le serveur d’API doit disposer d’un utilisateur autorisé à se connecter à la base de données ciblée.
     * Format : database@host:port
     * Le port est facultatif.
     * Ex : 75ipz34ud@localhost
     */
    private string $db;

    /**
     * Nom d’utilisateur. Il s’agit majoritairement de l’adresse mail
     */
    private string $login;

    /**
     * Nom sous lequel l’utilisateur sera connu et affiché (displayName)
     */
    private ?string $name = null;

    /**
     * Issued at time : timestamp d’émission du token
     */
    private ?int $iat = null;

    /**
     * Timestamp d’expiration du token.
     */
    private ?int $exp = null;

    /**
     * PAS Token d'origine
     */
    private string $token;

    /**
     * Décode un PASToken afin de renseigner l'objet
     * @param string $pasToken
     * @return self
     */
    public function decode(?string $pasToken = null): self
    {
        if ($pasToken) $this->token = $pasToken;

        $user = JWT::decode($this->token, new Key((new RsaKey('pas'))->getPublicKey(), 'RS256'));

        $this->setSub($user->sub);
        $this->setIss($user->iss);
        $this->setType($user->type);
        $this->setDb($user->db);
        $this->setLogin($user->login);
        $this->setName($user->name);
        $this->setIat($user->iat);
        $this->setExp($user->exp);

        return $this;
    }

    /**
     * Get the value of sub
     * 
     * @return string
     */ 
    public function getSub(): string
    {
        return $this->sub;
    }

    /**
     * Set the value of sub
     *
     * @return  self
     */ 
    public function setSub(string $sub): self
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * Get the value of type
     * 
     * @return int
     */ 
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of db
     * 
     * @return string
     */ 
    public function getDb(): string
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb(string $db): self
    {
        $this->db = $db;

        return $this;
    }

    /**
     * Get the value of login
     * 
     * @return string
     */ 
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of name
     * 
     * @return ?string
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of iat
     * 
     * @return ?int
     */ 
    public function getIat(): ?int
    {
        return $this->iat;
    }

    /**
     * Set the value of iat
     *
     * @return  self
     */ 
    public function setIat(?int $iat = null): self
    {
        $this->iat = $iat;

        return $this;
    }

    /**
     * Get the value of exp
     * 
     * @return ?int
     */ 
    public function getExp(): ?int
    {
        return $this->exp;
    }

    /**
     * Set the value of exp
     *
     * @return  self
     */ 
    public function setExp(?int $exp = null): self
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Récupère le token depuis le header d'authorization HTTP.
     * 
     * @return self
     */
    public function getTokenFromAuthorizationHeader(): self
    {
        $headers = apache_request_headers();

        $auth = $headers['Authorization'];
        $this->token = str_replace('Bearer ', '', $auth);

        return $this;
    }

    /**
     * Get nom de la licence émétrice du PasToken
     * 
     * @return string
     */ 
    public function getIss(): string
    {
        return $this->iss;
    }

    /**
     * Set nom de la licence émétrice du PasToken
     * 
     * @param string $iss
     *
     * @return  self
     */ 
    public function setIss(string $iss): self
    {
        $this->iss = $iss;

        return $this;
    }
}