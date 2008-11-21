<?php

/**
 * User form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nickname'       => new sfWidgetFormInput(),
      'first_name'     => new sfWidgetFormInput(),
      'last_name'      => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'interest_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'Question')),
      'relevancy_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Answer')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'nickname'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'first_name'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'interest_list'  => new sfValidatorPropelChoiceMany(array('model' => 'Question', 'required' => false)),
      'relevancy_list' => new sfValidatorPropelChoiceMany(array('model' => 'Answer', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['interest_list']))
    {
      $values = array();
      foreach ($this->object->getInterests() as $obj)
      {
        $values[] = $obj->getQuestionId();
      }

      $this->setDefault('interest_list', $values);
    }

    if (isset($this->widgetSchema['relevancy_list']))
    {
      $values = array();
      foreach ($this->object->getRelevancys() as $obj)
      {
        $values[] = $obj->getAnswerId();
      }

      $this->setDefault('relevancy_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInterestList($con);
    $this->saveRelevancyList($con);
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
    $c->add(InterestPeer::USER_ID, $this->object->getPrimaryKey());
    InterestPeer::doDelete($c, $con);

    $values = $this->getValue('interest_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Interest();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setQuestionId($value);
        $obj->save();
      }
    }
  }

  public function saveRelevancyList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['relevancy_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RelevancyPeer::USER_ID, $this->object->getPrimaryKey());
    RelevancyPeer::doDelete($c, $con);

    $values = $this->getValue('relevancy_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Relevancy();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setAnswerId($value);
        $obj->save();
      }
    }
  }

}
