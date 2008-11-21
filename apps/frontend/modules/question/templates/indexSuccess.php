<?php use_helper("Text") ?>

<h1>popular questions</h1>

<?php foreach ($question_list as $question): ?>
<div class="question">
    <div class="interested_block">
        <div class="interested_mark" id="mark_<?php echo $question->getId() ?>">
            <?php echo count($question->getInterests()) ?> 
        </div>
    </div>

    <h2><?php echo link_to($question->getTitle(), "question/show?id=".$question->getId()) ?></h2>

    <div class="question_body">
        <?php echo truncate_text($question->getBody(), 200) ?>
    </div>
</div>
<?php endforeach; ?>
