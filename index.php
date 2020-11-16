  
<?php 

  $validator->validateRequestType('GET');
  $validator->response(401,'You may not access the index page');

?>