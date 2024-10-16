<?php
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
function get_query_string($keyword, $default){
	return (isset($_GET[$keyword]) && $_GET[$keyword] != '') ? $_GET[$keyword] : $default;
}
function post_query_string($keyword, $default){
	return (isset($_POST[$keyword]) && $_POST[$keyword] != '') ? $_POST[$keyword] : $default;
}

function format_money($value){
	return number_format($value, 2, '.', ',');
}

function format_date($originalDate){
 	return date("M d,Y", strtotime($originalDate));
}

function format_time($time){
 	return date('h:i a', strtotime($time));
}

function count_items($catId){
		return item()->count("categoryId='$catId' and isDeleted=0 and type='Product'");
}

function media_link($image){
	$url = "";

	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$url = "http://localhost/dirtydog/";
      }
      
      // Local production
      if ($_SERVER['HTTP_HOST'] == 'www.dirtydogorganicfarm.com' || $_SERVER['HTTP_HOST'] == 'dirtydogorganicfarm.com' || $_SERVER['HTTP_HOST'] == 'admin.dirtydogorganicfarm.com') {
		$url = "https://dirtydogorganicfarm.com/";
      }
      
      // Local testing
      if ($_SERVER['HTTP_HOST'] == 'testing.dirtydogorganicfarm.com') {
		$url = "https://testing.dirtydogorganicfarm.com/";
      }

	$imgUrl = $url . "media/" . $image;

	if (filter_var($imgUrl, FILTER_VALIDATE_URL) === FALSE) {
	    $imgUrl =  $url . "admin/templates/no-image.JPG";
	}
	if (!$image) {
		$imgUrl =  $url . "admin/templates/no-image.JPG";
	}
	return $imgUrl;
}

function general_link($link){
	$url = "";
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$url = "http://localhost/dirtydog/";
      }
      
      // Local production
      if ($_SERVER['HTTP_HOST'] == 'www.dirtydogorganicfarm.com' || $_SERVER['HTTP_HOST'] == 'dirtydogorganicfarm.com' || $_SERVER['HTTP_HOST'] == 'admin.dirtydogorganicfarm.com') {
		$url = "https://dirtydogorganicfarm.com/";
      }
      
      // Local testing
      if ($_SERVER['HTTP_HOST'] == 'testing.dirtydogorganicfarm.com') {
		$url = "https://testing.dirtydogorganicfarm.com/";
      }

	return $url . $link;
}

function get_total_purchase($Id, $type){
	$order_list = order_items()->list("userId=$Id and type='$type'");
	$total = 0;
	foreach ($order_list as $row) {
		$item = item()->get("Id=$row->itemId");
		$total += $item->price*$row->quantity;
	}
	return $total;
}


function char_limit($x, $length){
	$result = $x;
  if(strlen($x)<=$length)
  {
    $result = $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    $result = $y;
  }

	return $result;
}


// Start widgets =============================================================================
function get_ratings($star){
  include "widgets/ratings.widget.php";
}

function page_header($title){
  include "widgets/pageHeader.widget.php";
}

function product_widget($item){
	include "widgets/product.widget.php";
}

function product2_widget($item){
	include "widgets/product2.widget.php";
}

function product3_widget($item){
	include "widgets/product3.widget.php";
}

function csa_product_widget($item){
	include "widgets/csaProduct.widget.php";
}



// End widgets =============================================================================


function get_average_ratings($itemId){
  $rating_total = ratings()->count("itemId=$itemId");
	$total_rates = 0;
	$average = 0;

	if ($rating_total>0) {
		foreach (ratings()->list("itemId=$itemId") as $row) {
			$total_rates += $row->stars;
		}
		if ($total_rates!==0) {
			$average = $total_rates/$rating_total;
			$average = floor($average);
		}
	}
	return $average;
}


// Settings database

function nullable_get($code){
    $result = "";
    $checkExist = settings()->count("code='$code'");
    if ($checkExist) {
        $result = settings()->get("code='$code'");
    }
    return $result;
}

/* =====================================Functions===================================== */

/* Send email */
function smtp_mailer($recepients, $subject, $html){

	$mail = new PHPMailer(true);

	$mail->isSMTP();
	$mail->Host       = 'smtp.hostinger.com';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'no-reply@dirtydogorganicfarm.com';
	$mail->Password   = 'Init2024!';
	$mail->SMTPSecure = 'ssl';
	$mail->Port       = 465;

	$mail->setFrom('no-reply@dirtydogorganicfarm.com', 'Dirty Dog Organic Farm');
	
	$recepientList = explode(",",$recepients);
	foreach ($recepientList as $to) {
		$mail->ClearAllRecipients();
		$mail->addAddress($to);
		
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $html;
		$mail->AltBody = 'Body in plain text for non-HTML mail clients';
		$mail->send();
	}


}

// function smtp_mailer($to, $subject, $html){

// 	$mail = new PHPMailer(true);

// 	$mail->isSMTP();
// 	$mail->Host       = 'smtp.hostinger.com';
// 	$mail->SMTPAuth   = true;
// 	$mail->Username   = 'no-reply@dirtydogorganicfarm.com';
// 	$mail->Password   = 'Init2024!';
// 	$mail->SMTPSecure = 'ssl';
// 	$mail->Port       = 465;

// 	$mail->setFrom('no-reply@dirtydogorganicfarm.com', 'Dirty Dog Organic Farm');
// 	$mail->addAddress($to);

// 	$mail->isHTML(true);
// 	$mail->Subject = $subject;
// 	$mail->Body    = $html;
// 	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
// 	$mail->send();

// }
/* =====================================Functions===================================== */
/* Retrieve one record */
function uploadFile($uploadedFile){
	// Where the file is going to be placed
	$target_path = "../media/";
	/* Add the original filename to our target path.
	Result is "uploads/filename.extension" */
	// $target_path = $target_path . basename( $uploadedFile['name']);
	$temp = explode(".", $uploadedFile["name"]);
	$newfilename = date("Ymd") . round(microtime(true)) .  '.' . end($temp);
	if(move_uploaded_file($uploadedFile['tmp_name'], $target_path . $newfilename)) {
			return $newfilename;
		}
		else{
			return 0;
		}
}
/* Retrieve one record */
function uploadMultipleFile($uploadedFile){
	$filenameList = array();
	$countfiles = count($uploadedFile['name']);
	if ($countfiles>0){
		for($i=0;$i<$countfiles;$i++){
			// File name
		   	$filename = $uploadedFile['name'][$i];
		   	// Get extension
	  		 $ext = explode(".", $filename);
			 	 $newfilename = round(microtime(true)*($i+1)) . '.' . end($ext);
			   if(move_uploaded_file($uploadedFile['tmp_name'][$i],'../../media/'.$newfilename)){
			   		$filenameList[] = $newfilename;
				}
				else{
			   		$filenameList['error'] = true;
				}
		}
			return $filenameList;
	}
	else{
			return false;
	}
}
?>
