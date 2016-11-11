<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YaUser
 *
 * @ORM\Table(name="ya_user")
 * @ORM\Entity
 */
class YaUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=200, nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="passwd", type="string", length=64, nullable=false)
     */
    private $passwd;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=200, nullable=false)
     */
    private $nickname;



    /**
     * Get uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return YaUser
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set passwd
     *
     * @param string $passwd
     *
     * @return YaUser
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get passwd
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return YaUser
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }
}
