<?php

$pdo = new PDO('mysql:host=database;dbname=mydb;charset=utf8mb4', 'myuser', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function createIfDbNotExists($pdo,$dbName)
{
  $user='myuser';
  $host='database';
  $pass='secret';
  $sql = "CREATE DATABASE IF NOT EXISTS mydb";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

}


function createIfTableNotExists($pdo)
{
  $sql = "CREATE TABLE IF NOT EXISTS recipeds (
recipeId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
recipeName VARCHAR(30) NOT NULL,
recipePrepTime VARCHAR(30) NOT NULL,
recipePrepDifficulty VARCHAR(50),
recipeVegOrNot BOOLEAN NOT NULL,
recipeRating VARCHAR(50) NOT NULL
)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return;

}



function getTableRowCount($pdo,$tableName){
  $sqlGetEntryCount = "SELECT COUNT(*) AS noOfEntries FROM recipeds;";
  $stmtGetEntryCount = $pdo->prepare($sqlGetEntryCount);
    $stmtGetEntryCount->execute();
    $rowGetEntryCount = $stmtGetEntryCount->fetch(PDO::FETCH_ASSOC);
    if($rowGetEntryCount['noOfEntries']<20)
    {
      return 1;
    }
    else {
      return 0;
    }
}
function addSampleData($pdo,$recipeName,
$recipePrepTime,
$recipeDifficulty,
$recipeVegOrNot,
$recipeRating){
  $sql = "INSERT INTO recipeds ( recipeName,
  recipePrepTime,
  recipePrepDifficulty,
  recipeVegOrNot,
  recipeRating) VALUES ( :recipeName, :recipePrepTime ,:recipePrepDifficulty,:recipeVegOrNot, :recipeRating)";
  echo("<pre>\n".$sql."\n</pre>\n");
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':recipeName' => $recipeName,':recipePrepTime' => $recipePrepTime,':recipePrepDifficulty' => $recipeDifficulty,':recipeVegOrNot' => $recipeVegOrNot,':recipeRating' => $recipeRating));

}
createIfDbNotExists($pdo,'mydb');
// if(checkIfTableExists($pdo,'recipeds')==0)
// {
  createIfTableNotExists($pdo);
  $dessertName=array('ButterScotch','Mango','Orange','Pineapple','Chocolate');
  $recipe=array('ButterScotch' =>array('recipeName'=>"ButterScotch Ice Cream",
'recipePrepTime'=>10,
'recipePrepDifficulty'=>1,
'recipeVegOrNot'=>1,
'recipeRating'=>5),
'Mango'=>array('recipeName'=>"Mango Ice Cream",
'recipePrepTime'=>10,
'recipePrepDifficulty'=>1,
'recipeVegOrNot'=>1,
'recipeRating'=>5),
'Orange'=>array('recipeName'=>"Orange Ice Cream",
'recipePrepTime'=>10,
'recipePrepDifficulty'=>1,
'recipeVegOrNot'=>1,
'recipeRating'=>5),
'Pineapple'=>array('recipeName'=>"Pineapple Ice Cream",
'recipePrepTime'=>10,
'recipePrepDifficulty'=>1,
'recipeVegOrNot'=>1,
'recipeRating'=>5),
'Chocolate'=>array('recipeName'=>"Chocolate Ice Cream",
'recipePrepTime'=>10,
'recipePrepDifficulty'=>1,
'recipeVegOrNot'=>1,
'recipeRating'=>5));
if(getTableRowCount($pdo,'recipeds')==1)
{foreach($dessertName as $dessert)
{
  $recipeName=$recipe[$dessert]['recipeName'];
  $recipePrepTime=$recipe[$dessert]['recipePrepTime'];
  $recipeDifficulty=$recipe[$dessert]['recipePrepDifficulty'];
  $recipeVegOrNot=$recipe[$dessert]['recipeVegOrNot'];
  $recipeRating=$recipe[$dessert]['recipeRating'];
  addSampleData($pdo,$recipeName,
  $recipePrepTime,
  $recipeDifficulty,
  $recipeVegOrNot,
  $recipeRating);
}}




?>
<!DOCTYPE html>
<html>
<head>
<title>Docker Assignment</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript">
  //Search database for matching recipe details

$(document).ready(function(e){
  $('#search').keyup(function()
{
  $('#canBeModifiedOnInput').show;
  var text=$(this).val();
  $.ajax({
    type: "GET",
    url: "searchRecipe.php",
    data:'recipeSearchContent='+text,
    dataType: "json",
    encode: true,
  }).done(function (datas) {
  $('#canBeModifiedOnInput').html(datas);
  });
}
)
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
      $(".recipeDeleteForm").submit(function (event) {
alert("fdf");
          var recipeIdNo = $(".recipeNo", this).val();
          alert(recipeIdNo);

        $.ajax({
          type: "POST",
          url: "deleteAjax.php",
          data:'recipeIdNo='+recipeIdNo,,
          dataType: "json",
          encode: true,
        }).done(function (datas) {
        alert(datas);
        });


      });
    });



        $(document).ready(function () {
          $("#recipeEditSubmitForm").submit(function (event) {

              var recipeNoOfModalInput = $("#recipeNoOfModalInput", this).val();
              var recipeNameModalInput = $("#recipeNameModalInput", this).val();

              var recipeDurationModalInput = $("#recipeDurationModalInput", this).val();
              var recipeDifficultyModalInput = $("#recipeDifficultyModalInput", this).val();
              var recipeVegOrNotModalInput = $("#recipeVegOrNotModalInput", this).val();
              var recipeRatingModalInput = $("#recipeRatingModalInput", this).val();

            $.ajax({
              type: "POST",
              url: "editAjax.php",
              data:{
                recipeId:recipeNoOfModalInput,
                recipeName:recipeNameModalInput,
                recipePrepTime:recipeDurationModalInput,
                  recipePrepDifficulty:recipeDifficultyModalInput,
                    recipeVegOrNot:recipeVegOrNotModalInput,
              },
              dataType: "json",
              encode: true,
            }).done(function (dataEdit) {
              alert(dataEdit);
            });

          });
        });

        function addRatingDropdown()
        {

              var recipeNoOfModalInput = $("#recipeNoOfModalInput", this).val();
              var recipeRatingModalInput = $("#recipeRatingModalInput", this).val();

            $.ajax({
              type: "POST",
              url: "addRating.php",
              data:{
                recipeId:recipeNoOfModalInput,
                    recipeRating:recipeRatingModalInput,
              },
              dataType: "json",
              encode: true,
            }).done(function (dataEdit) {
              alert(dataEdit);
            });

          });


    //To send data and retrieve data to edit the information in the database

    $(document).ready(function () {
      $(".viewDataForm").click(function (event) {

          var recipeIdNo = $(".recipeNo", this).val();
          var dataStringToGetData = 'recipeIdNo='+ recipeIdNo;
          // alert(dataString);
          $.ajax({
            type: "POST",
            url: "getEditData.php",
            data:dataStringToGetData,
            dataType: "json",
            encode: true,
          }).done(function (datae) {
$("#recipeNoOfModalInput").val(datae.recipeId);
$("#recipeNameModalInput").val(datae.recipeName);
$("#recipeDurationModalInput").val(datae.recipePrepTime);
$("#recipeDifficultyModalInput").val(datae.recipePrepDifficulty);
$("#recipeVegOrNotModalInput").val(datae.recipeVegOrNot);
$("#recipeRatingModalInput").val(datae.rating);
          });
        });
        });

</script>
<div id="show_up"></div>
<!--
Add recipe begins
-->-

<script type="text/javascript">
$(document).ready(function () {
  $("#recipeAddSubmitForm").submit(function (event) {
      var recipeNameModalInput = $("#recipeNameModalInput", this).val();

      var recipeDurationModalInput = $("#recipeDurationModalInput", this).val();
      var recipeDifficultyModalInput = $("#recipeDifficultyModalInput", this).val();
      var recipeVegOrNotModalInput = $("#recipeVegOrNotModalInput", this).val();
      var recipeRatingModalInput = $("#recipeRatingModalInput", this).val();

    $.ajax({
      type: "POST",
      url: "addAjax.php",
      data:{
        recipeName:recipeNameModalInput,
        recipePrepTime:recipeDurationModalInput,
          recipePrepDifficulty:recipeDifficultyModalInput,
            recipeVegOrNot:recipeVegOrNotModalInput
      },
      dataType: "json",
      encode: true,
    }).done(function (dataEdit) {
      alert(dataEdit);
    });

  });
});
</script>

<!--


 -->

 <script type="text/javascript">

   $("#recipeDeleteForwmss").click(function (event) {
alert("DDD");
       var recipeNameModalsInput = $("#recipeNameModalsInput", this).val();

alert(recipeNameModalsInput);

   });
 </script>
 <form id="recipeDeleteForwmss" method="post" action="">
 <label for="recipeName">Recipe Name :</label>
     <input type="text" id="recipeNameModalsInput" class="all" name="recipeName" /><br>
     <button type="submit" name="addRecipe">Click</button>
   </form>
<!--


 -->
   <form id="recipeAddSubmitForm" method="post" action="">
   <label for="recipeName">Recipe Name :</label>
       <input type="text" id="recipeNameModalInput" class="all" name="recipeName" /><br>
       <label for="recipeDuration">Duration :</label>
       <input type="text" id="recipeDurationModalInput" class="all" name="recipeDuration" /><br>
       <label for="recipeDifficulty">Difficulty Level :</label>
       <select name="recipeDifficultyModalInput">
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
       </select>
       <label for="recipeVegOrNot">Vegetarian Or Not :</label>
       <select name="recipeVegOrNotModalInput">
         <option value="true">Vegetarian</option>
         <option value="false">Non-Vegetarian</option>
       </select>
       <input type="submit" name="addRecipe" value="Update">
     </form>
<!--

Add Recipe ends -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        <form id="recipeEditSubmitForm" method="post" action="">
        <input type="hidden" id="recipeNoOfModalInput" name="recipeNo" /><br>
        <label for="recipeName">Recipe Name :</label>
            <input type="text" id="recipeNameModalInput" class="all" name="recipeName" /><br>
            <label for="recipeDuration">Duration :</label>
            <input type="text" id="recipeDurationModalInput" class="all" name="recipeDuration" /><br>
            <label for="recipeDifficulty">Difficulty Level :</label>
            <select name="recipeDifficultyModalInput">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
            <label for="recipeVegOrNot">Vegetarian Or Not :</label>
            <select name="recipeVegOrNotModalInput">
              <option value="true">Vegetarian</option>
              <option value="false">Non-Vegetarian</option>
            </select>
            <label for="recipeRating">Recipe Rating :</label>
            <select name="recipeRatingModalInput">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <input type="submit" name="updateRecipe" value="Update">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<input type="text" id="search" name="names"/>
<table>
<thead>
  <tr>
<th>ID</th>
<th>Name</th>
<th>Preparation Time</th>
<th>Preparation Difficulty</th>
<th>VegOrNot</th>
<th>Rating</th>
<th>View</th>
<th>Delete</th>
  </tr>
</thead>
<tbody id="canBeModifiedOnInput"><?php

$sql = "SELECT * FROM recipeds";
// $stmt = $pdo->prepare($sql);
//   $stmt->execute();
//   $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM recipeds";
$stmt = $pdo->prepare($sql);
  $stmt->execute();
  $rowResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($rowResult)> 0) {
    // output data of each row
    foreach($rowResult as $rowRes){
    echo "<tr>";
  echo "<td>".$rowRes['recipeId']."</td>";
  echo "<td>".$rowRes['recipeName']."</td>";
  echo "<td>".$rowRes['recipePrepTime']."</td>";
  echo "<td>".$rowRes['recipePrepDifficulty']."</td>";
  echo "<td>".$rowRes['recipeVegOrNot']."</td>";
  echo '<td><form class="recipeEditSubmitFormDataForm" method="post" action=""><input type="hidden" class="recipeNoOfModalInput" name="recipeNoOfModalInput" value="'.$rowRes['recipeId'].'" /><select name="recipeRatingModalInput" id="recipeRatingModalInput" onchange="addRatingDropdown()"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></form></td>';
  echo '<td><form class="viewDataForm" method="post" action=""><input type="hidden" class="recipeNo" name="recipeNumber" value="'.$rowRes['recipeId'].'" /><input type="button" name="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" value="View"></form></td>';
  echo '<td><form class="recipeDeleteForm" method="post" action=""><input type="hidden" class="recipeNo" name="recipeNumber" value="'.$rowRes['recipeId'].'" /><input type="submit" name="deleteRecipe" value="Delete"></form></td>';
  echo '</tr>';
}
} else {
echo "No Data Available!";
}
 ?>
<tbody>
</table>

</body>
</html>
