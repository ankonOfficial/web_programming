<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Your Information</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { 
            border: 2px solid black; 
            padding: 20px; 
            width: 400px; 
            margin: 50px auto; 
        }
        label, input, button { display: block; margin-bottom: 10px; }
        input[type="text"], input[type="date"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .submit-btn { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        .submit-btn:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Your Information</h2>
        <form action="submit.php" method="POST" oninput="name_gender.value = name.value + ' ' + gender.value">
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        
     <label for="gender_male">male</label>
            <input type="radio" id="gender_male" name="gender" value="male" required>
             <label for="gender_female">female</label>
            <input type="radio" id="gender_female" name="gender" value="female" required>
            <input type="text" id="name_gender" name="name_gender">

   

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
