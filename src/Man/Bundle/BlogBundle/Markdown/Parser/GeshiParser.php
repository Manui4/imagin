<?php

namespace Man\Bundle\BlogBundle\Markdown\Parser;

use Knp\Bundle\MarkdownBundle\Parser\Preset\Max as BaseParser;
use GeSHi;

class GeshiParser extends BaseParser
{

//    public function _doFencedCodeBlocks_callback($matches) 
//    {
//        $codeblock = $matches[2];
//        $codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);
//        $codeblock = preg_replace_callback('/^\n+/',
//                array(&$this, '_doFencedCodeBlocks_newlines'), $codeblock);
//        $geshi = new GeSHi($codeblock, 'php');
//        $code = $geshi->parse_code();
//        
//        $codeblock = '<code>' . $code . '</code>';
//        return $this->hashBlock($codeblock);
//    }
}