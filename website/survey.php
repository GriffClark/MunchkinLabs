<?php
include_once 'header.php';
?>
<div class="container" id="main-div">
    <div class="col" style="margin-top: 2rem;">
    <div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3> Survey </h3>
			</div>
			<div class="card-body">
                <form action="survey.inc.php" id="survey" method = "post">
                <?php
                $questions = array(); // This is where we will store the text from the questions
                //Pull out intake questions from the database
                $sql = "SELECT * FROM questions WHERE intakeQuestion = 1;";
                $stmt = mysqli_stmt_init($conn);  

                if(!$conn){
                    header("location: ../../index.php?error=noConn");
                      exit();
                }

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../../index.php?error=stmtfailed");
                   exit();
                }
                
                mysqli_stmt_execute($stmt);
                $resultData = mysqli_stmt_get_result($stmt);

                while($row = mysqli_fetch_array($resultData)) {
                    $id = $row['id'];
                    $questionText = $row['questionText'];
                    echo "<div class='form-group survey-question' id='questionGroup$id'>";
                    echo "<p style=\"color:white;\">$questionText</p>";
                    echo "<input type='radio' name='question$id' value='yes'>";
                    echo "<label for=\"yes\" style=\"color:white;\"> Yes </label><br>";
                    echo "<input type='radio' name='question$id' value='no'>";
                    echo "<label for=\"no\" style=\"color:white;\"> No </label><br>";
                    echo "</div>";
                }
                ?>  
                <div class="form-group">
                    <button id="back-btn" class="btn float-left login_btn">Back</button>
                    <button id="next-btn" type="submit" name="submit" class="btn float-right login_btn">Next</button>
                </div>
                </form>
            </div>
		</div>
	</div>
    </div>
  </div>
</div>

<script>
    $(document).ready(()=> {
        // Init
    let questions = document.querySelectorAll("#main-div .survey-question");
    currentQuestionIndex = 0;

    // Prevent back button from immidiately submitting form
    document.getElementById("back-btn").addEventListener("click", (event)=>{
        event.preventDefault();
    })

    // Prevent next button from immidiately submitting form
    document.getElementById("next-btn").addEventListener("click", (event)=>{
        if(currentQuestionIndex != (questions.length - 1)){
            event.preventDefault();
        }
    })

    // Hide the survey questions
    for (let i = 0; i < questions.length; i++) {
        questions[i].style.display = 'none';
    }

    // Show the first question
    $(questions[currentQuestionIndex]).show();

    // Script for the 'next' button
    $("#next-btn").click(() => {

        // After the user clicks 'next', hide this question and show the next one
        $(questions[currentQuestionIndex]).hide();
        currentQuestionIndex++;
        $(questions[currentQuestionIndex]).show();

        // If it's the last question, tell our user it's going to submit the form
        if(currentQuestionIndex == (questions.length - 1)){
            $("#next-btn").text("Submit");
        }
        // If it's the last question, submit the form
        // if(currentQuestionIndex == questions.length){
        //     // document.getElementById("survey").submit();
        //     // DEBUG
        //     // document.write(decodeURI($('#survey').serialize()));
        // }
    });

    // Script for the 'back' button
    $("#back-btn").click(()=>{
        // After the user clicks 'back', hide this question and show the previous one
        $(questions[currentQuestionIndex]).hide();
        currentQuestionIndex--;
        $(questions[currentQuestionIndex]).show();
        
    });
    });
     
</script>

<?php
include_once 'footer.php';
?>