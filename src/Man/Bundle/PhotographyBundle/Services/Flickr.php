<?php
namespace Man\Bundle\PhotographyBundle\Services;

/**
 *
 * @author mantoine
 *
 */
class Flickr extends AbstractService
{
    /**
     *
     * @var name service
     */
    protected $service = "man_photography.services.flickr";

    /**
     *
     * @var \Rezzza\Flickr\ApiFactory
     */
    protected $client;

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
        $this->client = $this->container->get('rezzza.flickr.client');

    }

    /**
     * Getter for oauthTokenSecret
     *
     * @author mantoine
     * @since 28 juil. 2014 15:09:26
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
     * @since 28 juil. 2014 15:09:26
     * @param string $value
     * @return Flickr
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
     * @since 28 juil. 2014 15:08:48
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
     * @since 28 juil. 2014 15:08:48
     * @param string $value
     * @return Flickr
     */
    public function setOAuthToken($value)
    {
        $this->oauthToken = $value;

        return $this;
    }




// https://www.flickr.com/services/api/

    /**
     * https://www.flickr.com/services/api/flickr.photos.getInfo.html
     *
     * @param string $id, photo_id (Obligatoire)
     * @return SimpleXMLElement
     */
    public function getPhotosInfo($id)
    {
        $this->client->getMetadata()->setOauthAccess($this->oauthToken, $this->oauthTokenSecret);
        $data = $this->client->call('flickr.photos.getInfo', [
            'photo_id' => $id,
        ]);

        return $data;
    }

    /**
     * https://www.flickr.com/services/api/flickr.photos.getSizes.html
     *
     * @param string $id, photo_id (Obligatoire)
     * @return SimpleXMLElement
     */
    public function getPhotosSizes($id)
    {
        $this->client->getMetadata()->setOauthAccess($this->oauthToken, $this->oauthTokenSecret);
        $data = $this->client->call('flickr.photos.getSizes', [
            'photo_id' => $id,
            ]);

        return $data;
    }

    /**
     * https://www.flickr.com/services/api/flickr.photosets.getPhotos.html
     * @param unknown $id, the photosets identifiant
     *
     * @return multitype:multitype:string  SimpleXMLElement
     */
    public function getPhotosetsPhotos($id)
    {
        $this->client->getMetadata()->setOauthAccess($this->oauthToken, $this->oauthTokenSecret);
        $data = $this->client->call('flickr.photosets.getPhotos', [
            'photoset_id' => $id,
            'privacy_filter' => 1,
        ]);

        return $data;
    }

    public function getPhotosetsList()
    {
        $this->client->getMetadata()->setOauthAccess($this->oauthToken, $this->oauthTokenSecret);
        $data = $this->client->call('flickr.photosets.getList', []);

        return $data;
    }
}