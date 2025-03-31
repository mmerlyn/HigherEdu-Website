<?php include_once 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.fa {
  font-size: 30px;
  cursor: pointer;
  user-select: none;
  color:black;
}

.fa:hover {
  color: red;
}


.heading
{
  font-size: 35px;
  font-family: 'PT Sans', sans-serif;
  color: #303030;
    letter-spacing: -1px;
    font-weight: bold;
}

*{
  box-sizing: border-box;
}


body
{
  margin:0;
  padding:0;
  font-family: 'PT Sans', sans-serif;
}


</style>

  </head>
 <body>

<div class="container">
  <nav class="navbar navbar-expand-lg">
      <div class="navbar-header">
            <a class="heading" href="hep_home.html">HIGHEREDUGUIDE.COM</a>
            <div class=" hamb">
        <button data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="glyphicon glyphicon-menu-hamburger visible-xs"></span>
                </button>
      </div>
      </div>
    <div class="collapse navbar-collapse newnavtop" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav nav-stack newnav" style="float: right; margin-top: 1%;">
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none; padding:10px;" href="hep_home.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none; padding:10px;" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none;padding:10px;" href="map.php">Universities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="border-radius: 0px;border:none;padding:10px;" href="hep_logout.php">Logout</a>
            </li>
        </ul>
      </div>
  </nav>
</div>

        <div class="wrap details">
            <div class="container-fluid">

                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <label for="filter_course"> Filter: </label><input style="width: 50%;" type="text" class="filter" id = "filter_course" name="filter_course" placeholder="Enter course of interest">

              <input type="button" id="fav" class="fav" name="fav" value="Add to Favorites" onclick="get_fav()"><label for="fav" class="favlabel">Display favorites:</label>
                       <br><br><br>
                    </div>
                 </div>
              </div>




<?php








if (!isset($_COOKIE['sid'])){
  echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
else{
  $query = "select username from student_register where sid='" . $_COOKIE['sid'] ."'";
  $data = mysqli_query($conn,$query) or die(mysql_error());
  $row = mysqli_fetch_array($data);

echo"<div class='container-fluid'><div class='row'><div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";


$col_name = $_GET['id'];
echo "<h2 class='tableheading'> Details for ".$col_name."</h2>";
$sql = "SELECT program_name, program_type, tution_1_currency, tution_1_money, tuition_price_specification, ielts_score, structure, city, academic_req FROM master_pgm where university_name='$col_name'";
$result = $conn->query($sql);

if($result) {


echo "<div class='table-responsive table-condensed'>
<table id=courses class='table table-striped'>
    <thead>
    <tr>
        <th class='col-xs-1'> Programme </th>
        <th class='col-xs-1'> Like </th>
        <th class='col-xs-1'> IELTS score </th>
        <th class='col-xs-1'>Tution</th>
        <th class='col-xs-2' colspan='2'>Courses offered</th>
        <th class='col-xs-1'>City</th>
        <th class='col-xs-5'>Academic Requirements</th>
        </tr>
        </thead>
        ";
echo "<tbody>";
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //array_push($score_rank, $row['Score_Rank']);
    //<td colspan='2'>".$row['structure']."</td>
    //$courses = trim($row['structure'], "[]'");
    //echo $courses;
    $courses = explode('\', \'',trim($row['structure'], "[]'"));
    if(count($courses)<=1) {
      $courses =array('To be updated');
    }

    $cities = explode('\', \'',trim($row['city'], "[]'"));
    if(count($cities)<1) {
      $cities =array('To be updated');
    }


    echo "<tr>
            <td>".$row['program_type']." - ".$row['program_name']."</td>
            <td><i onclick=myFunction(this) class='fa fa-heart'> </i> </td>
            <td>".$row["ielts_score"]."</td>
            <td>".$row['tuition_price_specification']."  ".$row["tution_1_money"]." ".$row["tution_1_currency"]."</td>
            <td colspan='2'> <ul>"."<li>".implode('</li><li>', $courses)."</li>"."</ul></td>
            <td> <ul>"."<li>".implode('</li><li>', $cities)."</li>"."</ul></td>
            <td>".substr($row['academic_req'],98,-21)."</td>
          </tr>";

  }
  $result -> free_result();
}
echo "</tbody>";
echo "</table></div>";
}
else {
  echo "<br>";
  echo 'No data';
}
}


?>




  <script type="text/javascript">
    $(document).ready(function() {
      $("#filter_course").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#courses tr").filter(function() {
          $(this).toggle($(this).find('td:first').text().toLowerCase().indexOf(value)>-1)
        });
      });
    });


    function myFunction(x) {
      if(x.style.color == "tomato") {
        x.style.color = "black";
      } else {
        x.style.color = "tomato";
      }

    }



    function get_fav() {
      var fav_program = [];
      //console.log('inside get_fav function');
      $('#courses tr').filter(function() {
        //console.log('inside tr filter');
        if($(this).find('td:eq(1) i.fa').css( "color" )!='rgb(0, 0, 0)') {
          //var color2 = $( this ).css( "color" );
          //console.log('color: red '+color2);
          course_name =$(this).find('td:eq(0)').text();
          if(course_name.length>0) {
            //console.log(course_name);
            fav_program.push(course_name);
          }

        }
        //return $(this).find('td').css('color') == 'black';
      })
      console.log(fav_program);
      console.log("-------------------------------------");
      var catt = 'cat';
      <?php $cat = "dog"; ?>;
      $.ajax({
        url: './profile_fav.php/',

                    method: "GET",

                    data: {'cat' : fav_program},

                    success: function(data, url)
                    {
                        alert("success!");
                        //window.location.href = this.url;
                        //window.location.href = 'profile_fav.php';
                    }
                });
    }
  </script>


    <script>

    


     function openNav() {
            document.getElementById("myNav").style.height = "100%";
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }


    </script>





              </div>
                    </div>
                </div>
            </div>
        </div>

  </body>
</html>




