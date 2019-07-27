<?php

namespace YusufKandemir\MicrodataParser;

class MicrodataDOMDocument extends \DOMDocument {

    /** @var \DOMXPath */
    public $xpath;

    /**
     * Get top-level items of the document
     *
     * @see https://www.w3.org/TR/2018/WD-microdata-20180426/#dfn-top-level-microdata-item
     *
     * @return \DOMNodeList List of top level items as elements
     */
    public function getItems(): \DOMNodeList {
        return $this->xpath->query('//*[@itemscope and not(@itemprop)]');
    }

    /**
     * {@inheritdoc}
     * Also assigns $xpath with DOMXPath of freshly loaded DOMDocument
     */
    public function loadHTML($source, $options = 0) {
        libxml_use_internal_errors(true);

        $return = parent::loadHTML($source, $options);

        $this->xpath = new \DOMXPath($this);

        libxml_clear_errors();


        return $return;
    }


    /** 
     * {@inheritdoc}
     * Also assigns $xpath with DOMXPath of freshly loaded DOMDocument
     */
    public function loadHTMLFile($filename, $options = 0) {
        $return = parent::loadHTMLFile($filename, $options);

        $this->xpath = new \DOMXPath($this);

        return $return;
    }

}
