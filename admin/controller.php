<?php 
include 'config.php';

class crud extends db_conn_mysql
{
	

	function orders(){
		session_start();
		$usertype = $_SESSION['usertype'];
		$viewtype = $_GET['viewtype'];
		$filter = $_GET['filter'];

		$conn = $this->connect_mysql();
		if($filter=="All"){
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no  FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no  FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE a.sender ='$viewtype'");
			}
			
		}else if($filter=="Onprocess"){
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='On Process'");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='On Process' AND a.sender='$viewtype'");
			}
			
		}else if($filter=="Invoiced"){
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.status_order='Invoiced'");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.status_order='Invoiced' AND a.sender='$viewtype'");
			}
			
		}else if($filter=="Delivered"){
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.status_order='Delivered'");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.status_order='Delivered' AND a.sender='$viewtype'");
			}

			
		}else if($filter=="Canceled"){
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='Canceled'");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='Canceled' AND a.sender='$viewtype'");
			}
			
		}else{
			if($viewtype=="PMC and TMS"){
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='Completed'");
			}else{
				$query = $conn->prepare("SELECT a.*,b.statuss,b.id as idd,b.status_order,b.date_status,b.invoice_number,b.dispatch_type,b.lbc_track,b.express_track,b.freight_forwarder,b.freight_ref_no FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id WHERE b.statuss='Completed' AND a.sender='$viewtype'");
			}
			
		}

		$query->execute();
		$row = $query->fetchAll();
		$return = array();
			foreach ($row as $x){
					$data = array();
				$data['Name'] = '<p style="line-height:20px"><span style="color:gray">'.$x['name'].'</span><br><span style="font-weight:bold">'.$x['company'].'</span></p>';
				// $data['Company'] = $x['company'];
				$data['PO'] = '<p style="line-height:20px"><span style="font-weight:bold">'.$x['po'].'</span><br><span style="color:gray">'.date("m-d-Y",strtotime($x['date_transact'])).'</span></p>';
				// $data['start_date'] = $x['date_transact'];
				// $data['Statuss'] = $x['status_order'];
				$statuss = $x['status_order'];
				if($statuss=="Completed"){
					$data['Statuss'] = '<p style="color:red;text-align:left;font-weight:bold">'.$x['status_order'].'</p>';
				}else if($statuss=="Invoiced"){
					$data['Statuss'] = '<p style="color:dodgerblue;text-align:left;font-weight:bold;line-height:20px">'.$x['status_order'].'<span style="color:black"> <br> '.$x['invoice_number'].'</span> </p>';
				}else if($statuss=="Delivered"){
					$delivery_details = ($x['lbc_track']==null && $x['express_track']==null && $x['freight_ref_no']==null) ? $x['invoice_number'] : $x['invoice_number'].' / '.$x['lbc_track'].''.$x['express_track'].''.$x['freight_ref_no'];
					$data['Statuss'] = '<p style="color:dodgerblue;text-align:left;font-weight:bold;line-height:20px">'.$x['status_order'].' '.$x['dispatch_type'].' '.$x['freight_forwarder'].'<span style="color:black"> <br> '.$delivery_details.'</span> </p>';
				}else{
					$data['Statuss'] = '<p style="color:dodgerblue;text-align:left;font-weight:bold">'.$x['status_order'].'</p>';
				}
				

				$startdate = strtotime($x['date_transact']);
				$updatedate = strtotime($x['date_status']);
				$diff = abs($updatedate - $startdate);  
				$years = floor($diff / (365*60*60*24)); 
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 

				// $data['durations'] = $days." day/s";
				$data['update_date'] = date("m-d-Y",strtotime($x['date_status']));
				$data['duration'] = " <span style='color:red;text-align:center'>".$days."</span>";
				if($usertype=="Viewer"){
					$data['Action'] = '<label>Disabled</label>';
				}else if($usertype=="Purchasing" || $usertype=="Warehouse"){
					$data['Action'] = '
						<button class="btn btn-primary btn-xs" style="font-size:10px" onclick="openorder('.$x['idd'].')"><i class="fa fa-eye"></i> Open</button>';
				}else{
					$data['Action'] = '
						<button class="btn btn-primary btn-xs" style="font-size:10px" onclick="openorder('.$x['idd'].')"><i class="fa fa-eye"></i> Open</button>
						<button class="btn btn-danger btn-xs" style="font-size:10px" onclick="deleteorder('.$x['idd'].')"><i class="fa fa-trash"></i> Delete</button>';
				}
				
				
				$return[] = $data;
			}
		
		echo json_encode(array('data'=>$return));
	}

	function deleteolder(){
		$today = date('Y-m-d');
		$newdate = date('Y-m-d', strtotime('-6 months', strtotime($today)));
		// $newdate = "2019-12-04";

		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT a.id,b.status_order,b.date_status FROM customer a
								LEFT JOIN customer_order b ON a.id=b.customer_id
								WHERE b.status_order='Completed' AND b.date_status <= '$newdate'");
		$query->execute();
		$rc = $query->rowCount();
		$row = $query->fetchAll();
		foreach($row as $x){
			$cust_id = $x['id'];
			$query1 = $conn->prepare("DELETE FROM customer WHERE id='$cust_id'");
			$query1->execute();

			$query2 = $conn->prepare("DELETE FROM customer_order WHERE customer_id='$cust_id'");
			$query2->execute();
		}
		if($rc > 0){

			session_start();
			$auditaction = "Delete ".$rc." older records (6 months older) that was already completed.";
			$enduser = $_SESSION['fullname'];
			$datenow = date('Y-m-d');
			$qryat = $conn->prepare("INSERT INTO audit_trail SET po_no='older records', action='$auditaction', enduser='$enduser', auditdate='$datenow'");
			$qryat->execute();

		}
		echo json_encode(array('rcount'=>$rc));
	}

	function audit(){

		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT * FROM audit_trail ORDER BY id DESC");
		$query->execute();
		$row = $query->fetchAll();
		$return = array();
			foreach ($row as $x){
					$data = array();

				$data['PO'] = $x['po_no'];
				$data['ACTION'] = $x['action'];
				$data['DATE'] = $x['auditdate'];
				$data['ENDUSER'] = $x['enduser'];
				
				$return[] = $data;
			}
		
		echo json_encode(array('data'=>$return));
	}

	function deleteuser(){
		$id = $_POST['id'];
		$conn = $this->connect_mysql();
		$qry = $conn->prepare("DELETE FROM user_account WHERE id='$id'");
		$qry->execute();
	}

	function users(){

		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT * FROM user_account");
		$query->execute();
		$row = $query->fetchAll();
		$return = array();
			foreach ($row as $x){
					$data = array();

				$data['Name'] = $x['fullname'];
				$data['Username'] = $x['username'];
				$usertype = $x['usertype'];
				if($usertype=="Viewer"){
					$usertype = $usertype.' - '.$x['view'];
				}
				$data['Usertype'] = $usertype;
				$data['Action'] = '<center>
						<button class="btn btn-primary btn-xs" style="font-size:10px" onclick="edituser('.$x['id'].',\''.$x['username'].'\',\''.$x['password'].'\',\''.$x['usertype'].'\',\''.$x['fullname'].'\',\''.$x['view'].'\')"><i class="fas fa-pencil-alt"></i> Edit</button>
						<button class="btn btn-danger btn-xs" style="font-size:10px" onclick="deleteuser('.$x['id'].')"><i class="fa fa-trash"></i> Delete</button>';
				
				$return[] = $data;
			}
		
		echo json_encode(array('data'=>$return));
	}

	function deleteorder(){
		$id = $_POST['id'];

		$conn = $this->connect_mysql();

		$qry = $conn->prepare("SELECT customer_id FROM customer_order WHERE id='$id'");
		$qry->execute();
		$row= $qry->fetch();
		$customer_id = $row['customer_id'];

		$qry1 = $conn->prepare("SELECT po FROM customer WHERE id='$customer_id'");
		$qry1->execute();
		$row1= $qry1->fetch();
		$cust_po= $row1['po'];
		$auditaction = "Delete PO number ".$cust_po;

		$query = $conn->prepare("DELETE FROM customer WHERE id='$id'");
		$query->execute();

		$query2 = $conn->prepare("DELETE FROM customer_order WHERE customer_id='$id'");
		$query2->execute();

		

		session_start();
		$enduser = $_SESSION['fullname'];
		$datenow = date('Y-m-d');
		$qryat = $conn->prepare("INSERT INTO audit_trail SET po_no='$cust_po', action='$auditaction', enduser='$enduser', auditdate='$datenow'");
		$qryat->execute();

	}

	function updateorder(){
		$cust_email = $_POST['cust_email'];
		$order_id = $_POST['order_id'];
		$column = $_POST['column'];
		$columnn = $_POST['column'];
		$inv_tbox = $_POST['inv_tbox'];
		$emailstatus = $_POST['emailstatus'];
		$dispatch_type = $_POST['dispatch_type'];
		$action = "";
		$datetoday = date('Y-m-d');
		$lbc_track = $_POST['lbc_track'];
		$freight_forwarder = $_POST['freight_forwarder'];
		$freight_ref_no = $_POST['freight_ref_no'];
		$express_courier = $_POST['express_courier'];
		$express_track = $_POST['express_track'];
		if($column=="complete_status='yes'"){
			$column = $column.",complete_emailstatus='$emailstatus',dispatch_status='no',invoice_status='no',invoice_number='',pickup_status='no',returninvoice_status='no',status_order='Fully Packed',date_status='$datetoday'";
			$action = "Complete Status";
		}else if($column=="invoice_status='yes'"){
			$column = $column.",invoice_number='$inv_tbox',invoice_emailstatus='$emailstatus',status_order='Invoiced',date_status='$datetoday'";
			$action = "Invoice Status";
		}else if($column=="partial_status='yes'"){
			$column = $column.",partial_emailstatus='$emailstatus',status_order='Partially Packed',date_status='$datetoday'";
			$action = "Partial Status";
		}else if($column=="dispatch_status='yes'"){
			$column = $column.",dispatch_emailstatus='$emailstatus',dispatch_type='$dispatch_type',status_order='Delivered',date_status='$datetoday',lbc_track='$lbc_track', freight_forwarder='$freight_forwarder', freight_ref_no='$freight_ref_no', express_courier='$express_courier', express_track='$express_track'";
			$action = "Dispatch or Deliver Status";
		}else if($column=="pickup_status='yes'"){
			$column = $column.",pickup_emailstatus='$emailstatus',status_order='Delivered',date_status='$datetoday'";
			$action = "For Pickup Status";
		}else if($column=="returninvoice_status='yes'"){
			$column = $column.",returninvoice_emailstatus='$emailstatus',status_order='Received Invoice',date_status='$datetoday'";
			$action = "Received invoice returned Status";
		}else if($column=="statuss='Completed'"){
			$column = $column.",status_order='Completed',date_status='$datetoday'";
		}else if($column=="statuss='Canceled'"){
			$column = $column.",status_order='Canceled',date_status='$cust_datee'";
		}
		$conn = $this->connect_mysql();
		$sqlquery = "UPDATE customer_order SET ".$column." WHERE id='$order_id'";
		$query = $conn->prepare($sqlquery);
		$query->execute();

		$qry = $conn->prepare("SELECT po FROM customer WHERE id='$order_id'");
		$qry->execute();
		$row= $qry->fetch();
		$cust_po= $row['po'];
		$auditaction = "Update the ".$action.". PO number ".$cust_po;
		if($columnn=="statuss='Completed'"){
			$auditaction = "Finished the transaction. PO number ".$cust_po;
		}
		session_start();
		$enduser = $_SESSION['fullname'];
		$datenow = date('Y-m-d');
		$qryat = $conn->prepare("INSERT INTO audit_trail SET po_no='$cust_po', action='$auditaction', enduser='$enduser', auditdate='$datenow'");
		$qryat->execute();

	}
	function addnewpick(){
		$order_id = $_POST['order_id'];
		$conn = $this->connect_mysql();
		$sqlquery = "UPDATE customer_order SET partial_status='no',complete_status='no',invoice_status='no',invoice_number='',dispatch_status='no',pickup_status='no',returninvoice_status='no' WHERE customer_id='$order_id'";
		$query = $conn->prepare($sqlquery);
		$query->execute();
	}

	function orderstatus(){
		$order_id = $_POST['order_id'];

		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT a.*,b.name,b.po,b.email,b.email2,b.email3,b.amount,b.company,b.mobile_no,b.sender FROM customer_order a
								LEFT JOIN customer b ON a.customer_id=b.id
								WHERE a.id='$order_id'");
		$query->execute();
		$row = $query->fetch();
		$amt = number_format($row['amount'],2);

		$arrayy = array("order_status" => $row['order_status'],"pickpack_status" => $row['pickpack_status'],"partial_status" => $row['partial_status'],"complete_status" => $row['complete_status'],"invoice_status" => $row['invoice_status'],"invoice_number" => $row['invoice_number'],"dispatch_status" => $row['dispatch_status'],"ar_status" => $row['ar_status'],"collection1_status" => $row['collection1_status'],"collection2_status" => $row['collection2_status'],"collection3_status" => $row['collection3_status'],"collection4_status" => $row['collection4_status'],"collection5_status" => $row['collection5_status'],"payment_status" => $row['payment_status'],"pickup_status" => $row['pickup_status'],"statuss" => $row['statuss'],"cust_name" => $row['name'],"cust_po" => $row['po'],"email" => $row['email'],"email2" => $row['email2'],"email3" => $row['email3'],"cust_amt"=>$amt,"order_emailstatus"=>$row['order_emailstatus'],"partial_emailstatus"=>$row['partial_emailstatus'],"complete_emailstatus"=>$row['complete_emailstatus'],"invoice_emailstatus"=>$row['invoice_emailstatus'],"dispatch_emailstatus"=>$row['dispatch_emailstatus'],"pickup_emailstatus"=>$row['pickup_emailstatus'],"returninvoice_status"=>$row['returninvoice_status'],"returninvoice_emailstatus"=>$row['returninvoice_emailstatus'],"company"=>$row['company'],"dispatch_type"=>$row['dispatch_type'],"inv_num"=>$row['invoice_number'],"cust_cp"=>$row['mobile_no'],"sender"=>$row['sender'],"express_courier"=>$row['express_courier'],"express_track"=>$row['express_track'],"lbc_track"=>$row['lbc_track'],"freight_forwarder"=>$row['freight_forwarder'],"freight_ref_no"=>$row['freight_ref_no'],"date_status"=>$row['date_status']);
		
		echo json_encode($arrayy);
	}
	function addcustomer(){
		
		$cust_name = $_POST['cust_name'];
		$cust_email = $_POST['cust_email'];
		$cust_emaill = $_POST['cust_emaill'];
		$cust_emailll = $_POST['cust_emailll'];
		$cust_po = $_POST['cust_po'];
		$cust_date = $_POST['cust_date'];
		$cust_amt = $_POST['cust_amt'];
		$cust_cp = $_POST['cust_cp'];
		$cust_company = $_POST['cust_company'];
		$sender = $_POST['sender'];
		$conn = $this->connect_mysql();
		$query = $conn->prepare("INSERT INTO customer SET name='$cust_name',company='$cust_company', email='$cust_email',email2='$cust_emaill',email3='$cust_emailll', po='$cust_po', date_transact='$cust_date',amount='$cust_amt',mobile_no='$cust_cp',sender='$sender'");
		$query->execute();

		$cust_id = $conn->lastInsertId();
		$datetoday = date('Y-m-d');
		// $query2 = $conn->prepare("SELECT id FROM customer WHERE name='$cust_name' AND email='$cust_email' AND po='$cust_po' AND date_transact='$cust_date'");
		// $query2->execute();
		// $row = $query2->fetch();
		// $cust_id = $row['id'];
		$status = "no";
		$query3 = $conn->prepare("INSERT INTO customer_order SET customer_id='$cust_id', order_status='yes',order_emailstatus='S', pickpack_status='$status', partial_status='$status', complete_status='$status', invoice_status='$status', dispatch_status='$status', ar_status='$status', collection1_status='$status', collection2_status='$status', collection3_status='$status', collection4_status='$status', collection5_status='$status', payment_status='$status', statuss='On Process',status_order='Order Acknowledgement',date_status='$datetoday'");
		$query3->execute();

		$query4 = $conn->prepare("SELECT id FROM customer_order WHERE customer_id='$cust_id' AND order_status='yes' AND pickpack_status='$status' AND partial_status='$status' AND complete_status='$status' AND invoice_status='$status' AND dispatch_status='$status' AND ar_status='$status' AND collection1_status='$status' AND collection2_status='$status' AND collection3_status='$status' AND collection4_status='$status' AND collection5_status='$status' AND payment_status='$status' AND statuss='On Process'");
		$query4->execute();
		$row2 = $query4->fetch();
		$cust_id2 = $row2['id'];

		session_start();
		$enduser = $_SESSION['fullname'];
		$action = "Added New Order, The PO number was ".$cust_po;
		$datenow = date('Y-m-d');
		$qryat = $conn->prepare("INSERT INTO audit_trail SET po_no='$cust_po', action='$action', enduser='$enduser', auditdate='$datenow'");
		$qryat->execute();

		echo json_encode(array("idd"=>$cust_id2,"sender"=>$sender));

	}

	function checklogin(){
		$username = $_POST['username'];
		$userpass = $_POST['userpass'];
		// $username = "admin";
		// $userpass = 'pmc6564981';
		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT id, username, password, usertype, fullname, view FROM user_account WHERE username='$username' AND password='$userpass'");
		$query->execute();
		$rc = $query->rowCount();

		if($rc <= 0){
			echo json_encode(array("stats"=>"none"));
		}else{
			$row = $query->fetch();
			session_start();
			$usertype = $row['usertype'];
			$fullname = $row['fullname'];
			$_SESSION['fullname'] = $fullname;
			$_SESSION['usertype'] = $usertype;
			$_SESSION['viewtype'] = $row['view'];
			echo json_encode(array("stats"=>"one","fullname"=>$fullname,"usertype"=>$usertype));
		}

	}
	function adduseraccount(){
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$usertype = $_POST['usertype'];
		$viewtype = $_POST['viewtype'];
		if($usertype!="Viewer"){
			$viewtype = "PMC and TMS";
		}
		$conn = $this->connect_mysql();

		$qryat = $conn->prepare("INSERT INTO user_account SET username='$username', password='$password', usertype='$usertype', fullname='$fullname', view='$viewtype'");
		$qryat->execute();
	}

	function edituseraccount(){
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$usertype = $_POST['usertype'];
		$iduser = $_POST['iduser'];
		$viewtype = $_POST['viewtype'];
		if($usertype!="Viewer"){
			$viewtype = "PMC and TMS";
		}
		$conn = $this->connect_mysql();

		$qryat = $conn->prepare("UPDATE user_account SET username='$username', password='$password', usertype='$usertype', fullname='$fullname', view='$viewtype' WHERE id='$iduser'");
		$qryat->execute();
	}

	function logoutyes(){
		session_start();
		session_destroy();
		header('location:index.php');
	}

	function dcompanies(){

			$conn=$this->connect_mysql();
			$sql = $conn->prepare("SELECT * FROM contacts ORDER BY company ASC");
			$sql->execute();
			$option = '<option value="" disabled="" selected="">--Select Customer--</option>';
			while($row=$sql->fetch()){ $option.='<option value="'.$row['id'].'">'.$row['company'].'</option>';}
			// echo json_encode(array("data"=>$option));
			echo $option;
	}
	function selectcustomer(){
			$id = $_POST['id'];
			$conn=$this->connect_mysql();
			$sql = $conn->prepare("SELECT id, name, company, mobileno, email, email2, email3 FROM contacts WHERE id='$id'");
			$sql->execute();
			$row = $sql->fetch();
			echo json_encode(array("name"=>$row['name'],"company"=>$row['company'],"mobileno"=>$row['mobileno'],"email"=>$row['email'],"email2"=>$row['email2'],"email3"=>$row['email3']));

	}

	function deletecontact(){
		$id = $_POST['id'];
		$conn = $this->connect_mysql();
		$query = $conn->prepare("DELETE FROM contacts WHERE id='$id'");
		$query->execute();
	}

	function contacts(){

		$conn = $this->connect_mysql();
		$query = $conn->prepare("SELECT * FROM contacts");
		$query->execute();
		$row = $query->fetchAll();
		$return = array();

			foreach ($row as $x){
					$data = array();

				$data['name'] = $x['name'];
				$data['company'] = $x['company'];
				$data['mobileno'] = $x['mobileno'];
				$data['email'] = $x['email'];
				$data['email2'] = $x['email2'];
				$data['email3'] = $x['email3'];
				$data['action'] = '<button class="btn btn-xs btn-danger" onclick="editcontacts('.$x['id'].',\''.$x['name'].'\',\''.$x['company'].'\',\''.$x['mobileno'].'\',\''.$x['email'].'\',\''.$x['email2'].'\',\''.$x['email3'].'\')"><i class="fa fa-pen"></i></button>
								   <button class="btn btn-xs btn-primary" onclick="deletecontacts('.$x['id'].')"><i class="fa fa-trash"></i></button>';

	
				$return[] = $data;
			}
		
		echo json_encode(array('data'=>$return));

	}

	function addcontacts(){
		$name = $_POST['cname'];
		$company = $_POST['ccompany'];
		$mobileno = $_POST['cmobileno'];
		$emailadd = $_POST['cemailadd'];
		$emailadd2 = $_POST['cemailadd2'];
		$emailadd3 = $_POST['cemailadd3'];

		$conn = $this->connect_mysql();
		$query1 = $conn->prepare("INSERT INTO contacts SET name='$name', company='$company', mobileno='$mobileno', email='$emailadd', email2='$emailadd2', email3='$emailadd3'");
		$query1->execute();
	}

	function editcontacts(){
		$name = $_POST['cname'];
		$company = $_POST['ccompany'];
		$mobileno = $_POST['cmobileno'];
		$emailadd = $_POST['cemailadd'];
		$contactid = $_POST['contactid'];
		$emailadd2 = $_POST['cemailadd2'];
		$emailadd3 = $_POST['cemailadd3'];

		$conn = $this->connect_mysql();
		$query1 = $conn->prepare("UPDATE contacts SET name='$name', company='$company', mobileno='$mobileno', email='$emailadd', email2='$emailadd2', email3='$emailadd3' WHERE id='$contactid'");
		$query1->execute();
	}

	function getmyOrderStatus(){

		$order_id = $_POST['order_id'];
		$conn = $this->connect_mysql();
		$qry = $conn->prepare("SELECT id FROM customer WHERE po='TMS $order_id'");
		$qry->execute();
		$row = $qry->fetch();
		$cust_id = $row['id'];

		$qry2 = $conn->prepare("SELECT status_order FROM customer_order WHERE customer_id='$cust_id'");
		$qry2->execute();
		$row2 = $qry2->fetch();
		$status_order = $row2['status_order'];
		if($status_order=="" || $status_order==null){
			$status_order = "N/A";
		}
		echo $status_order;
		// return $status_order;

	}


}
$x = new crud();

if(isset($_GET['getmyOrderStatus'])){
	$x->getmyOrderStatus();
}

if(isset($_GET['addcontacts'])){
	$x->addcontacts();
}

if(isset($_GET['editcontacts'])){
	$x->editcontacts();
}

if(isset($_GET['contacts'])){
	$x->contacts();
}

if(isset($_GET['deletecontact'])){
	$x->deletecontact();
}

if(isset($_GET['selectcustomer'])){
	$x->selectcustomer();
}

if(isset($_GET['dcompanies'])){
	$x->dcompanies();
}

if(isset($_GET['deleteolder'])){
	$x->deleteolder();
}

if(isset($_GET['deleteuser'])){
	$x->deleteuser();
}

if(isset($_GET['adduseraccount'])){
	$x->adduseraccount();
}

if(isset($_GET['edituseraccount'])){
	$x->edituseraccount();
}

if(isset($_GET['users'])){
	$x->users();
}

if(isset($_GET['audit'])){
	$x->audit();
}

if(isset($_GET['logoutyes'])){
	$x->logoutyes();
}

if(isset($_GET['checklogin'])){
	$x->checklogin();
}

if(isset($_GET['orders'])){
	$x->orders();
}

if(isset($_GET['addnewpick'])){
	$x->addnewpick();
}

if(isset($_GET['updateorder'])){
	$x->updateorder();
}

if(isset($_GET['orderstatus'])){
	$x->orderstatus();
}

if(isset($_GET['deleteorder'])){
	$x->deleteorder();
}

if(isset($_GET['addcustomer'])){
	$x->addcustomer();
}

 ?>