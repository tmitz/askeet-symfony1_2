<?php

class Relevancy extends BaseRelevancy
{
    public function save(PropelPDO $con = null)
    {
        $con = Propel::getConnection();
        try {
            $con->beginTransaction();
            $ret = parent::save();

            $answer = $this->getAnswer();
            if($this->getScore() == 1) {
                $answer->setRelevancyUp($answer->getRelevancyUp() + 1);
            } else {
                $answer->setRelevancyDown($answer->getRelevancyDown() + 1);
            }
            $answer->save($con);

            $con->commit();

            return $ret;

        } catch (sfException $e) {
            $con->rollBack();
            throw $e;
        }
    }
    
}
