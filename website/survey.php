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
                <form action="survey.inc.php" id="survey">
                <?php
                //XXX should this be moved to a CSV file?
                $questions = array("Do you wear a watch?",
                "Do you enjoy camping?",
                "Are you over 35 years old?",
                "Do you enjoy traveling?",
                "Do you enjoy big groups?",
                "Do you enjoy spending time in nature?",
                "Do you enjoy hiking in nature?",
                "Do you generally enjoy spending lots of time with people?",
                "Do you like animals?",
                "Do you enjoy meuseums?",
                "Do you like authentic foreign foods?");
                $i = 0; // $i is used to provide each question with a unique name
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
                document.getElementById("survey").submit();
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