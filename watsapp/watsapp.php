<?php
session_start();
if(isset($_SESSION['logined']))
{

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	body{
		
	

	}
	.send{
		width: 40%;
		height: 400px;
		background-color: #888888;
		border-radius: 10px;
		margin: 10% auto;
		text-align: center;
		
	}
	.send input[type=number]
	{
		width: 70%;
		height: 40px;
		border: none;
		border-radius: 10px;
		margin-top: 50px;
		
	}
	.send input[type=file]
	{
		width: 70%;
		height: 50px;
		border: none;
		border-radius: 10px;
		margin-top: 50px;
		
		
		
	}
	.send button{
	width: 100px;
	height: 50px;
	border-radius: 7px;
	border: none;
	margin-top: 50px;
	cursor: pointer;
		
	}
	::placeholder{
		text-align: center;
	}
</style>
<body>
	<form method="post" action="" enctype="multipart/form-data">
	<div class="send">
		<div>
		<label style='font-size: 18px;font-weight: bold;'for="number">Number :</label>
		<input id='number' name='number' type="number" placeholder='With Area Code' required>
		</div>
	<div>
		
		<label style='font-size: 18px;font-weight: bold;' for="file">Upload : </label>
		<input id='file' name='file' type="file">
	</div>
		<button name='submit' type="submit">Submit</button>
	</div>
	</form>
</body>

<?php
	if(isset($_POST['submit']))
	{
	    
		if(isset($_POST['number']) and isset($_FILES['file']))
		{
		    $file = $_FILES['file']['name'];
		    $file_name  = md5($file.microtime()).substr($file,-5,5);
			move_uploaded_file($_FILES['file']['tmp_name'],'image/'.$file_name);
			$number = $_POST['number'];
			$apiURL = 'https://eu187.chat-api.com/instance220285/';
			$token = 'wzs5ybiwn02avn0k';
			$data = json_encode(array(
			'chatId'=>$number.'@c.us',
			'body'=>'https://plustor.ir/watsapp/image/'.$file_name,
			'filename'=>$file_name,
			'caption'=>'This File Send with Api'
			));

			$url = $apiURL.'sendFile?token='.$token;
			$options = stream_context_create(['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $data
			]
			]);
			$response = file_get_contents($url,false,$options);
            $data = json_decode($response,true);
            $message =  $data['message'];
            if($message == "")
            {
                echo '<script>alert("image not send");</script>';
            }
            else
            {
                echo '<script>alert("image send!!!");</script>';
            }
		}
	}
}
else
{
    header('location:login.php');
    exit();
}
?>