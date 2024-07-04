<?php
namespace TextFiller;

use MyUtility\MyUtility;

class SimpleTextReplacer extends Replacer
{
    private $outputText;

    public function renderButton(TextFiller $textFiller)
    {
        // TODO: Implement renderButton() method.
    }

    public function replace($textFiller): bool
    {
        $this->outputText = strtr($textFiller->input, $textFiller->phrases);
        return true;
    }

    public function output($textFiller)
    {
        echo $this->outputText;
    }
}
