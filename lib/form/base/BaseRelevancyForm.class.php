<?php

/**
 * Relevancy form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Tomohiro MITSUMUNE<tmitsumune@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRelevancyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'answer_id'  => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'score'      => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'answer_id'  => new sfValidatorPropelChoice(array('model' => 'Answer', 'column' => 'id', 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'score'      => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('relevancy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Relevancy';
  }


}
