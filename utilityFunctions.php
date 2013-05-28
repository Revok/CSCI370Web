<?php
   define("JOB_DIRECTORY", "jobs/");
   /* This function, create_zip, was copied from davidwalsh.name/create-zip-php*/
   /* creates a compressed zip file */
   function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
   }
   function configNameFromMailAndJob($mail, $jobName) {
            return str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('@', '.'), '', $mail).".cfg";
   }
   function jobNameFromMailAndJob($mail, $jobName) {
            return str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('.', '@'), '', $mail).".job";
   }
   function jobZipNameFromMailAndJob($mail, $jobName) {
            return JOB_DIRECTORY.str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('.', '@'), '', $mail).".zip";
   }
   function writeUploadedDataFile($filename) {
            return move_uploaded_file($_FILES[$filename]["tmp_name"], $_FILES[$filename]["name"]);
            
   }
   function isANonInteger($intArray) {
            foreach($intArray as $val) {
               if(!is_numeric($val)) return true;
            }
            return false;
   }
?>