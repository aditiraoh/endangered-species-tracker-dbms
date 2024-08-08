<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <style>
      body{
        background-image: url('https://img.freepik.com/free-vector/gradient-background-green-modern-designs_343694-2067.jpg');
        background-attachment: fixed;
        background-size: cover;
      }
      th{
        font-weight: bolder;
        font-family: Copperplate Gothic Heavy;
        font-size: xx-large;
        
      }
      input[type=button]{
            border: black;
            text-align: center;
            background-color: rgb(0,100,0);
            padding:20px;
            color: white;
            font-size: large;
            font-weight: bold;}
            input[type=button]:hover{
              background-color: #808000;
              color: black;
            }
             
.navbar {
  overflow: hidden;
  background-color: rgb(0,100,0);
  position: fixed; 
  top: 0; 
  width: 100%; 
  
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 15px;
  text-decoration: none;
}

.navbar a:hover {
  background: #808000;
  color: black;
}

.main {
  margin-top: 30px; 
}


.main {
  margin-bottom: 30px; 
}

#myBtn {
  display: none; 
  position: fixed; 
  bottom: 20px; 
  right: 30px; 
  z-index: 99; 
  border: black;
  outline: none; 
  background-color: rgb(0, 100, 0);
  color: white; 
  cursor: pointer; 
  padding: 15px; 
  border-radius: 10px; 
  font-size: 18px; 
  border: 2px solid black;
}

#myBtn:hover {
  background-color: #808000;
  color: black
}
    </style>
</head>
<body>
    <div class="navbar">
        <a href="HomePage.php"><b>HOME</b></a>
        <a href="#about"><b>ABOUT US</b></a>
        <a href="#contact"><b>CONTACT US</b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        <a href="#"><b></b></a>
        

        <a href="Login.php"><b>LOGIN</b></a>
        <a href="SignUp.php"><b>SIGN UP</b></a>
      </div>
      
      <div class="main"><br>
    <center>
      <table>
    <center><tr>
             
            <th>Endangered Species Tracker</th>
        </tr></center>
        <tr>
            <td style="font-family: Agency FB;font-weight:bold;">
                <h3>We provide</h3>
                <ul>
                    <li>Where is it found?</li>
                    <li>What is its Conservation Status?</li>
                    <li>About the Species</li>
                    <li>The details about its habitat</li>
                    <li>User-friendly experience</li>
                </ul>
            </td>
            <td><br><br>
                
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="font-size:xx-large;font-family: Impact;">Want to know more about the species around you?<br><br>
                <input type="button" value="Sign Up now!" onclick="loadSignupPage()">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:larger;font-family: Cascadia Mono;"><br><br>
                <div id="about">
                <b>About Us:</b><br><br>
Welcome to EST, where our passion for wildlife conservation drives our mission. <br>
<b>Our mission is to:</b><br>
<b>Raise Awareness:</b><br> Shed light on the plight of endangered species, fostering understanding and empathy.<br>
<b>Promote Conservation:</b><br> Support and showcase ongoing conservation projects that make a tangible difference.<br>
<b>Encourage Action:</b><br>Provide opportunities for individuals to actively participate in conservation efforts.<br>
Join us in our journey to make a positive impact on the world we share with these incredible creatures.<br>
Together, let's ensure a future where endangered species are no longer at risk.<br>
Thank you for being a part of the EST community!<br><br>
            </div>
            </td>
        </tr>
        <tr>
      </tr>
        <tr>
            <td colspan="2" style="font-size:larger;font-family: Cascadia Mono;"><br><br>
                <div id="contact">
                <b>Contact Us:</b><br><br>
                Email ID: ESTadmin@gmail.com<br>
                Phone Number: +91 99999 88888<br>
                Follow us on our socials:<br>
                <a style="margin: 5px 5px 5px 5px  ;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsHf0ryHKgxrjLBI1h7nzFpIek4oF85lN1YQjVHgwxddA7TDb9GzR8&usqp=CAE&s" alt="insta" style="width: 35px ;border:100px">
                </a>
              <a style="margin: 5px 5px 5px 5px ;">
                  <img src="data:image/png;base64,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" alt="x" style="width: 40px ;border:100px">
              </a>
               <a style="margin: 5px 5px 5px 5px ;">
                   <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIALsAxgMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABwgDBQYEAgH/xABEEAABAwMBAQgNCwMFAAAAAAAAAQIDBAUGETEHEiFhcYGywRM2QVFVcnSRlKGx0dIUFRYiIzI0QmKjwjOEpCQlNUWC/8QAGwEBAAIDAQEAAAAAAAAAAAAAAAIEAwUGAQf/xAA0EQABAwEEBggGAwEAAAAAAAAAAQIDBAYRUZEFEhQxQdEhMkJScYGhsRMiM2HB4ZKi8Bb/2gAMAwEAAhEDEQA/AO1qd1SyRuVsFNWzafmRjWovnXX1Gtn3W2oulPZ1VO/JUaepGkXA0y1ky8T6Syzmj272qviq/i4kGfdYurvw9vomePvnexUPJJuoZA/XetomeLEvW44kEFqJV7RabobR7d0Se51km6Nk79lbGzxYGdaHnXPMnXbdX80UafxObBH40neXMzJo2iTdE3+KG/dmmSP23eo5tE9iGJ2W5C7beKzmkVDSg8+I/FTIlFTJujbkhtX5LfX7bzcOapenWfP0ivnhm4+lP95rAea7sSezQ9xMkNkuQXpdt4uC/wB0/wB58/Pt48LV/pL/AHmvB5ruxPdnh7qZIbD5+vPhav8ASX+8/fn+8+F6/wBJf7zXAa7sRs8XdTJDZ/SG+eGbj6U/3hMivif9zcfSn+81gPdd2J5s8PcTJDcNyvIG7LzW88yqZEzHI02Xiq53amjA+I/EitHTLvjbkh0TM5yZmy7S87Gr7UMjc/yhq6/Oirywxr/E5kHvxZO8uZBdH0a74m/xTkddHukZKz71VC/xoG9Wh6mbqV/b96Khf40Tupxw4JJPKnaUxO0TQu3xNyJCg3WLo1P9RbqN6/oVzfaqnug3W010qLNonfZUdStIvBJKqZOJgfoHRzt8fqvMmKDdVsr0+2pK6NeJjXJ0gQ6Ce2ylZbM0C8FzAAKp0AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPZXWqut8UEtXTSRxVDEfFIqate1U1TRdmzubTxlhbDS09biVsp6uCOaF9HFvmSNRUX6qGeCH4t6Xmo0tpNdHox+reircv6K9AlDJ9y9F39Tjsmi7fkkrui5fYvnI1rKOpoah9PWQSQTM+8yRuikJIXxr8yFmi0jTVrb4XdOHFPIwgAxl4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFi8W7WrV5HF0EK6Fi8W7WrV5HF0EL9B1lOTtb9GPxX2Noa292K23yn7DcqZkqJ91+x7OR21DZA2SoipcpxEcj43I9i3KmBDOT7m9xtm/qLUrq6lTh3qJ9qxOT83N5jhlRWqqORUVOBUXuFnznMmwu05AjpJYvk9YqcFTCmjlX9SbHc/DxlCaiRemM63R1qHNuZVpeneTf5pyIDB0WS4bdsfc580XZ6TuVMKat/8ASbW8/BxnOmuc1zVuch2ME8U7NeJ16fYAA8MoAAAAAAAAAAAAAAAAAAAAAAAALF4t2tWryOLoIV0LF4t2tWryOLoIX6DrKcna36MfivsbQAGzOFAAAPxyI5FRyIqLwKi904XJ9za33FHT2hW0NTt3iJ9k/m/LzeY7sEHxtkS5yFqlrJ6R+vC65f8AbyuN6sdxsdR2C5Uz4lVfqv2tfyLsU1xZito6avpnU1bBHPC/ayRuqEPboOJ2qwqk1vuDGOeqaUMi756J32r3vG867DWT0ixprNXoO40VaBlW5IZW3PXDpReXt9ziAAUzpAAAAAAAAAAAAAAAAAAAAAAWLxbtatXkcXQQroWLxbtatXkcXQQv0HWU5O1v0Y/FfY2gANmcKAD5lkZDG6SV7WRtTVznLoiJ31UDefR5LncqK1Urqm4VMcESfmeu3iRNqrxIcRk+6bSUe/p7ExtXMnAs7/6beTuu9ScpF10uldd6lai5VUlRL3FevAnEibETkKc1Y1nQ3pU6TR1m56i58/yN9V8uHnkdzk+6dUVO/prAxaeLYtS9E37vFTY328hHs0sk8rpZ5HySPXVz3uVVcvGqnwDWySvkW9ynb0dBT0bNWFt334r4qAAYy2AAAAAAAAAAAAAAAAAAAAACxeLdrVq8ji6CFdCxeLdrVq8ji6CF+g6ynJ2t+jH4r7G0BqL/AJJa8fh39wqESRU1ZAzhkfyJ1rohFGT7oN0vO+go1Who14N7G7670/U7qT1lyWoZFv3nNaP0NVVy3tS5uK7vLEkPJ88tVi38MbvllanB2GJ3A1f1O7nJwrxETZFlV1yGRfls6tg11bTx/VY3m7q8a6mkBq5al8nRuQ7rR+haWi+ZE1nYr+MAADAbcAAAAAAAAAAAAAAAAAAAAAAAAAAAHdVW6NVQ2Wjttmi7A6GnZFJUyIiuVUaiLvU2Js2r6jhQTZI5l+qu8rVFHBUq1ZW36vShkqJ5amZ81RK+WV66ue9yuVy8aqYwCBZRERLkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOlqMCyaBV1tjnondjkY7XzLqa2fHb3AqpLaK5und+TuVPPoWMBtFoGcFU4NlrKlOuxq5pzKyz0tRT/iIJYvHYrfaYiz5ifTwSf1IY3eM1FILQYO9Cy213eh/t+isoLISWW1SLrJbKJ6/qp2L1GB2MWFy6rZrfzU7fcR2B2JmS1sPGNc0K7AsG/EMdfts9JzM09hjdhONO22iDmVydZ5sD8UMiWspeLHenMgAE7yYHjC6/7W1OSaRP5GH6A4x4M/yJfiI7DJihkS1NGvZdknMg4E0SYNjabLb+/J8R534VjybLf+/J8RHY5MUMqWkpF7Lsk5kPglz6GY/4P/ek+I+kwvHtP+P/AHpPiGyPxQn/ANDS912ScyIQTFFhOOu2279+T4j2x4FjKt1W2f5EvxHqUUi8UMbrTUjd7XZJzIQBObMBxhF1+bE555fiPUzB8ZanBaYud7l6ySUMmKGJ1qqRNzHenMgIFgW4bjjdlopudqr7TM3FrA3ZZqDngavUe7A/Exraym4Ru9CvALHR2GzxadjtNC3TvUzPceuOlpotOx08TNNm9YiEkoF4uMTrWx9mJc/0Vrgpaio/D08sviMV3sNhT4zfahfsrRWrxrA5qedULFAklAnFxXfa2RepEieK3/hCCafc9yabVVt6RJ35JmJr6wTsDJsMeKlVbVVqr0NbkvM//9k=" alt="youtube" style="width: 35px ;border:100px">
               </a>
               <a style="margin: 5px 5px 5px 5px ;">
                  <img src="data:image/png;base64,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" alt="linkedin" style="width: 35px ;border:100px">
               </a>
            </div>
            </td>

        </tr>
    </table></center>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Go To Top</button>
</div>
    <script>
        function loadloginPage() 
        {
            window.location.href = "Login.php";
        }
    
        function loadSignupPage() 
        {
            window.location.href = "SignUp.php";
        }
        let mybutton = document.getElementById("myBtn");

window.onscroll = function() {
  scrollFunction()
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.documentElement.scrollTop = 0; 
}
    </script>
</body>
</html>