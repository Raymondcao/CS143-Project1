
<html>
<head></head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
Identity:  <input type="radio" name="identity" value="actor">Actor  <input type="radio" name="identity" value="director">Director <br>
First name: <input type="text" name="firstname"><br>
Last name: <input type="text" name="lastname"><br>
Sex: <input type="radio" name="sex" value="m">Male  <input type="sex" name="f" value="director">Female
DOB: <input type="date" name="dob"><br>
DOD: <input type="date" name="dod"><br>
<input type="submit" value="Submit"/>
</form>
</body>
</html>