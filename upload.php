<?php
	function debug_to_console( $data ) {
		if ( is_array( $data ) )
			$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
		else
			$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
		echo $output;
	}
	$target_url = 'http://localhost/accept.php';
        //This needs to be the full path to the file you want to send.
	$file_name_with_full_path = realpath($argv[1]);
	debug_to_console($file_name_with_full_path);
        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. 
         */
	$post = array('file' => new CurlFile($file_name_with_full_path, 'multipart/form-data' /* MIME-Type */, $file_name_with_full_path));
 
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec ($ch);
	curl_close ($ch);
	echo $result;
	
	
?>