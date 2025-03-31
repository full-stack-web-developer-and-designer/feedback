<?php include 'inc/header.php';?>
<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

// Form submit
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $body = $_POST['body'];
  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = $_POST['name'];
    // check if name only contains letters and whitespace	
    if (!preg_match("/^[a-zàèòùšđčćžA-ZŠĐČĆŽ\s]*$/", $name)) {
    $name_error = "Name and surname can only contain letters and a space!";
    }
  }
  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'The e-mail address is not valid!';
    }
  }
  // Validate body
  if (empty($_POST['body'])) {
    $bodyErr = 'Feedback is required';
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zàèòùšđčćžA-ZŠĐČĆŽ0-9 ,.!?\'\"]*$/", $body)) {
      $bodyErr = "Feedback content cannot be special characters!";
    }
  }
  if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    // add to database
    $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";
    if (mysqli_query($conn, $sql)) {
      // success
      echo "<script>
window.location = \"https://feedback.mirnesglamocic.com/feedback.html\"
</script>";
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>
    <img src="./img/MirnesGlamocic.png" class="w-25 mb-3" alt="Web Developer, UI/UX and Web Designer from Bosnia and Herzegovina">
    <h1>Feedback</h1>
    <?php echo isset($name) ? $name : ''; ?>
    <p class="lead text-center">Leave feedback for Mirnes Glamočić</p>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ?
          'is-invalid': null; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ?
          'is-invalid': null; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
        <div class="invalid-feedback">
        <?php echo $emailErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $bodyErr ?
          'is-invalid':null; ?>" id="body" name="body" placeholder="Enter your feedback"><?php echo $body; ?></textarea>
          <div class="invalid-feedback">
          <?php echo $bodyErr; ?>
        </div>
      </div>
      
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>
