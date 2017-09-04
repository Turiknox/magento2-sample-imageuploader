<?php
/*
 * Turiknox_SampleImageUploader

 * @category   Turiknox
 * @package    Turiknox_SampleImageUploader
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\SampleImageUploader\Api\Data;

/**
 * @api
 */
interface ImageInterface
{
    const IMAGE_ID          = 'image_id';
    const IMAGE             = 'image';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get image
     *
     * @return string
     */
    public function getImage();


    /**
     * Set ID
     *
     * @param $id
     * @return ImageInterface
     */
    public function setId($id);

    /**
     * Set image
     *
     * @param $image
     * @return ImageInterface
     */
    public function setImage($image);
}
