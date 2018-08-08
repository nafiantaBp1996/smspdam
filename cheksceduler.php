<?php

$servername = "192.168.0.252";
$database = "drdpdam.db";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

$sql = "select * from senddata";
$result = mysqli_query($conn, $sql);
if ($result) 
	{
      	if (mysqli_num_rows($result)>0)
			{
      			kirim();
                
			}
		else
			{
      		echo "Data Kosong";
			}

	}
else{
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

mysqli_close($conn);


function kirim()
{
	$ch = curl_init("http://103.81.246.52:20003/sendsms?");
	$fields_string  ="account=eimspdamprob&password=123456&numbers=6285233270426&content=TES";
 
	//set the url, number of POST vars, POST data

	curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
	curl_setopt($ch,CURLOPT_POSTFIELDS, json_decode($fields_string));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type:application/json,Content-Type:application/json'));

	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);
 
    echo "<pre>";
    print_r($result); 
    echo "</pre>";
}

?>

<?php
/*        $fields_string  =   "";
        $fields     =   array(
                            'api_key'       =>  '9de7b24n',
                            'api_secret'    =>  '1135c4afaafeac30',
                            'to'            =>  '+6289699935552',
                            'from'          =>  "Nuris Akbar",
                            'text'          =>  "Testing SMS Dari Nexmo"
        );
        $url        =   "https://rest.nexmo.com/sms/json";
 
        //url-ify the data for the POST
	foreach($fields as $key=>$value) { 
            $fields_string .= $key.'='.$value.'&'; 
            }
	rtrim($fields_string, '&');
 
		//open connection
	$ch = curl_init();
 
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
 
	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);
 
        echo "<pre>";
        print_r($result); 
        echo "</pre>";
*/?>
