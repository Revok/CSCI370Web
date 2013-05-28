<html>
<body>
<?php
   include 'utilityFunctions.php';
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
   function writeConfigFile($email, $jobName, $integerVars, $nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient, $storeIterativeResults, $typeOfModel) {
        if(isANonInteger(array($integerVars, $nDv, $nCp, $nPi, $RMSErrorTolerance, $maxRMSErrorTolerance, $correlationCoefficient))) { 
            echo "Error: All variables but the email, job name, and type of model  must be integers.<br/>";  
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
        fwrite($configFile, $integerVars."\n");
        fwrite($configFile, $RMSErrorTolerance."\n");
        fwrite($configFile, $maxRMSErrorTolerance."\n");
        fwrite($configFile, $correlationCoefficient."\n");
        fwrite($configFile, $storeIterativeResults."\n");
        fwrite($configFile, $typeOfModel."\n");
                
        fclose($configFile);
        return true;
     
   }
   writeUploadedDataFile("DataFile");
   //if we uploaded a configuration file, 
   if($_GET['uploadedFile'] == 'true') {
        echo writeUploadedDataFile("ConfigFile");
        if(writeJobFile($_POST['email'], $_POST['jobName'])
           && ($_FILES["DataFile"]["error"]==0)
           && create_zip(array(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']), 
                         $_FILES["DataFile"]["name"], $_FILES["ConfigFile"]["name"]), 
                         jobZipnameFromMailAndJob($_POST["email"], $_POST["jobName"])) ) {
            echo "Thank you for your submission Your data has been successfully submitted.";
          } else {
            echo "There was an error in your submission. Please try again.";
         }
   } else { //otherwise, build the configuration file
     if(!file_exists(jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))) {
        if(writeConfigFile($_POST['email'], $_POST['jobName'], $_POST['integerVars'], 
                           $_POST['nDv'], $_POST['nCp'], $_POST['nPi'], $_POST['RMSErrorTolerance'], 
                           $_POST['maxRMSErrorTolerance'], $_POST['correlationCoefficient'], 
                           $_POST['storeIterativeResults'], $_POST['typeOfModel'])
           && writeJobFile($_POST['email'], $_POST['jobName'])
           && ($_FILES["DataFile"]["error"] == 0)
           && create_zip(array(jobNameFromMailAndJob($_POST['email'], $_POST['jobName']), 
                         $_FILES['DataFile']['name'], configNameFromMailAndJob($_POST['email'], $_POST['jobName'])),
                         jobZipNameFromMailAndJob($_POST['email'], $_POST['jobName']))) {
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
