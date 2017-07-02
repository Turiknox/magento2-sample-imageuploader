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

use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Message\Manager;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Turiknox\SampleImageUploader\Api\ImageRepositoryInterface;
use Turiknox\SampleImageUploader\Api\Data\ImageInterface;
use Turiknox\SampleImageUploader\Api\Data\ImageInterfaceFactory;
use Turiknox\SampleImageUploader\Controller\Adminhtml\Image;
use Turiknox\SampleImageUploader\Model\Uploader;
use Turiknox\SampleImageUploader\Model\UploaderPool;

class Save extends Image
{
    /**
     * @var Manager
     */
    protected $_messageManager;

    /**
     * @var ImageRepositoryInterface
     */
    protected $_imageRepository;

    /**
     * @var ImageInterfaceFactory
     */
    protected $_imageFactory;

    /**
     * @var DataObjectHelper
     */
    protected $_dataObjectHelper;

    /**
     * @var UploaderPool
     */
    protected $_uploaderPool;

    /**
     * Save constructor.
     *
     * @param Registry $registry
     * @param ImageRepositoryInterface $imageRepository
     * @param PageFactory $resultPageFactory
     * @param Date $dateFilter
     * @param Manager $messageManager
     * @param ImageInterfaceFactory $imageFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param UploaderPool $uploaderPool
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        ImageRepositoryInterface $imageRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Manager $messageManager,
        ImageInterfaceFactory $imageFactory,
        DataObjectHelper $dataObjectHelper,
        UploaderPool $uploaderPool,
        Context $context
    )
    {
        parent::__construct($registry, $imageRepository, $resultPageFactory, $dateFilter, $context);
        $this->_messageManager   = $messageManager;
        $this->_imageFactory      = $imageFactory;
        $this->_imageRepository   = $imageRepository;
        $this->_dataObjectHelper  = $dataObjectHelper;
        $this->_uploaderPool = $uploaderPool;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('image_id');
            if ($id) {
                $model = $this->_imageRepository->getById($id);
            } else {
                unset($data['image_id']);
                $model = $this->_imageFactory->create();
            }

            try {
                $image = $this->getUploader('image')->uploadFileAndGetName('image', $data);
                $data['image'] = $image;

                $this->_dataObjectHelper->populateWithArray($model, $data, ImageInterface::class);
                $this->_imageRepository->save($model);
                $this->_messageManager->addSuccessMessage(__('You saved this image.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['image_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->_messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->_messageManager->addException($e, __('Something went wrong while saving the image:' . $e->getMessage()));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['image_id' => $this->getRequest()->getParam('image_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param $type
     * @return Uploader
     * @throws \Exception
     */
    protected function getUploader($type)
    {
        return $this->_uploaderPool->getUploader($type);
    }
}