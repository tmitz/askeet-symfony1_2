<?php

class Question extends BaseQuestion
{
    public function setTitle($v) {
        parent::setTitle($v);

        $this->setStrippedTitle(myTools::stripText($v));
    }
}
