const calculateScore = (userId, result) =>{
    // Answers have not been saved to the database yet

    // Where result is a map of questions and answers
    result = {"Do you own a watch?":"on"};

    // Pull user data
    userScore = {financial: "0.87"}; // TODO figure out how to store user scores in a dictionary

    // For each answer, update the score
    result.forEach(answer => {
        let updates = {};
        switch(answer.questionID){
            case "Do you own a watch?":
                if(result == "on") {
                    updates.add("financial: 0.3");
                }
                break;
        }

        // For each update, merge the scores
        updates.forEach(update => {
            userScore.forEach(score => {
                if (update.name == score.name){
                    merge(update, score);
                }
            });
        });
        
    });

    // At this point, the user score has been updated. Now save the scores and the questions

    questions.save;
    score.save;

    // At the end, make sure each score fits between 0 and 1

}