  
<?php 

$createPostExample = [
	"title" => "this is an example title",
	"description" => "this is an example description"
];

echo "Supported routes";

echo "https://phpwebservice.herokuapp.com/api/createPost";

echo json_encode($createPostExample);



?>