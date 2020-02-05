<?php $page_title = 'GPuzzles > Create Puzzle'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="puzzles_list.php";
    verifyLogin($page);

?>
<?php 
    $mysqli = NEW MySQLi('localhost','root','','gpuzzles_db');
    $resultset = $mysqli->query("SELECT DISTINCT topic FROM topics ORDER BY topic ASC");   
?>
<link href="css/form.css" rel="stylesheet">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<div class="container">

    ?>
	    <form action="createThePuzzle.php" method="POST" enctype="multipart/form-data">
		<br>
        <h3 id="title">Create A Puzzle</h3> <br>
        
        <table>
            <tr>
                <td style="width:100px">Puzzle Type:</td>
                <td><select name="topic">
                    <?php 
                    while($rows = $resultset->fetch_assoc()){
                        $topic=$rows['topic']; 
                    echo"<option Value='$topic'>$topic</option>";}?>
                    </select></td>
            </tr>
            <tr>
                <td style="width:100px">Name:</td>
                <td><input type="text"  name="name" maxlength="100" size="50" required placeholder="Please enter puzzle name."></td>
            </tr>
            <tr>
                <td style="width:150px">Creator Name:</td>
                <td><input type="text"  name="creator_name" maxlength="50" size="50" required placeholder="Please enter creator name."></td>
            </tr>
            <tr>
                <td style="width:100px">Author Name:</td>
                <td><input type="text"  name="author_name" maxlength="50" size="50" required placeholder="Please enter author name."></td>
            </tr>
            <tr>
                <td style="width:100px">Book Name:</td>
                <td><input type="text"  name="book_name" maxlength="50" size="50" required placeholder="Please enterbook name."></td>
            </tr>
            <tr>
                <td style="width:100px">Notes:</td>
                <td><input type="text"  name="notes" maxlength="50" size="50" required placeholder="Please enter notes."></td>
            </tr>
            <tr>
                <td style="width:100px">Puzzle Image:</td>
                <td><input type="file" name="fileToUpload" id="fileToUpload" maxlength="50" size="50" placeholder="Please enter the puzzle image."></td>
            </tr>
            <tr>
                <td style="width:100px">Solution Image:</td>
                <td><input type="text" name="solution_image" id="solution_image" maxlength="50" size="50" placeholder="Please enter the solution image."></td>
            </tr>
        </table>

        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Puzzle</button>
        </div>
        <br> <br>

    </form>
</div>

