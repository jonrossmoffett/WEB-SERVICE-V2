  
<?php 




?>

<h1>Supported Api routes</h1>

<br>

<h1>https://phpwebservice.herokuapp.com/api/createPost</h1>
<h2>Request Type: POST</h2>
<h2>headers: Authorization : JWT</h2>
<h2>Arguements:</h2>
<h3>"title" : "this is an example title"</h3>
<h3>"description" : "this is an example description for the post"</h3>

<br>

<h1>https://phpwebservice.herokuapp.com/api/deletePost</h1>
<h2>Request Type: DELETE</h2>
<h2>headers: Authorization : JWT</h2>
<h2>Arguements:</h2>
<h3>"postId" : 1</h3>

<br>

<h1>https://phpwebservice.herokuapp.com/api/updatePost</h1>
<h2>Request Type: POST</h2>
<h2>headers: Authorization : JWT</h2>
<h2>Arguements:</h2>
<h3>"postId" : 1</h3>
<h3>"title" : "example title for update"</h3>
<h3>"description" : "example description for updating post"</h3>

<br>

<h1>https://phpwebservice.herokuapp.com/api/getPosts</h1>
<h2>Request Type: GET</h2>
<h2>headers: Authorization : JWT</h2>
<h2>Arguements:</h2>
<h3>none</h3>


<br>

<h1>https://phpwebservice.herokuapp.com/api/register</h1>
<h2>Request Type: POST</h2>
<h2>headers: </h2>
<h2>Arguements:</h2>
<h3>"name" : "Jon-Ross"</h3>
<h3>"email" : "jrmoffett1@gmail.com"</h3>
<h3>"password" : "password1"</h3>


<br>

<h1>https://phpwebservice.herokuapp.com/api/login</h1>
<h2>Request Type: POST</h2>
<h2>headers: </h2>
<h2>Arguements:</h2>
<h3>"email" : "jrmoffett1@gmail.com"</h3>
<h3>"password" : "password1"</h3>


<br>

<h1>https://phpwebservice.herokuapp.com/api/getUsers</h1>
<h2>Request Type: GET</h2>
<h2>headers: Authorization : JWT</h2>
<h2>Arguements:</h2>
<h3>must have a role of admin</h3>
