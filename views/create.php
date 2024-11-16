<!DOCTYPE html>
<html>
<head>
    <title>Add New Transactions</title>
</head>
<body>
<form action="/transactions/store" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileName" />
    <button type="submit">Upload</button>
</form>
</body>
</html>