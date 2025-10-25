<!DOCTYPE html>
<html>
    <head>
        <title>Multiupload Dokumen</title>
    </head>
    <body>
        <h2>Unggah Dokumen
        <form action="proses_upload_gambar.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif">
        <input type="submit" value="Unggah Gambar" />
    </form>
    </body>
</html>
