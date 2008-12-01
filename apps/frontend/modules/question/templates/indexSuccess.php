<?php use_helper("Text") ?>

<h1>popular questions</h1>

<?php foreach ($question_list as $question): ?>
<div class="question">
    <div class="interested_block">
        <?php include_partial("interested_user", array("question" => $question)) ?>
    </div>

    <h2><?php echo link_to($question->getTitle(), "question/show?stripped_title=".$question->getStrippedTitle()) ?></h2>

    <div class="question_body">
        <?php echo truncate_text($question->getBody(), 200) ?>
    </div>
</div>
<?php endforeach; ?>
