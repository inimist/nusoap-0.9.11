
<?php

  ini_set('display_errors', true);
  
  error_reporting(E_ALL);
  require_once('db.config.php');
  require_once('lib/nusoap.php82.php');
  
  $error  = '';
  
  $result = array();
  
  $wsdl = "http://localhost/nusoap-0.9.5/server.php?wsdl";
  
  if(isset($_POST['sub'])){

    $isbn = trim($_POST['isbn']);

    if(!$isbn){

      $error = 'ISBN cannot be left blank.';
    }

    if(!$error){

      //create client object
      $client = new nusoap_client($wsdl, true);

      $err = $client->getError();

      if ($err) {

        echo '<h2>Constructor error</h2>' . $err;

          exit();
      }

      try {

        $result = $client->call('fetchBookData', array($isbn));

        $result = json_decode($result);

        }catch (Exception $e) {

          echo 'Caught exception: ',  $e->getMessage(), "\n";
       }
    }
  }

?>

  <div class='row'>

   <form class="form-inline" method = 'post' name='form1'>

     <?php if($error) { ?> 

       <div class="alert alert-danger fade in">

         <a href="#" class="close" data-dismiss="alert">&times;</a>
         <strong>Error!</strong>&nbsp;<?php echo $error; ?> 

         </div>

   <?php } ?>

     <div class="form-group">

       <label for="email">ISBN:</label>

       <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Enter ISBN">

     </div>

     <button type="submit" name='sub' class="btn btn-default">Fetch Book Information</button>

   </form>

  </div>

  <h2>Book Information</h2>

<table class="table">

  <thead>

    <tr>

      <th>Title</th>

      <th>Author</th>

      <th>Price</th>

      <th>ISBN</th>

      <th>Category</th>

    </tr>

  </thead>

  <tbody>

  <?php 
  if( $result ){ 
?>
        <tr>

          <td><?php echo $result->title; ?></td>

          <td><?php echo $result->author_name; ?></td>

          <td><?php echo $result->price; ?></td>

          <td><?php echo $result->isbn; ?></td>  

          <td><?php echo $result->category; ?></td>

        </tr>

             <?php 

    } else {  ?>

      <tr>

          <td colspan='5'>Enter ISBN and click on Fetch Book Information button</td>

        </tr>

    <?php } ?>

  </tbody>

</table>