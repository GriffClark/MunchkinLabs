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
                $ids = array(); // FIXME this solution is terrible
                $i = 0;
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
                    array_push($questions, $row['questionText']);
                    array_push($ids, $row['id']);
                }
                $_SESSION["question-id-array"] = $ids;

                foreach($questions as $line) {
                    echo "<div class='form-group survey-question' id='questionGroup$i'>";
                    echo "<p style=\"color:white;\">$line</p>";
                    echo "<input type='radio' name='qestion$i value='yes'>";
                    echo "<label for=\"yes\" style=\"color:white;\"> Yes </label><br>";
                    echo "<input type='radio' name='qestion$i' value='no'>";
                    echo "<label for=\"no\" style=\"color:white;\"> No </label><br>";
                    echo "</div>";
                    $i++;
                  }
                ?>  
                <div class="form-group">
                    <button id="back-btn" class="btn float-left login_btn">Back</button>
                    <button id="next-btn" class="btn float-right login_btn">Next</button>
                </div>
                </form>
            </div>
		</div>
	</div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        // Prevent back button from immidiately submitting form
        document.getElementById("back-btn").addEventListener("click", (event)=>{
            event.preventDefault();
        })

        // Prevent next button from immidiately submitting form
        document.getElementById("next-btn").addEventListener("click", (event)=>{
            event.preventDefault();
        })

        // Hide the survey questions
        $(".survey-question").hide();

        let i = 0; // This will track which question we're on
        let iMax = document.querySelectorAll("#main-div .survey-question").length;
        
        // DEBUG
        console.log("iMax: " + iMax);

        // Show the first question
        $("#questionGroup"+i).show();

        // Script for the 'next' button
        $("#next-btn").click(() => {
            // After the user clicks 'next', hide this question and show the next one
            $("#questionGroup"+i).hide();
            $("#questionGroup"+(i+1)).show();
            
            // Update which question we're on
            i++;
            
            // DEBUG
            console.log("i: " + i);

            // If it's the last question, tell our user it's going to submit the form
            if(i == (iMax - 1)){
                $("#next-btn").text("Submit");
            }
            // If it's the last question, submit the form
            else if(i == iMax){

                let questionAnswerPairs = [];
                // Instead of just posting the yes/no data, we want to include the questions the data corosponds too as well
                // document.getElementById("survey").submit();
                const answers = $(".survey-question");
                for(var i = 0; i < answers.length; i++) {
                    questionAnswerPairs.push([answers[i].value, $_SESSION["question-id-array"][i]]);
                } 
                console.log(questionAnswerPairs);
            }
        });

        // Script for the 'back' button
        $("#back-btn").click(()=>{
            if( i > 0){
                // After the user clicks 'back', hide this question and show the previous one
                $("#questionGroup"+i).hide();
                $("#questionGroup"+(i-1)).show();
                
                // Update which question we're on
                i--;
            }
            else{
                //DEBUG
                console.log("Couldn't go back. Currently ont he first question.")
            } 
        });
    });
</script>

<?php
include_once 'footer.php';
?>