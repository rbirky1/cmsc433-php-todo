{
    "status":"ok",
    "events":
    [
        {
            "id":"4f946e5ed65fb",
	    "name":"Something important I think",
	    "deadline":1415681940,
	    "notes":"Probably for English class or something"
        },
        {
            "id":"4f946d7a31b27",
	    "name":"CMSC 433 PHP Project",
	    "deadline":1418533140,
	    "notes":"Still need to finish the third part"
        },
        {
            "id":"4f946fc11ac99",
            "name":"CMSC 433 Final Exam",
            "deadline":1418684400,
            "notes":"SOND 112"
        },
        {
            "id":"4f946d528fe08",
            "name":"New Years party stuff",
            "deadline":1420001940,
            "notes":""
        }
    ],
}

    if ($_POST["action"] == "delete"){
       $data = get_data();

       foreach ($sampleTasks as $idx => $task){
            if ($task["id"] == $_POST["id"]){
                            unset($sampleTasks[$idx]);
                            $message = "Successfully $action event";
                            echo json_encode(array("status" => "ok", "message" => $message));
                            exit();
            }
        }
    }



    [
        {
            "id":"4f946e5ed65fb",
        "name":"Something important I think",
        "deadline":1415681940,
        "notes":"Probably for English class or something"
        },
        {
            "id":"4f946d7a31b27",
        "name":"CMSC 433 PHP Project",
        "deadline":1418533140,
        "notes":"Still need to finish the third part"
        },
        {
            "id":"4f946fc11ac99",
            "name":"CMSC 433 Final Exam",
            "deadline":1418684400,
            "notes":"SOND 112"
        },
        {
            "id":"4f946d528fe08",
            "name":"New Years party stuff",
            "deadline":1420001940,
            "notes":""
        }
    ]



