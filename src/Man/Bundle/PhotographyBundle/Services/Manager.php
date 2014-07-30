<?php
namespace Man\Bundle\PhotographyBundle\Services;


/**
 *
 * @author mantoine
 *
 */
class Manager extends AbstractService
{
    /**
     *
     * @var name service
     */
    protected $service = "man_photography.services.manager";

    /**
     * @var array
     */
    protected $photosetsIdToUnset;

    /**
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }

    /**
     *  Getter for photosetsIdToUnset
     *
     * @author mantoine
     * @since 29 juil. 2014 14:37:40
     * @return array protected variable $photosetsIdToUnset
     */
    public function getPhotosetsIdToUnset()
    {
        return $this->photosetsIdToUnset;
    }

    /**
     * Setter for photosetsIdToUnset
     *
     * @author mantoine
     * @since 29 juil. 2014 14:37:40
     * @param array $value
     * @return Manager
     */
    public function setPhotosetsIdToUnset($value)
    {
        $this->photosetsIdToUnset = $value;

        return $this;
    }

    public function getFlickrPictures(){
        $pictures = [];
        /* @var $serviceFlickr Flickr */
        $serviceFlickr = $this->container->get('man_photography.service.flickr');

        $photosets = $serviceFlickr->getPhotosetsList();
        $photosets = $photosets->xpath('//photosets/photoset');
        foreach ($photosets as $photoset){
            $photoset = json_decode(json_encode((array) $photoset), 1);
            $photosetId = $photoset['@attributes']['id'];
            if ( in_array($photosetId, $this->photosetsIdToUnset)){
                continue;
            }
            $photos = $serviceFlickr->getPhotosetsPhotos($photosetId);
            $photos = $photos->xpath('//photoset/photo');
            $photosInfo = [];
            foreach ($photos as $photo){
                $photo = json_decode(json_encode((array) $photo), 1);
                $photoId = $photo['@attributes']['id'];
                $photoInfo = $serviceFlickr->getPhotosInfo($photoId);
                $photoInfo = json_decode(json_encode((array) $photoInfo), 1);

                $photoSizes = $serviceFlickr->getPhotosSizes($photoId);
                $photoSizes = json_decode(json_encode((array) $photoSizes), 1);
                $photosInfo[$photoId] =[
                    'info' => $photoInfo,
                    'sizes' => $photoSizes,
                ];
            }

            $pictures[$photosetId] = [
                'title'=> $photoset['title'],
                'description'=> empty($photoset['description']) ? '' : $photoset['description'],
                'photos'=> $photosInfo
            ];
        }

        return $pictures;
    }

}