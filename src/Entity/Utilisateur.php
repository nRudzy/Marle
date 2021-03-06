<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Utilisateur
 *
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(
 *     fields={"nni"},
 *     message="Le NNI que vous avez indiqué est déjà utilisé."
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="nni", type="string", length=10, unique=true, nullable=false)
     * @ORM\Id
     * @Groups("repro:read")
     */
    private $nni;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères.")
     */
    private $password;

    /**
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères.")
     * @Assert\EqualTo(propertyPath="confirmPassword", message="Mots de passes non identiques.")
     */
    private $confirmPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     * @Groups("repro:read")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     * @Groups("repro:read")
     */
    private $prenom;

    /**
     * @var json
     * @ORM\Column(name="roles", type="json")
     * @Groups("repro:read")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reprographie", mappedBy="nni", cascade={"remove"})
     */
    private $repros;

    public function __construct()
    {
        $this->repros = new ArrayCollection();
    }

    /**
     * Set nni
     *
     * @param string $nni
     *
     * @return Utilisateur
     */
    public function setNni($nni)
    {
        $this->nni = $nni;

        return $this;
    }

    /**
     * Get nni
     *
     * @return string
     */
    public function getNni()
    {
        return $this->nni;
    }

    /**
     * Set nni
     *
     * @param string $passwd
     *
     * @return Utilisateur
     */
    public function setPassword($passwd)
    {
        $this->password = $passwd;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    public function setConfirmPassword($confirmpasswd)
    {
        $this->confirmPassword = $confirmpasswd;

        return $this;
    }

    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Utilisateur
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles.
     *
     * @return array
     *
     */
    public function getRoles()
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique((array)$roles);
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {

    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->nni;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }
}

