<html>
<body>
<?php
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
            return "jobs/".str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('@', '.'), '', $mail).".cfg";
   }
   function jobNameFromMailAndJob($mail, $jobName) {
            return "jobs/".str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('.', '@'), '', $mail).".job";
   }
   function jobZipNameFromMailAndJob($mail, $jobName) {
            return "jobs/".str_replace(array('.', '@'), '', $jobName)."For".str_replace(array('.', '@'), '', $mail).".zip";
   }
   function isANonInteger($intArray) {
            foreach($intArray as $val) {
               if(!is_numeric($val)) return true;
            }
            return false;
   }
   function writeConfigAndJobFiles($email, $jobName, $integerVars, $nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient, $storeIterativeResults, $typeOfModel) {
        if(isANonInteger(array($integerVars, $nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient))) { 
            echo "Error: All variables but the email, job name, and type of model  must be integers.<br/>";  
            return false;
        }
        $jobFile = fopen(jobNameFromMailAndJob($email, $jobName), "w");
        $configFile = fopen(configNameFromMailAndJob($email, $jobName), "w");
        if(!$configFile) {
           echo "Server error: Couldn't open a new configuration file.<br/>"; 
           return false;
        } 
        if(!$jobFile) {
           echo "Server error: Couldn't open a new job file. <br/>";
        }
        fwrite($jobFile, $email."\n");
        fwrite($jobFile, $jobName."\n");
        fwrite($configFile, $nDv."\n");
        fwrite($configFile, $nCp."\n");  
        fwrite($configFile, $nPi."\n");
        fwrite($configFile, $integerVars."\n");
        fwrite($configFile, $RMSErrorTolerance."\n");
        fwrite($configFile, $maxRMSErrorTolerance."\n");
        fwrite($configFile, $correlationCoefficient."\n");
        fwrite($configFile, $storeIterativeResults."\n");
        fwrite($configFile, $typeOfModel."\n");
        
        fclose($jobFile);
        
        fclose($configFile);
        return true;
     
   }
   //if we uploaded a configuration file, 
   if($_GET['uploadedFile'] == 'true') {
        echo "I fucked your mom";
   } else { //otherwise, build the configuration file
     if(!file_exists(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']))) {
        if(writeConfigAndJobFiles($_POST['email'], $_POST['jobName'], $_POST['integerVars'], $_POST['nDv'], $_POST['nCp'], $_POST['nPi'], $_POST['RMSErrorTolerance'], $_POST['maxRMSErrorTolerance'], $_POST['correlationCoefficient'], $_POST['storeIterativeResults'], $_POST['typeOfModel'])
           && !($_FILES["DataFile"]["error"] > 0)
           && create_zip(array(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']), $_FILES['DataFile']['tmp_name'], configNameFromMailAndJob($_POST['email'], $_POST['jobName'])), jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName'])) 
           ) {
           echo "Thank you for your submission. Your data has been successfuly submitted.";
         } else {
           echo "There was a problem writing your configuration file.";
         }
     } else {
        echo "<b>".$_POST['email']." already has a job of the name: ".$_POST['jobName']." please go back and fill out the form again.</b><br/>";          
     }
     unlink(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']));
     unlink(configNameFromMailAndJob($_POST['email'], $_POST['jobName']));

   }
   ?>
</body>
</html>
