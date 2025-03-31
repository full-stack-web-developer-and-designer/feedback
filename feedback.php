<?php include 'inc/header.php'; ?>

<?php
$sql = 'SELECT * FROM feedback ORDER BY id DESC';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

   
  <h1>Past Feedback</h1>

  <?php if (empty($feedback)): ?>
    <p class="lead mt-3">There is no feedback</p>
  <?php endif; ?>

  <?php foreach ($feedback as $item): ?>
    <div class="card my-3 w-75">
     <div class="card-body text-center">
       <?php echo ucfirst($item['body']); ?>
       <div class="text-secondary mt-2">By <?php echo ucwords($item[
         'name'
       ]); ?> on <?php echo date_format(
   date_create($item['date']),
   'g:ia \o\n l jS F Y'
 ); ?></div>
     </div>
   </div>
  <?php endforeach; ?>
<?php include 'inc/footer.php'; ?>
