var formEnding    = "<label type='file'>Data Filename: </label>\
<input type='file' name ='DataFile' id='DataFile'></input><br/>\
<input type='submit' name='submit' text='Submit'></input>\
</form>";
function displayUploadConfigFile(paragraphID) {
    var uploadConfigFileForm = "<form action='uploadFile.php?uploadedFile=true' method='post' enctype='multipart/form-data'>\
                               <label type='file'>Configuration Filename:</label>\
                               <input type='file' name='ConfigFile' id='ConfigFile'><br/>" + formEnding;

    document.getElementById(paragraphID).innerHTML = uploadConfigFileForm;
}
function displayBuildConfigFile(paragraphID) {
    var downloadConfigFileForm = "<form action='uploadFile.php?uploadedFile=false' method='post' enctype='multipart/form-data'>\
                                   Number of Design Variables (nDv):    <br/><input type='text' name='nDv' id='nDv'></input><br/><br/>\
                                   Number of Cycle Parameters (nCp):    <br/><input type='text' name='nCp' id='nCp'></input><br/><br/>\
                                   Number of Performance Indices (nPi): <br/><input type='text' name='nPi' id='nPi'></input><br/><br/>\
Number of integer variables:       <br/><input type='text' name='IntegerVars' id='IntegerVars'></input><br/><br/>" + formEnding;
    
    document.getElementById(paragraphID).innerHTML = downloadConfigFileForm;
}