<?

$data_file = "data.json";
date_default_timezone_set('America/New_York');

if ($_SERVER["REQUEST_METHOD"] == "GET")
{

    // Handle query requests
    // This request is mostly done for you
    // You will need to load the list of stored tasks instead of using
    // the sample tasks
    if ($_GET["request"] == "query")
    {
	$data = get_data();
        // Search array of tasks
        foreach ($data as $idx => $task)
        {
            // Found the task - append status ok and respond
            if ($task["id"] == $_GET["id"])
            {
                $response = $task;
                $response["status"] = "ok";
                echo json_encode($response);
                exit();
            }
        }

        // Task with given ID doesn't exist
        $message = "No event matches that ID";
        $response = array("status" => "error", "message" => $message);
        echo json_encode($response);
    }
    else if ($_GET["request"] == "view")
    {
	$data = get_data();
	$s = $_GET["start"];
	$e = $_GET["end"];
	
        // Viewing tasks - just return all of them
	if ($_GET["view"] == "all"){

	   usort($data, function($a, $b){
	  	  if ($a["deadline"] == $b["deadline"]) {return 0;}
	  	  return ($a["deadline"] < $b["deadline"]) ? -1 : 1;
	  });
	
	   $response = array("status" => "ok", "events" => $data);
           echo json_encode($response);
	   
	} else {
	     $filtered_data = array_filter($data, function($elem) use($s, $e){
	  		 $d = $elem["deadline"];
			 return $d >= $s && $d <= $e;
	  });

	  usort($filtered_data, function($a, $b){
	  	  if ($a["deadline"] == $b["deadline"]) {return 0;}
	  	  return ($a["deadline"] < $b["deadline"]) ? -1 : 1;

	  });
	  

	  $response = array("status" => "ok", "events" => $filtered_data);
	  echo json_encode($response);
	    
	}
    }
    else
    {
        // Unknown request type was submitted
        $message = "Unrecognized request type";
        echo json_encode(array("status" => "error", "message" => $message));
    }
}


// *** POST ***
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Say whatever the user wanted to do was successful
    $action = $_POST["action"];
    $action .= $action[strlen($action) - 1] == "e" ? "d" : "ed";

    // *** CREATE ***
    if ($_POST["action"] == "create"){

      $data = get_data();
      $data[] =	array("id" => "4f946d528fe08", "name" => "New Years party stuff","deadline" => 1420001940,"notes" => "");

      $data = array_values($data);
      file_put_contents($data_file, json_encode($data));

      $message = "Successfully $action event";
      echo json_encode(array("status" => "ok", "message" => $message));
      exit();
    }

    // *** DELETE ***
    if ($_POST["action"] == "delete"){

       $data = get_data();

       foreach ($data as $idx => $task){
            if ($task["id"] == $_POST["id"]){
                unset($data[$idx]);
            }
        }

	$data = array_values($data);
	file_put_contents($data_file, json_encode($data));
        $message = "Successfully $action event";
        echo json_encode(array("status" => "ok", "message" => $message));
        exit();
    }

}
else
{
    // Unknown request type was submitted
    $message = "Unrecognized request type";
    echo json_encode(array("status" => "error", "message" => $message));
}


  # utility to return array or messages (or empty if non-existent)
  function get_data() {
    global $data_file;
    $data = json_decode(file_get_contents($data_file), true);
    return $data == NULL ? array() : $data;
  }

?>
