<?php
/*
 * Turiknox_SampleImageUploader

 * @category   Turiknox
 * @package    Turiknox_SampleImageUploader
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\SampleImageUploader\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Turiknox\SampleImageUploader\Api\ImageRepositoryInterface;

abstract class Image extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'Turiknox_SampleImageUploader::image';

    /**
     * Image repository
     *
     * @var ImageRepositoryInterface
     */
    protected $_imageRepository;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Date filter
     *
     * @var Date
     */
    protected $_dateFilter;

    /**
     * Sliders constructor.
     *
     * @param Registry $registry
     * @param ImageRepositoryInterface $imageRepository
     * @param PageFactory $resultPageFactory
     * @param Date $dateFilter
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        ImageRepositoryInterface $imageRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Context $context

    ) {
        $this->_coreRegistry         = $registry;
        $this->_imageRepository      = $imageRepository;
        $this->_resultPageFactory    = $resultPageFactory;
        $this->_dateFilter = $dateFilter;
        parent::__construct($context);
    }
}