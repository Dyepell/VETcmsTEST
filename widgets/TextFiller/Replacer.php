<?php
namespace TextFiller;

abstract class Replacer
{
    abstract public function renderButton(TextFiller $textFiller);
    abstract public function replace(TextFiller $textFiller): bool;
    abstract public function output(TextFiller $textFiller);
}