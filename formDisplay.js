var formEnding    = "<label type='file'>Data Filename: </label>\
<input type='file' name ='DataFile' id='DataFile'></input><br/>\
<input type='submit' name='submit' text='Submit'></input>\
</form>";
function displayUploadConfigFile(paragraphID) {
    var uploadConfigFileForm = "<form action='uploadFile.php?uploadedFile=true' method='post' enctype='multipart/form-data'>\
                               E-mail:             <br/><input type='text' name='email' id='email'></input><br/><br/>\
                               Job Name:           <br/><input type='text' name='jobName' id='jobName'></input><br/><br/>\
                               <label type='file'>Configuration Filename:</label>\
                               <input type='file' name='ConfigFile' id='ConfigFile'><br/>" + formEnding;

    document.getElementById(paragraphID).innerHTML = uploadConfigFileForm;
}
function displayBuildConfigFile(paragraphID) {
    var downloadConfigFileForm = "<form action='uploadFile.php?uploadedFile=false' method='post' enctype='multipart/form-data'>\
                                   E-mail:                                       <br/><input type='text' name='email' id='email'></input><br/><br/>\
                                   Job Name:                                     <br/><input type='text' name='jobName' id='jobName'></input><br/><br/>\
                                   Number of Design Variables (nDv):             <br/><input type='text' name='nDv' id='nDv'></input><br/><br/>\
                                   Number of Cycle Parameters (nCp):             <br/><input type='text' name='nCp' id='nCp'></input><br/><br/>\
                                   Number of Performance Indices (nPi):          <br/><input type='text' name='nPi' id='nPi'></input><br/><br/>\
                                   Number of integer variables:                  <br/><input type='text' name='integerVars' id='integerVars'></input><br/><br/>\
                                   RMS Error Tolerance for data point matching:  <br/><input type='text' name='RMSErrorTolerance' id='RMSErrorTolerance'></input><br/><br/>\
                                   Maximum RMS Error Tolerance for data point matching: <br/><input type='text' name='maxRMSErrorTolerance' id='maxRMSErrorTolerance'></input><br/><br/>\
                                   Correlation Coefficient Convergence Tolerance:<br/><input type='text' name='correlationCoefficient' id='correlationCoefficient'></input><br/><br/>\
                                   Store Iterative results: <br/>\
                                   <select name='storeIterativeResults'>\
                                       <option value='yes'>Yes</option>\
                                       <option value='no'>No</option>\
                                   </select><br/><br/>\
                                   Select the type of model to build:<br/>\
                                   <select name='typeOfModel'>\
                                       <option value='bSplineModel'>B-Spline Model (BSM) with weights of 1</option>\
                                       <option value='nurbsHyperModelVariable'>NURBs HyPerModel with variable weights</option>\
                                       <option value='nurbsHyPerModelPseudo'>NURBs HyPerModel with psuedo weights</option>\
                                   </select><br/><br/>\
                                   " + formEnding;
    document.getElementById(paragraphID).innerHTML = downloadConfigFileForm;
}