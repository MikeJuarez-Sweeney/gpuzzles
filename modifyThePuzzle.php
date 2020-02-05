<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $creator_name = mysqli_real_escape_string($db, $_POST['creator_name']);
    $author_name = mysqli_real_escape_string($db, $_POST['author_name']);
    $book_name = mysqli_real_escape_string($db, $_POST['book_name']);
    $puzzle_image = mysqli_real_escape_string($db, $_POST['puzzle_image']);
    $solution_image = mysqli_real_escape_string($db, $_POST['solution_image']);
    $notes = mysqli_real_escape_string($db, $_POST['notes']);
    $oldimage = mysqli_real_escape_string($db, $_POST['oldimage']);
    $imageName = basename($_FILES["fileToUpload"]["name"]);
    $validate = true;
    $validate = emailValidate($answer);
    
    
    if($validate){
    
        if($imageName != ""){
            $target_dir = "Images/$topic/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            unlink($oldimage);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    header('location: modifyPuzzle.php?modifyPuzzle=fileRealFailed');
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                header('location: modifyPuzzle.php?modifyPuzzle=fileExistFailed');
                $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                header('location: modifyPuzzle.php?modifyPuzzle=fileTypeFailed');
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo $target_file;       
                    $sql = "UPDATE gpuzzles
						SET name = '$name',
                        creator_name = '$creator_name',
                        author_name = '$author_name',
                        book_name = '$book_name',
                        puzzle_image = '$puzzle_image',
                        solution_image = '$solution_image',
                        notes = '$notes'
                           
                    
                    WHERE id = '$id'";

                    mysqli_query($db, $sql);
                    header('location: puzzles_list.php?puzzleUpdated=Success');
                    }
                }
        }
                else{
                    
                $image = $_SESSION["image"];
            
                $sql = "UPDATE gpuzzles
						SET name = '$name',
                        creator_name = '$creator_name',
                        author_name = '$author_name',
                        book_name = '$book_name',
                        puzzle_image = '$puzzle_image',
                        solution_image = '$solution_image',
                        notes = '$notes'
                           
                    
                    WHERE id = '$id'";

                mysqli_query($db, $sql);
                
                header('location: puzzles_list.php?puzzleUpdated=Success');
                }
    }else{
        header('location: modifyPuzzle.php?modifyPuzzle=answerFailed&id='.$id);}
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
