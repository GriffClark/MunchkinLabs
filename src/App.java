import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.Hashtable;
import java.util.Set;

public class App {

    public static class User {
        String id;
        Hashtable<String, String> questionAnswerTable;

        public String getId() {
            return id;
        }

        public void setId(String id) {
            this.id = id;
        }

        public Hashtable<String, String> getQuestionAnswerTable() {
            return questionAnswerTable;
        }

        public void setQuestionAnswerTable(Hashtable<String, String> questionAnswerTable) {
            this.questionAnswerTable = questionAnswerTable;
        }
    }

    public static void main (String[] args) throws Exception{
        ArrayList<String> dirtyUsers = getDirtyUsers();
        ArrayList<User> userUpdateQueue = new ArrayList<>();
        Hashtable<String, String> questionIdTable = getQuestions();

        // For each user, figure out which values need to be updated
        for(String id: dirtyUsers) {
            try{
                User user = new User();
                user.id = id;
                user.questionAnswerTable = (getValuesToUpdate(id));
                userUpdateQueue.add(user);
            } catch (Exception e){
                System.out.println(e);
            }
        }

        // Now that we know which users need to be updated and which questions the users have answered, we can update the scores
        for(User user : userUpdateQueue) {
            Set<String> keys = user.questionAnswerTable.keySet();
            for(String questionId: keys){
                // The question ID is the key

                
                System.out.println(questionId + " " + user.questionAnswerTable.get(questionId));
            }
        }

    }

    public static ArrayList<String> getDirtyUsers() throws Exception {
        try {
            Connection conn = getConnection();

            String sql = "SELECT * FROM dirtyUsers";
            PreparedStatement statement = conn.prepareStatement(sql);
            ResultSet resultSet = statement.executeQuery();

            ArrayList<String> resultIds = new ArrayList<>();

            while(resultSet.next()) {
                System.out.println(resultSet.getString("userId"));
                resultIds.add(resultSet.getString("userId"));
            }

            System.out.println("All records have been selected");
            return resultIds;

        } catch (Exception e){
            System.out.println(e);
        }

        return null;
    }

    public static Hashtable<String, String> getValuesToUpdate(String userId) {
        try {
            Connection conn = getConnection();

            String sql = "SELECT * FROM answers WHERE userId=" + userId;
            PreparedStatement statement = conn.prepareStatement(sql);
            ResultSet resultSet = statement.executeQuery();

            Hashtable<String, String> resultTable = new Hashtable<>();

            while(resultSet.next()){
                String questionId = (resultSet.getString("questionId"));
                String answer = (resultSet.getString("answer"));
                resultTable.put(questionId, answer);
            }
            return resultTable;
            }catch (Exception e){
            System.out.println(e);
        }

        return null;

    }

    public static Hashtable<String, String> getQuestions() {
        try {
            Connection conn = getConnection();

            String sql = "SELECT * FROM questions";
            PreparedStatement statement = conn.prepareStatement(sql);
            ResultSet resultSet = statement.executeQuery();

            Hashtable<String, String> resultTable = new Hashtable<>();

            while(resultSet.next()){
                String questionId = resultSet.getString("id");
                String questionText = resultSet.getString("questionText");
                resultTable.put(questionId, questionText);
            }

            return resultTable;

        }catch (Exception e) {
            System.out.println(e);
        }
        return null;
    }

    public static void deleteDirtyUser(String user) {
        try {
            Connection conn = getConnection();
            String sql = "DELETE FROM dirtyUsers WHERE userId=" + user; // TODO not working
            PreparedStatement statement = conn.prepareStatement(sql);
           ResultSet resultSet =  statement.executeQuery();

        }catch (Exception e){
            System.out.println(e);
        }
    }

    public static Connection getConnection() throws Exception {
        try {
            String driver = "com.mysql.jdbc.Driver";
            String url = "jdbc:mysql://localhost:3306/usersDB"; // Works for localhost

            // Default creds for phpmyadmin
            String username = "root";
            String password = "";

            Class.forName(driver);

            Connection conn = DriverManager.getConnection(url, username, password);
            System.out.println("Successfully connected to " + url + " as " + username);
            return conn;
        } catch (Exception e){
            System.out.println(e);
        }

        return null; // This will only hit if there's an error
    }
}
