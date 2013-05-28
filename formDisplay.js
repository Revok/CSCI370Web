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
                                   <div id='integerVariables' name='integerVariables'>\
                                   <b> Integer Variables</b><br/>\
                                   </div>\
                                   <input type='button' value='Add another Integer Variable' onClick=\"addAnotherIntegerVariable('integerVariables', 'removeInt')\"></input>\
                                   <input type='button' style='visibility:hidden' name='removeInt' id='removeInt' value='Remove an Integer Variable' onClick=\"removeIntegerVariable('integerVariables', 'removeInt')\"></input><br/>\
                                   RMS Error Tolerance for data point matching:  <br/><input type='text' name='RMSErrorTolerance' id='RMSErrorTolerance'></input><br/><br/>\
                                   Maximum RMS Error Tolerance for data point matching: <br/><input type='text' name='maxRMSErrorTolerance' id='maxRMSErrorTolerance'></input><br/><br/>\
                                   Correlation Coefficient Convergence Tolerance:<br/><input type='text' name='correlationCoefficient' id='correlationCoefficient'></input><br/><br/>\
                                   " + formEnding;
    document.getElementById(paragraphID).innerHTML = downloadConfigFileForm;
}
var counter=0;
function addAnotherIntegerVariable(divId, removeInputId) {
    if(counter == 0) {
	document.getElementById(removeInputId).style.visibility="visible";
    }

    counter++;
    var newDiv = document.createElement('div');
    newDiv.innerHTML = "Integer Var "+counter +"<br/><input type='text' name='integerVars[]' id='integerVars[]'></input><br/>";
    document.getElementById(divId).appendChild(newDiv);
}
function removeIntegerVariable(divId, removeInputId) {
    if(counter <= 0) return;
    counter--;
    document.getElementById(divId).removeChild(document.getElementById(divId).lastChild);
    if(counter == 0) document.getElementById(removeInputId).style.visibility="hidden";
}