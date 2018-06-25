<?php

namespace Mostafaznv\ReadMore;

use DOMWrap\Document;

class ReadMore
{
    /**
     * Read more selector.
     *
     * @var string
     */
    protected $readMoreTag;

    /**
     * Flag to strip tags or not.
     *
     * @var bool
     */
    protected $stripTags;

    /**
     * Max depth to find read more container.
     *
     * @var integer
     */
    protected $maxDepth;



    /**
     * ReadMore constructor.
     */
    public function __construct()
    {
        $config = config('read-more');

        $this->readMoreTag = $config['read_more_tag'];
        $this->stripTags = $config['strip_tags'];
        $this->maxDepth = $config['max_depth'];
    }


    /**
     * Generate summary from input html.
     *
     * @param $html
     * @return null
     */
    public function generate($html)
    {
        $doc = new Document();
        $doc->html($html);

        $doc = $this->detectTag($doc);

        if ($doc) {
            $precedingHtml = '';
            $precedingAll = $doc->find('body')->find('[readmore=true]')->precedingAll();

            foreach ($precedingAll as $item)
                $precedingHtml = $item->getOuterHtml() . $precedingHtml;


            $readMoreContainer = $doc->find('body')->find('[readmore=true]')->first();
            $readMoreContainerPrecedingContent = '';

            foreach ($readMoreContainer->find($this->readMoreTag)->precedingAll() as $item)
                $readMoreContainerPrecedingContent = $item->getOuterHtml() . $readMoreContainerPrecedingContent;


            $html = $precedingHtml . $readMoreContainerPrecedingContent;

            if ($this->stripTags)
                return strip_tags($html);

            return $html;
        }

        return null;
    }

    /**
     * Detect read-more tag in input html
     *
     * @param Document $doc
     * @return Document|null
     */
    protected function detectTag(Document $doc)
    {
        $depth = 0;
        $readmoreTag = $doc->find($this->readMoreTag)->first();

        if ($readmoreTag) {
            $tag = $readmoreTag;

            while ($tag) {
                if ($depth > $this->maxDepth)
                    return null;

                if ($tag->parent()->nodeName == 'body') {
                    $tag->attr('readmore', 'true');

                    return $doc;
                }

                $tag = $tag->parent();
                $depth++;
            }
        }

        return null;
    }
}