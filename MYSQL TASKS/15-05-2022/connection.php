<?php
error_reporting(E_ERROR | E_PARSE);
$connection = mysqli_connect('localhost','root','','courses');
if(mysqli_connect_errno()){
    die("Sorry the database does not connected");
}
$courseid = $_GET['course_id'];
$course_name = $_GET['course_name'];
$course_lecturer = $_GET['course_lecturer'];
$course_duration = $_GET['course_duration'];
$course_date = $_GET['course_date'];
if(isset($_GET['add'])){
$insertdata = "INSERT INTO course (course_id,course_name,course_lecturer,course_duration,course_date) 
               VALUES ('$courseid','$course_name','$course_lecturer','$course_duration','$course_date')";
mysqli_query($connection,$insertdata);
}
if(isset($_GET['delete'])){
$deletedata = "delete from course where course_id=\"$_GET[course_id]\"";
mysqli_query($connection,$deletedata);
}
if(isset($_GET['update'])){
$updatedata = "update course set course_name = '$_GET[course_lecturer]' where  course_name = '$_GET[course_name]'";
mysqli_query($connection,$updatedata);
}

