<?php
    require "dbinfo.php";
    require "RestService.php";
    require "Data.php";

// Before running this demo, you need to create a database in MySQL called
// wsDatas and populate it using the script wsDatas_mysql.sql.  You also need
// to edit the fields in dbinfo.php to refer to the database you are using.
//
// There is limited error handling in this code in order to keep the code as simple as
// possible.
 
class DataRestService extends RestService 
{
	private $data;
    
	public function __construct() 
	{
		// Passing in the string 'Datas' to the base constructor ensures that
		// all calls are matched to be sure they are in the form http://server/Data/x/y/z 
		parent::__construct("data");
	}

	public function performGet($url, $parameters, $requestBody, $accept) 
	{
		switch (count($parameters))
		{
			case 1:
				// Note that we need to specify that we are sending JSON back or
				// the default will be used (which is text/html).
				header('Content-Type: application/json; charset=utf-8');
				// This header is needed to stop IE cacheing the results of the GET	
				header('no-cache,no-store');
				$this->getAllData();
				echo json_encode($this->data);
				break;
				
			default:	
				$this->methodNotAllowedResponse();
		}
	}

	public function performPost($url, $parameters, $requestBody, $accept) 
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$newData = $this->extractDataFromJSON($requestBody);
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$sql = "insert into data (typeOfForce, tactic, total) values (?, ?, ?)";
			// We pull the fields of the Data into local variables since 
			// the parameters to bind_param are passed by reference.
			$statement = $connection->prepare($sql);
			$typeOfForce = $newData->getTypeOfForce();
			$tactic = $newData->getTactic();
			$total = $newData->getTotal();
			$statement->bind_param('sssssd', $typeOfForce, $tactic, $total);
			$result = $statement->execute();
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			$connection->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}
		}
	}

	public function performPut($url, $parameters, $requestBody, $accept) 
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$newData = $this->extractDataFromJSON($requestBody);
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$sql = "update data set typeOfForce = ?, tactic = ?, total = ? where typeOfForce = ?";
			// We pull the fields of the Data into local variables since 
			// the parameters to bind_param are passed by reference.
			$statement = $connection->prepare($sql);
			$typeOfForce = $newData->getTypeOfForce();
			$tactic = $newData->getTactic();
			$total = $newData->getTotal();
			$statement->bind_param('sssssdi', $typeOfForce, $tactic, $total);
			$result = $statement->execute();
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			$connection->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}
		}
	}

    public function performDelete($url, $parameters, $requestBody, $accept) 
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		
		if (count($parameters) == 2)
		{
			$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
			if (!$connection->connect_error)
			{
				$typeOfForce = $parameters[1];
				$sql = "delete from data where typeOfForce = ?";
				$statement = $connection->prepare($sql);
				$statement->bind_param('i', $typeOfForce);
				$result = $statement->execute();
				if ($result == FALSE)
				{
					$errorMessage = $statement->error;
				}
				$statement->close();
				$connection->close();
				if ($result == TRUE)
				{
					// We need to return the status as 204 (no content) rather than 200 (OK) since
					// we are not returning any data
					$this->noContentResponse();
				}
				else
				{
					$this->errorResponse($errorMessage);
				}
			}
		}
    }

    private function getAllData()
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "SELECT typeOfForce, tactic, total FROM small_case_data";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->data[] = new Data($row["typeOfForce"], $row["tactic"], $row["total"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}	  

    private function extractDataFromJSON($requestBody)
    {
		// This function is needed because of the perculiar way json_decode works. 
		// By default, it will decode an object into a object of type stdClass.  There is no
		// way in PHP of casting a stdClass object to another object type.  So we use the
		// approach of decoding the JSON into an associative array (that's what the second
		// parameter set to true means in the call to json_decode). Then we create a new
		// Data object using the elements of the associative array.  Note that we are not
		// doing any error checking here to ensure that all of the items needed to create a new
		// Data object are provtype$typeOfForceed in the JSON - we really should be.
		$dataArray = json_decode($requestBody, true);
		$data = new Data($dataArray['typeOfForce'],
						 $dataArray['tactic'],
						 $dataArray['total']);
		unset($dataArray);
		return $data;
	}
}
?>
