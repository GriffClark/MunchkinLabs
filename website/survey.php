<?php
include_once 'header.php';
?>

</div>
    <div class="col" style="margin-top: 2rem;">
    <div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3> Survey </h3>
			</div>
			<div class="card-body">
                <form action="survey.inc.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="question1" placeholder="Question 1">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" name="question2" placeholder="Question 2">


                    </div>
                    <div class="form-group">
						<input type="submit" name="submit" class="btn float-right login_btn">
					</div>
                </form>
            </div>
		</div>
	</div>
    </div>
  </div>
</div>

<?php
include_once 'footer.php';
?>