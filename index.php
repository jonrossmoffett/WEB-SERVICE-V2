  
<?php 

$createPostExample = [
	"title" => "this is an example title",
	"description" => "this is an example description"
];

echo "Supported routes \n";

echo "https://phpwebservice.herokuapp.com/api/createPost \n";

echo json_encode($createPostExample);



?>