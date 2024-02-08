<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin - Admin Dashboard</title>
    <link rel="stylesheet" href="{{asset('assets/admin/css/add.css')}}">
</head>
<body>
<div class="container">
    <h2>Create Admin</h2>
    <form>
        <label for="adminName">Name:</label>
        <input type="text" id="adminName" name="adminName" required>
        <label for="adminImage">Image:</label>
        <input type="file" id="adminImage" name="adminImage" required>
        <label for="adminEmail">Email:</label>
        <input type="text" id="adminEmail" name="adminEmail" required>
        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" name="adminPassword" required>
        <button type="submit">Create</button>
    </form>
</div>
</body>
</html>
