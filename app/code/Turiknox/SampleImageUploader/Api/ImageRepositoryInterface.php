<?php
/*
 * Turiknox_SampleImageUploader

 * @category   Turiknox
 * @package    Turiknox_SampleImageUploader
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\SampleImageUploader\Api;

use Turiknox\SampleImageUploader\Api\Data\ImageInterface;

/**
 * @api
 */
interface ImageRepositoryInterface
{
    /**
     * Save page.
     *
     * @param ImageInterface $image
     * @return ImageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(ImageInterface $image);

    /**
     * Retrieve Image.
     *
     * @param int $imageId
     * @return ImageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($imageId);

    /**
     * Delete image.
     *
     * @param ImageInterface $image
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(ImageInterface $image);

    /**
     * Delete image by ID.
     *
     * @param int $imageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($imageId);
}
