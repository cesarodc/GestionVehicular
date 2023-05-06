<?php        
    $uploaddir = '../assets/uploaded/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    echo "<p>";

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Upload failed";
    }

    $nplaca= $_FILES['userfile']['name'];

    //print($nplaca);

    echo json_encode($_FILES['userfile'], JSON_PRETTY_PRINT);
    //header('Location:/lector.?../assets/uploaded/'.$nplaca);


    header('Location:lector.py?../assets/uploaded/'.$nplaca);
?>
