<?php
/**
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 15/07/2017
 * Time: 10:48
 */

namespace Pablo\DeliveryZones\Model\Config\Structure;

use Magento\Config\Model\Config\Structure\Converter;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\TemplateEngine\Xhtml\Compiler;
use Magento\Framework\View\TemplateEngine\Xhtml\CompilerInterface;

class Reader extends \Magento\Config\Model\Config\Structure\Reader
{
    /**
     * Reader constructor.
     * @param \Magento\Framework\Config\FileResolverInterface $fileResolver
     * @param Converter $converter
     * @param \Magento\Config\Model\Config\SchemaLocator $schemaLocator
     * @param \Magento\Framework\Config\ValidationStateInterface $validationState
     * @param CompilerInterface $compiler
     * @param string $fileName
     * @param array $idAttributes
     * @param string $domDocumentClass
     * @param string $defaultScope
     */
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        Converter $converter,
        \Magento\Config\Model\Config\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        CompilerInterface $compiler,
        $fileName = 'Pablodeliveryzones' . 'system.xml',
        array $idAttributes = [],
        $domDocumentClass = 'Magento\Framework\Config\Dom',
        $defaultScope = 'global')
    {
        parent::__construct($fileResolver, $converter, $schemaLocator, $validationState, $compiler, $fileName, $idAttributes, $domDocumentClass, $defaultScope);
    }
}