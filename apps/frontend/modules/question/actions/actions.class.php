<?php

/**
 * question actions.
 *
 * @package    symfony
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class questionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->question_list = QuestionPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
//    $this->question = QuestionPeer::retrieveByPk($request->getParameter('id'));

    $c = new Criteria();
    $c->add(QuestionPeer::STRIPPED_TITLE, $request->getParameter("stripped_title"));
    $this->question = QuestionPeer::doSelectOne($c);

    $this->forward404Unless($this->question);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new QuestionForm();
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter('question'));
    if ($form->isValid())
    {
      $question = $form->save();

      $this->redirect('question/edit?id='.$question->getId());
    }
  }
}
