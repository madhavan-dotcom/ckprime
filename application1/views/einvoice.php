 <?php 
      

	// $response;

	// $decodedArray = json_decode($response, true);

// Check if decoding was successful
// if ($decodedArray != null) {
    // JSON was successfully decoded, and $decodedArray contains the associative array
   
		// print_r($decodedArray);
		// '<br>';

		// $acno = $decodedArray['data']['AckNo'];
		// $acdate = $decodedArray['data']['AckDt'];
		// $irn = $decodedArray['data']['Irn'];

		// echo ($acno);'<br>';
		// echo ($acdate);'<br>';
		// echo ($irn);


		// echo($acno);
		// echo($acdate);
		// echo($irn);

		
	

		 
// } else {
//     // JSON decoding failed
//     echo "JSON decoding failed.";
// }
	
     
foreach($invoice as $d)
		 {

			$statecode = $this->db->select('stateCode')->where('state',$profiles->stateCode)->get('statecode')->row()->stateCode;

			$stateid = $this->db->where('id',$d['customerId'])->get('customer_details')->row();

			
			
			
			$date =  date('d/m/Y',strtotime($d['date']));
			$irn = $d['irn'];
	
			// $distance = $d['distance'];
			// $transid = $profiles[0]->transid;
			// $transname = $profiles->transname;
			$docno     =$d['invoiceno'];
			$docdate   = $date;
			$vechno    = $d['vehicleno'];
		 }

		 $ewayArray = [

			   "Irn" => $irn,
			   "Distance" =>"100",
			   "TransMode"=>"1",
			   "TransId" =>"12AWGPV7107B1Z1",
			   "TransName"=>"trans name",
			   "TransDocDt"=>$date,
			   "TransDocNo"=>$docno,
			   "VehNo"=>$vechno,
			   "VehType"=>"R",

			   "ExpShipDtls"=>[
				"Addr1"=>$stateid->address1,
				"Addr2"=> $stateid->address2, 
				"Loc"=>$stateid->city, 
				"Pin"=>(int)$stateid->pincode, 
				"Stcd"=> $stateid->statecode, 

			   ], 

			   "DispDtls"=>[
				"Nm"=>$d['customername'],
				"Addr1"=>$stateid->address1,
				"Addr2"=> $stateid->address2, 
				"Loc"=>$stateid->city, 
				"Pin"=>(int)$stateid->pincode, 
				"Stcd"=> $stateid->statecode, 

			   ],

			];


		echo json_encode($ewayArray);



