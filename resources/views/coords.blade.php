<?php
/**
 * Created by PhpStorm.
 * User: Martin-NOTEBOOK
 * Date: 25.03.2018
 * Time: 19:13
 */

$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','bakalar');
if (!$con) {
    echo 'Could not connect: ' . mysqli_error($con);
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM locations WHERE device_id = '".$q."'";
$result = mysqli_query($con,$sql);

header("Content-type: text/xml");
echo '<markers>';
while($row = mysqli_fetch_array($result)) {
    echo '<marker id="' . $row['device_id'] . '" lat="' . $row['latitude'] . '" lng="' . $row['longtitude'] . '"/></marker>';
}
echo '</markers>'

?>
