<?php

$servername = "192.168.0.252";
$database = "drdpdam.db";
$username = "root";
$password = "";

// Create connection

/*$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";
*/
$conn='';
try {
		  $conn=connect($servername, $username, $password, $database); 
		} catch (Exception $e) { 
		  echo 'unConnected to database'; 
		}

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

function connect($servername, $username, $password, $database) { 
		   try { 
		      $mysqli = new mysqli($servername, $username, $password, $database); 
		      $connected = true; 
		   } catch (mysqli_sql_exception $e) { 
		      throw $e; 
		   } 
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
