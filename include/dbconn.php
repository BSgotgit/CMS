<?php
$server= 'localhost';
$user= 'root';
$password='1234';
$db='content_managment';

$conn=mysqli_connect($server,$user,$password,$db);

if($conn)
{
    //echo"Connection Established ".'<br>';
}
else
{
    echo'No connection'.'<br>';
}

//$sql='select * from stock';
//$run_sql=mysqli_query($conn,$sql);
//
//while($rows=mysqli_fetch_array($run_sql))
//{
//     echo $rows['pcode'].'  '.$rows['1'].'  '.$rows['2'].'  '.$rows['3'].'<br>';
//}

?>