<?php

/**
 * Interest form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Tomohiro MITSUMUNE <tmitsumune@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseInterestForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'question_id' => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputHidden(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'question_id' => new sfValidatorPropelChoice(array('model' => 'Question', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('interest[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Interest';
  }


}
