<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $question->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $question->getUserId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $question->getTitle() ?></td>
    </tr>
    <tr>
      <th>Body:</th>
      <td><?php echo $question->getBody() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $question->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $question->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('question/edit?id='.$question->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('question/index') ?>">List</a>
