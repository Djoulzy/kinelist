<?php

namespace App\Service;

// use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class CheckPermissions
{
    private $accessDecisionManager;
    private $tokenStorage;
    private $authorizationChecker;

    /**
     * Constructor
     * 
     * @param TokenStorageInterface $tokenStorage
     * @param AccessDecisionManagerInterface $accessDecisionManager
     */
    public function __construct(TokenStorageInterface $tokenStorage, AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function isGranted($attributes)
    {
        if (!is_array($attributes)) {
            if (strpos($attributes, ',') !== false)
                $attributes = explode(',', $attributes);
            else $attributes = [$attributes];
        }

        $token = $this->tokenStorage->getToken();

        return ($this->accessDecisionManager->decide($token, $attributes, null, true));
    }

    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}