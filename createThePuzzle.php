<?php

include_once 'db_configuration.php';

if (isset($_POST['topic'])){

    echo "HERE";
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $creator_name = mysqli_real_escape_string($db,$_POST['creator_name']);
    $author_name = mysqli_real_escape_string($db,$_POST['author_name']);
    $book_name = mysqli_real_escape_string($db,$_POST['book_name']);
    $notes = mysqli_real_escape_string($db,$_POST['notes']);
    $solution_image = mysqli_real_escape_string($db,$_POST['solution_image']);
    $fileToUpload = basename($_FILES["fileToUpload"]["puzzle_image"]);
    $validate = true;
 
    if($validate){
        
        $target_dir = "Images/$puzzle_image/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        if ($uploadOk == 0) {
            
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                
                $sql = "INSERT INTO gpuzzles(name,creator_name,author_name,book_name,notes,solution_image,puzzle_image)
                VALUES ('$name','$creator_name','$author_name','$book_name','$notes','$solution_image','$target_file')
                ";

                mysqli_query($db, $sql);
                header('location: puzzles_list.php?createPuzzle=Success');
                }
            }
        }else{
            header('location: createPuzzle.php?createPuzzle=answerFailed'); 
    }        

}//end if

function emailValidate($answer){
    global $choice1,$choice2,$choice3,$choice4;
    if($answer == $choice1 or $answer == $choice2 or $answer == $choice3 or $answer == $choice4){
        return true;
    }else{
        return false;
    }      
}


?>