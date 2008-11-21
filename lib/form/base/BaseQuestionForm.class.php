<?php

/**
 * Question form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Tomohiro MITSUMUNE<tmitsumune@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseQuestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'title'         => new sfWidgetFormTextarea(),
      'body'          => new sfWidgetFormTextarea(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'interest_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Question', 'column' => 'id', 'required' => false)),
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'title'         => new sfValidatorString(array('required' => false)),
      'body'          => new sfValidatorString(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'interest_list' => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Question';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['interest_list']))
    {
      $values = array();
      foreach ($this->object->getInterests() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('interest_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInterestList($con);
  }

  public function saveInterestList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['interest_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InterestPeer::QUESTION_ID, $this->object->getPrimaryKey());
    InterestPeer::doDelete($c, $con);

    $values = $this->getValue('interest_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Interest();
        $obj->setQuestionId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
