<?php

// Check if the form is submitted
if(isset($_POST['Submit'])){
    // Fetching form data and handling potential missing inputs
    $Name = $_POST['name'];
    $Rollno = $_POST['rollno']; 
    $Class = $_POST['class'];
    $Section = $_POST['section'] ;
    $Mobile = $_POST['mobile'];
    $Bname = $_POST['bname'];
    $Bid = $_POST['bid'];
    $Date =$_POST['issuedate'];
    $Bp = $_POST['bp'];
    $Author = $_POST['AN'];

    // Check if issuedate is provided, otherwise handle error
    if (empty($Name) || empty($Rollno) || empty($Class) || empty($Section) || 
        empty($Mobile) || empty($Bname) || empty($Bid) || empty($Date) || 
        empty($Bp) || empty($Author)) {
        die("All fields are required. Please fill in the missing data.");
    }

    // Create connection to the MySQL server
    $conn = mysqli_connect("localhost", "root", "");

    // Check connection
    if (!$conn) {
        die("Not Connected to the server: " . mysqli_connect_error());
    }

    // Create database if it does not exist
    $sql = "CREATE DATABASE IF NOT EXISTS library";
    if (!mysqli_query($conn, $sql)) {
        die("Couldn't create the Database: " . mysqli_error($conn));
    }

    // Select the database
    mysqli_select_db($conn, 'library');

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS student (
        Name VARCHAR(50),
        Rollno BIGINT(20),
        Class VARCHAR(20),
        Section VARCHAR(20),
        Mobile BIGINT(20),
        Book_Name VARCHAR(100),
        Book_Id INT(10),
        Issue_Date DATE,
        Book_Price DECIMAL(10, 2),
        Author VARCHAR(100)
    )";

    if (!mysqli_query($conn, $sql)) {
        die("Table Not Created: " . mysqli_error($conn)); 
    }

    // Format the date for MySQL (Y-m-d format)
    $formattedDate = date('Y-m-d', strtotime($Date));

    // Insert data into the table
    $sql = "INSERT INTO student (Name, Rollno, Class, Section, Mobile, Book_Name, Book_Id, Issue_Date, Book_Price, Author) 
            VALUES ('$Name', $Rollno, '$Class', '$Section', $Mobile, '$Bname', $Bid, '$formattedDate', $Bp, '$Author')";

    if (!mysqli_query($conn, $sql)) {
        die("Data Not Inserted: " . mysqli_error($conn)); 
    } else {
        echo "Data Inserted Successfully<br>";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Please Enter Data";
}
?>
