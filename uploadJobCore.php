<html>
<body>
<?php
   include 'utilityFunctions.php';

   define("DATA_FILE_NAME", "DataFile");
   define("CONFIG_FILE_NAME", "ConfigFile");   
   define("FILE_ALREADY_EXISTS", "<b>".$_POST['email']." already has a job of the name: ".$_POST['jobName']." please go back and fill out the form again.</b><br/>");
   function verifyConfigFile($filename) {
        return true;
   }
   function writeJobFile($email, $jobName) {
        $jobFile = fopen(jobNameFromMailAndJob($email, $jobName), "w");
        if(!$jobFile) {
           echo "Server error: Couldn't open a new job file. <br/>";
           return false;
        }
        fwrite($jobFile, $email."\n");
        fwrite($jobFile, $jobName."\n");
        fclose($jobFile);
        return true;
   }
   function writeConfigFile($email, $jobName, $integerVars, $nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient) {
        if(isANonInteger(array($nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient)) || isANonInteger($integerVars)) { 
            echo "Error: All variables but the email and job name  must be integers.<br/>";  
            return false;
        }
        $configFile = fopen(configNameFromMailAndJob($email, $jobName), "w");
        if(!$configFile) {
           echo "Server error: Couldn't open a new configuration file.<br/>"; 
           return false;
        } 
        fwrite($configFile, $nDv."\n");
        fwrite($configFile, $nCp."\n");  
        fwrite($configFile, $nPi."\n");
        fwrite($configFile, $RMSErrorTolerance."\n");
        fwrite($configFile, $maxRMSErrorTolerance."\n");
        fwrite($configFile, $correlationCoefficient."\n");
        fwrite($configFile, "Integer Variables\n");
        foreach($integerVars as $integerVarNum) {
           fwrite($configFile, $integerVarNum."\n");
        }
        fclose($configFile);
        return true;
     
   }
   function addToQueue(){
   	$email = $_POST['email'];
   	if($email == 'clientemail@mines.edu'){
   		return writeQueue("queue1.txt");
   	}
   	else if ((strpos($email, '@mymail.mines.edu') !== FALSE) || (strpos($email, '@mines.edu') !== FALSE)){
   		return writeQueue("queue2.txt");
   	}
   	else {
   		return writeQueue("queue3.txt");
   	}
   }
   
   function writeQueue($filename){
   	$pathway = 'queue/';
   	$queueFile = fopen($pathway . $filename, "wa");
   	if (!$queueFile){
   		return false;
   	}
   	fwrite($queueFile, finishedJobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']) . "\n");
   	return true;
   }

   writeUploadedDataFile(DATA_FILE_NAME);

   //if we uploaded a configuration file, 
   if($_GET['uploadedFile'] == 'true') {
        if(!file_exists(jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))
           && writeJobFile($_POST['email'], $_POST['jobName'])
           && ($_FILES[DATA_FILE_NAME]["error"]==0)
           && create_zip(array(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']), 
                         $_FILES[DATA_FILE_NAME]["name"], $_FILES[CONFIG_FILE_NAME]["name"]), 
                         jobZipnameFromMailAndJob($_POST["email"], $_POST["jobName"]))
           && addToQueue() ) {
            echo "Thank you for your submission Your data has been successfully submitted.";
          } else if(file_exists(jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))) {
            echo FILE_ALREADY_EXISTS;
          } else {
            echo "<b>There was an error in your submission. One of the files you uploaded is probably invalid. Please try again.</b>";
         }
   } else { //otherwise, build the configuration file
     if(!file_exists(jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))) {
        if(writeConfigFile($_POST['email'], $_POST['jobName'], $_POST['integerVars'], 
                           $_POST['nDv'], $_POST['nCp'], $_POST['nPi'], $_POST['RMSErrorTolerance'], 
                           $_POST['maxRMSErrorTolerance'], $_POST['correlationCoefficient'])
           && writeJobFile($_POST['email'], $_POST['jobName'])
           && ($_FILES[DATA_FILE_NAME]["error"] == 0)
           && create_zip(array(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']), 
                         $_FILES[DATA_FILE_NAME]['name'], configNameFromMailAndJob($_POST['email'], $_POST['jobName'])),
                         jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))
           && addToQueue()) {
           echo "Thank you for your submission. Your data has been successfuly submitted.";
         } else {
           echo "<b>There was a problem in creating your model. Please make sure you gave correct inputs.</b><br/>";
         }
     } else {
        echo FILE_ALREADY_EXISTS;
     }
     unlink(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']));
     unlink(configNameFromMailAndJob($_POST['email'], $_POST['jobName']));
   }
   ?>
</body>
</html>

