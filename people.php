<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $people_name = '';
    $people_isactor = 0;
    $people_isdirector = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Person</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>Person Name</td>
     <td><input type="text" name="people_fullname"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr><tr>
      <td>Is Actor</td>
      <td><input type="number" min="0" max="1" name="people_isactor" 
      value="<?php echo $people_isactor; ?>"/></td>
    </tr><tr>
      <td>Is Director</td>
      <td><input type="number" max='1' min='0' name="people_isdirector" 
      value="<?php echo $people_isdirector; ?>"/></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
