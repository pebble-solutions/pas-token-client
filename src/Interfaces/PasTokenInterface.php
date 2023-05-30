<?php

namespace Pebble\Security\PAS\Interfaces;

interface PasTokenInterface {

    /**
     * Décode un PASToken afin de renseigner l'objet
     * 
     * @param string $pasToken
     * 
     * @return self
     */
    public function decode(?string $pasToken = null): self;

    /**
     * Récupère le PAS Token depuis le header d'authorization HTTP
     * 
     * @return self
     */
    public function getTokenFromAuthorizationHeader(): self;

    /**
     * Affecte la valeur sub
     * 
     * @param string $sub
     * 
     * @return self
     */
    public function setSub(string $sub): self;

    /**
     * Affecte la valeur type
     * 
     * @param int $type
     * 
     * @return self
     */
    public function setType(int $type): self;

    /**
     * Affecte la valeur db
     * 
     * @param string $db
     * 
     * @return self
     */
    public function setDb(string $db): self;

    /**
     * Affecte la valeur login
     * 
     * @param string $login
     * 
     * @return self
     */
    public function setLogin(string $login): self;

    /**
     * Affecte la valeur name
     * 
     * @param string $name
     * 
     * @return self
     */
    public function setName(?string $name = null): self;

    /**
     * Affecte la valeur iat
     * 
     * @param int $iat
     * 
     * @return self
     */
    public function setIat(?int $iat = null): self;

    /**
     * Affecte la valeur exp
     * 
     * @param int $exp
     * 
     * @return self
     */
    public function setExp(?int $exp = null): self;

    /**
     * Récupère la valeur sub
     * 
     * @return string
     */
    public function getSub(): string;

    /**
     * Récupère la valeur login
     * 
     * @return string
     */
    public function getLogin(): string;

    /**
     * Récupère la valeur db
     * 
     * @return string
     */
    public function getDb(): string;

    /**
     * Récupère la valeur type
     * 
     * @return string
     */
    public function getType(): int;

    /**
     * Récupère la valeur iss : nom de la licence émétrice du PasToken
     * 
     * @return string
     */
    public function getIss(): string;

    /**
     * Affecte la valeur iss : nom de la licence émétrice du PasToken
     * 
     * @param int $iss
     * 
     * @return self
     */
    public function setIss(string $iss): self;
}