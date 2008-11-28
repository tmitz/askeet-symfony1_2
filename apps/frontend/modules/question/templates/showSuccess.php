<?php use_helper('Date') ?>
 
<div class="interested_block">
  <?php include_partial("interested_user", array("question" => $question)) ?>
</div>
 
<h2><?php echo $question->getTitle() ?></h2>
 
<div class="question_body">
  <?php echo $question->getBody() ?>
</div>
 
<div id="answers">
<?php foreach ($question->getAnswers() as $answer): ?>
  <div class="answer">
    posted by <?php echo $answer->getUser() ?> 
    on <?php echo format_date($answer->getCreatedAt(), 'p') ?>
    <div>
      <?php echo $answer->getBody() ?>
    </div>
  </div>
<?php endforeach; ?>
</div>
