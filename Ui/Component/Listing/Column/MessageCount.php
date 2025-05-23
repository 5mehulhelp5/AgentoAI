<?php
namespace Genaker\MagentoMcpAi\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class MessageCount extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['conversation_data'])) {
                    $conversationData = json_decode($item['conversation_data'], true);
                    $item[$this->getData('name')] = isset($conversationData['messages']) 
                        ? count($conversationData['messages']) 
                        : 0;
                } else {
                    $item[$this->getData('name')] = 0;
                }
            }
        }

        return $dataSource;
    }
}
