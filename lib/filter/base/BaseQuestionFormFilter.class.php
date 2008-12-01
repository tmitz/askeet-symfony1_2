<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Question filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Tomohiro MITSUMUNE <tmitsumune@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseQuestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'title'            => new sfWidgetFormFilterInput(),
      'body'             => new sfWidgetFormFilterInput(),
      'interested_users' => new sfWidgetFormFilterInput(),
      'stripped_title'   => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'interest_list'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'title'            => new sfValidatorPass(array('required' => false)),
      'body'             => new sfValidatorPass(array('required' => false)),
      'interested_users' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stripped_title'   => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'interest_list'    => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('question_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addInterestListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(InterestPeer::QUESTION_ID, QuestionPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InterestPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InterestPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Question';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'title'            => 'Text',
      'body'             => 'Text',
      'interested_users' => 'Number',
      'stripped_title'   => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'interest_list'    => 'ManyKey',
    );
  }
}
