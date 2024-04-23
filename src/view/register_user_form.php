
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add post</title>
</head>
<body>
<form action="/register_user.php" method="post">
    <div>
        <label for="first_name">Имя:</label>
        <input name="first_name" id="first_name" type="text">
    </div>
    <div>
        <label for="last_name">Фамилия:</label>
        <input name="last_name" id="last_name" type="text">
    </div>
	<div>
		<label for="middle_name">Отчество:</label>
		<input name="middle_name" id="middle_name" type="text">
	</div>
	<div>
		<p>Please select your gender:</p>
		<input name="gender" id="male" value="male" type="radio">
		<label for="male">Male</label>
		<input name="gender" id="female" value="female" type="radio">
		<label for="female">Female</label>
	</div>
	<div>
		<input type="date" id="birth_date" name="birth_date">
		<label for="birth_date">Birthday (date and time):</label>
	</div>
	<div>
		<label for="email">Email:</label>
		<input name="email" id="email" type="email">
	</div>
	<div>
		<label for="phone">Номер телефона:</label>
		<input name="phone" id="phone" type="text">
	</div>
	
	<div>
		<label for="avatar_path">Картинка:</label>
		<input name="avatar_path" id="avatar_path" type="text">
	</div>
	
	<button type="submit">Submit</button>
</form>
</body>
</html>
