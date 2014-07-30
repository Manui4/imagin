<?php
namespace Man\Bundle\ManuiaBundle\Services;

use TwitterOAuth\Api;

/**
 *
 * @author mantoine
 *
 */
class Twitter extends AbstractService
{
    /**
     *
     * @var name service
     */
    protected $service = "man_manuia.services.twitter";

    /**
     *
     * @var string
     */
    protected $apiKey;

    /**
     *
     * @var string
     */
    protected $secret;

    /**
     *
     * @var string
     */
    protected $oauthToken;

    /**
     *
     * @var string
     */
    protected $oauthTokenSecret;

    /**
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }

    /**
     * Getter for oauthTokenSecret
     *
     * @author mantoine
     * @since 30 juil. 2014 16:31:38
     * @return string protected variable $oauthTokenSecret
     */
    public function getOAuthTokenSecret()
    {
        return $this->oauthTokenSecret;
    }

    /**
     * Setter for oauthTokenSecret
     *
     * @author mantoine
     * @since 30 juil. 2014 16:31:38
     * @param string $value
     * @return Twitter
     */
    public function setOAuthTokenSecret($value)
    {
        $this->oauthTokenSecret = $value;

        return $this;
    }

    /**
     * Getter for oauthToken
     *
     * @author mantoine
     * @since 30 juil. 2014 16:31:09
     * @return string protected variable $oauthToken
     */
    public function getOAuthToken()
    {
        return $this->oauthToken;
    }

    /**
     * Setter for oauthToken
     *
     * @author mantoine
     * @since 30 juil. 2014 16:31:09
     * @param string $value
     * @return Twitter
     */
    public function setOAuthToken($value)
    {
        $this->oauthToken = $value;

        return $this;
    }

    /**
     * Getter for secret
     *
     * @author mantoine
     * @since 30 juil. 2014 16:30:53
     * @return string protected variable $secret
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Setter for secret
     *
     * @author mantoine
     * @since 30 juil. 2014 16:30:53
     * @param string $value
     * @return Twitter
     */
    public function setSecret($value)
    {
        $this->secret = $value;

        return $this;
    }

    /**
     * Getter for apiKey
     *
     * @author mantoine
     * @since 30 juil. 2014 16:30:34
     * @return string protected variable $apiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Setter for apiKey
     *
     * @author mantoine
     * @since 30 juil. 2014 16:30:34
     * @param string $value
     * @return Twitter
     */
    public function setApiKey($value)
    {
        $this->apiKey = $value;

        return $this;
    }

    public function getUserTimeline($limit = 10)
    {
        $cnx = new Api($this->apiKey, $this->secret, $this->oauthToken, $this->oauthTokenSecret);

        $tweets = $cnx->get('statuses/user_timeline', [
            'count' => $limit
        ]);

        return $tweets;
    }
}