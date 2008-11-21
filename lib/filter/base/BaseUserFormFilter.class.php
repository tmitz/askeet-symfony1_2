<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * User filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Tomohiro MITSUMUNE<tmitsumune@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nickname'       => new sfWidgetFormFilterInput(),
      'first_name'     => new sfWidgetFormFilterInput(),
      'last_name'      => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'interest_list'  => new sfWidgetFormPropelChoice(array('model' => 'Question', 'add_empty' => true)),
      'relevancy_list' => new sfWidgetFormPropelChoice(array('model' => 'Answer', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nickname'       => new sfValidatorPass(array('required' => false)),
      'first_name'     => new sfValidatorPass(array('required' => false)),
      'last_name'      => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'interest_list'  => new sfValidatorPropelChoice(array('model' => 'Question', 'required' => false)),
      'relevancy_list' => new sfValidatorPropelChoice(array('model' => 'Answer', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

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

    $criteria->addJoin(InterestPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InterestPeer::QUESTION_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InterestPeer::QUESTION_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addRelevancyListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(RelevancyPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RelevancyPeer::ANSWER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RelevancyPeer::ANSWER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Text',
      'nickname'       => 'Text',
      'first_name'     => 'Text',
      'last_name'      => 'Text',
      'created_at'     => 'Date',
      'interest_list'  => 'ManyKey',
      'relevancy_list' => 'ManyKey',
    );
  }
}
