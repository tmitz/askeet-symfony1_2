<?php

class Interest extends BaseInterest
{
    public function save(PropelPDO $con = null)
    {
        $con = Propel::getConnection();
        try {
            $con->beginTransaction();
            $ret = parent::save($con);

            $question = $this->getQuestion();
            $interested_users = $question->getInterestedUsers();
            $question->setInterestedUsers($interested_users + 1);
            $question->save();

            $con->commit();
            return $ret;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }
}
