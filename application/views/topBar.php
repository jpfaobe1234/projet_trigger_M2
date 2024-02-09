<div class="navbar" id="myNavbar">
    <a href="<?= base_url('/') ?>"><h1>Zoky Manoro</h1></a>
    <a href="#" class="num"><h1>+261.34.52.928.15</h1></a>
    <div class="topnav-right">
        <a href="<?= base_url('login') ?>"><h3><i class="fa fa-sign-in-alt"></i> Admin</h3></a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
</div>


<style>
    .hr {
        
    }
    .topnav-right a h3 {
        float: right;
        font-size: 20px;
        padding: 0px 20px;
        color: #f2f2f2;
    }

    /* Place the navbar at the bottom of the page, and make it stick */
  .navbar {
    background-color: #CE5E10;
    overflow: hidden;
    top: 0;
    width: 100%;
    height : 20px;
    color: black
  }
  
  .num {
      margin-left:25%;
  }

  /* Style the links inside the navigation bar */
  .navbar a h1, .num{
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 0px 20px;
    text-decoration: none;
    font-size: 20px
  }

  /* Change the color of links on hover */
  .navbar a:hover {
    /* background-color: #ddd;
    color: black; */
  }

  /* Add a green background color to the active link */
  .navbar a.active {
    background-color: #04AA6D;
    color: white;
  }

  /* Hide the link that should open and close the navbar on small screens */
  .navbar .icon {
    display: none;
  }
</style>

<style>

    /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the navbar (.icon) */
@media screen and (max-width: 600px) {
  .navbar a:not(.num, .topnav-right a) {display: none;}
  .num {
      margin-left:0%;
  }
}

/* The "responsive" class is added to the navbar with JavaScript when the user clicks on the icon. This class makes the navbar look good on small screens (display the links vertically instead of horizontally) */
@media screen and (max-width: 600px) {
  .navbar.responsive a.icon {
    position: absolute;
    right: 0;
    bottom: 0;
  }
  .navbar.responsive a, .topnav-right a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>

<script>
    /* Toggle between adding and removing the "responsive" class to the navbar when the user clicks on the icon */
    function myFunction() {
    var x = document.getElementById("myNavbar");
    if (x.className === "navbar") {
        x.className += " responsive";
    } else {
        x.className = "navbar";
    }
    }
</script>