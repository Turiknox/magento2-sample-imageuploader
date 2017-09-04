<?php
/*
 * Turiknox_SampleImageUploader

 * @category   Turiknox
 * @package    Turiknox_SampleImageUploader
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\SampleImageUploader\Controller\Adminhtml\Image;

use Turiknox\SampleImageUploader\Controller\Adminhtml\Image;

class Edit extends Image
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $imageId = $this->getRequest()->getParam('image_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Turiknox_SampleImageUploader::image')
            ->addBreadcrumb(__('Images'), __('Images'))
            ->addBreadcrumb(__('Manage Images'), __('Manage Images'));

        if ($imageId === null) {
            $resultPage->addBreadcrumb(__('New Image'), __('New Image'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Image'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Image'), __('Edit Image'));
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Image'));
        }
        return $resultPage;
    }
}
