<form name="frmImportFile" method="POST" enctype="multipart/form-data"  class="form">
<input type="file" name="import_file" id="import_file" ><br><br>

<input type="button" name="loadFile" value="Загрузить" onclick=" if(document.getElementById('import_file').value.length > 4) { document.frmImportFile.submit(); }">
</form> 