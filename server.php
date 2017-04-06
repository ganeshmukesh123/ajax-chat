<?php
//lets fetch the value of lastdisplayedchatid
$data=$_REQUEST;
$lastdisplayedchatid=$data['lastdisplayedchatid'];

//connecting to mysql server
$con=mysqli_connect("localhost","root","","chatroom");
//chat is table name
//If username and usercomment is available then
//add it in table chats

if(
	isset($data['username'])&&
	isset($data['usercomment'])){

	$insert ="INSERT INTO chat( user_name,user_comment)
              VALUES('".$data['username']."','".$data['usercomment']."')
              ";
    $insert_result = mysqli_query($con,$insert);
}

$select="SELECT *
            FROM chat
            WHERE chat_id > '".$lastdisplayedchatid."'
            ";

$result = mysqli_query($con,$select);
$arr =array();
$row_count=mysqli_num_rows($result);


if($row_count>0){
	while($row=mysqli_fetch_array($result)){
		array_push($arr, $row);
	}
}


//close mysqli connection
mysqli_close($con);

//return the response as JSON
echo json_encode($arr);
?>