<!-- Include the navbar -->
<?php include 'onavbar.php';



require 'classes/Poll.php';
$poll = new Poll();
$listRecord = $poll->getRecords();

$lists = $poll->listPolls();
//upd/ate poll
// $id = $_POST['title'];
  

if (isset($_POST['poll_id'])) {

    

            $cerated = $poll->updatePolls($_POST, $_POST['poll_id'], $_SESSION['username']);
            if ($cerated) {
                header("Location:surveypoll.php");
            } else {
                echo "try again";
            }

        

}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polls and Survey - MyCityHub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Modern Centered Search Bar */
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
            width: 100%;
            max-width: 500px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 0.5rem;
            font-size: 1rem;
            background: transparent;
        }

        .search-bar button {
            border: none;
            background: transparent;
            cursor: pointer;
            color: #0d6efd;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .search-bar button:hover {
            color: #0b5ed7;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .poll-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem 3rem;
        }

        .poll-card {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .poll-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .poll-card img {
            width: 150px;
            height: 200px;
            /* Fixed 3:4 ratio */
            border-radius: 10px;
            object-fit: cover;
            margin-right: 1.5rem;
        }

        .poll-content {
            flex: 1;
        }

        .poll-question {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #0d6efd;
        }

        .poll-description {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .poll-options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .poll-options .form-check {
            margin-bottom: 0;
        }

        .poll-options .form-check-input {
            background-color: #f8f9fa;
            border: 2px solid #ddd;
        }

        .poll-options .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .poll-options .form-check-label {
            color: #333;
            font-weight: 500;
        }

        .poll-submit-btn {
            width: 100%;
            margin-top: 1rem;
            background: #87CEEB;
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .poll-submit-btn:hover {
            background: #6ca6cd;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .result-toggle-btn {
            margin-top: 1rem;
            width: 100%;
            background: #f8f9fa;
            border: 2px solid #87CEEB;
            color: #87CEEB;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .result-toggle-btn:hover {
            background: #87CEEB;
            color: #fff;
        }

        .poll-result {
            margin-top: 2rem;
            display: none;
            /* Hidden by default */
        }

        .poll-result .progress {
            height: 1.5rem;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .poll-result .progress-bar {
            background: linear-gradient(135deg, #87CEEB, #6ca6cd);
            border-radius: 10px;
        }

        .comment-box {
            margin-top: 1.5rem;
        }

        .comment-box textarea {
            width: 100%;
            padding: 0.75rem;
            border-radius: 10px;
            border: 2px solid #ddd;
            font-family: inherit;
            font-size: 1rem;
            resize: vertical;
            transition: border-color 0.3s ease;
        }

        .comment-box textarea:focus {
            border-color: #87CEEB;
            outline: none;
        }

        .results-container {
            display: flex;
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .results-container .poll-results {
            flex: 1;
        }

        .results-container .comments-section {
            flex: 1;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid #ddd;
            max-height: 300px;
            /* Fixed height for scrollbar */
            overflow-y: auto;
            /* Add scrollbar */
        }

        .comments-section h5 {
            margin-bottom: 1rem;
            color: #0d6efd;
        }

        .comments-section p {
            font-size: 0.9rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .results-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- Eco Tracker Content -->
    <div class="eco-container">
        <!-- Modern Centered Search Bar -->
        <div class="search-container">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search for waste schedules, eco tips, or notices...">
                <button onclick="searchContent()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <div class="poll-container">
            <p class="text-center text-muted">Share your opinion about ground-level problems in your area.</p>

            <!-- Poll 1: Waste Management -->
            <?php
            $i = 1;
            foreach ($lists as $listPoll) {
                $totalcomments = $poll->getTotalComments($listPoll['id']);
                $totalvotes = $poll->getTotalVotes($listPoll['id']);
                ?>
                <form action="" method="post">
                    <input type="hidden" name="poll_id" value="<?php echo $listPoll['id']?>" />
                    <div class="poll-card">
                        <img src="./admin/image/<?php echo $listPoll['image']; ?>" alt="Waste Management">
                        <div class="poll-content">
                            <div class="poll-question">
                                <?php echo $i; ?>. <?php echo $listPoll['title']; ?>
                            </div>
                            <div class="poll-description">
                                <?php echo $listPoll['description']; ?>
                            </div>
                            <div class="poll-options">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poll1" id="poll1-option1"
                                        value="Very Satisfied">
                                    <label class="form-check-label" for="poll1-option1">Very Satisfied</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poll1" id="poll1-option2"
                                        value="Satisfied">
                                    <label class="form-check-label" for="poll1-option2">Satisfied</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poll1" id="poll1-option3"
                                        value="Neutral">
                                    <label class="form-check-label" for="poll1-option3">Neutral</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poll1" id="poll1-option4"
                                        value="Dissatisfied">
                                    <label class="form-check-label" for="poll1-option4">Dissatisfied</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poll1" id="poll1-option5"
                                        value="Very Dissatisfied">
                                    <label class="form-check-label" for="poll1-option5">Very Dissatisfied</label>
                                </div>
                            </div>

                            <!-- Comment Box -->
                            <div class="comment-box">
                                <textarea id="poll1Comment" placeholder="Add your comments (optional)" rows="3" name="comment"></textarea>
                            </div>

                            <button type="submit" class="btn poll-submit-btn"
                                >Submit</button>
                                </div>
                    </div>
                    
                </form>
                <!-- Toggle Button for Results -->
                <button class="btn result-toggle-btn" onclick="toggleResults('poll1Result')">Show Results</button>

                <!-- Poll Results (Hidden by Default) -->
                <div class="poll-result" id="poll1Result">
                    <div class="results-container">
                        <!-- Poll Results -->
                        <div class="poll-results">
                            <h5 class="text-center mb-3">Poll Results</h5>
                            <div id="poll1ResultsDisplay">
                                <div>
                                    <span>Very Satisfied</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 40%;">40%</div>
                                    </div>
                                </div>
                                <div>
                                    <span>Satisfied</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 30%;">30%</div>
                                    </div>
                                </div>
                                <div>
                                    <span>Neutral</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 15%;">15%</div>
                                    </div>
                                </div>
                                <div>
                                    <span>Dissatisfied</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%;">10%</div>
                                    </div>
                                </div>
                                <div>
                                    <span>Very Dissatisfied</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 5%;">5%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <h5>Comments</h5>
                            <div id="poll1CommentsDisplay">
                                <p><strong>User1:</strong> The waste collection is very efficient in my area.</p>
                                <p><strong>User2:</strong> Needs improvement in scheduling.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++;
            } ?>
    <!-- Repeat for Poll 2 and Poll 3 -->
    </div>

    <!-- JavaScript for Toggle and Submit Functionality -->
    <script>
        function toggleResults(resultId) {
            const resultSection = document.getElementById(resultId);
            if (resultSection.style.display === "none" || resultSection.style.display === "") {
                resultSection.style.display = "block";
            } else {
                resultSection.style.display = "none";
            }
        }

        // function submitPoll(pollId, commentId, resultId) {
        //     const selectedOption = document.querySelector(`input[name="poll${pollId}"]:checked`);
        //     const comment = document.getElementById(commentId).value;

        //     if (!selectedOption) {
        //         alert("Please select an option before submitting.");
        //         return;
        //     }

        //     // Simulate submission (replace with actual backend call later)
        //     alert("Poll submitted successfully!");
        //     toggleResults(resultId);
        // }
    </script>

    <footer style="background-color: #17a2b8; color: #fff; text-align: center;
     padding: 15px; font-size: 16px; font-family: 'Segoe UI', Tahoma, Geneva, 
     Verdana, sans-serif; margin: 3rem 3rem 1rem; border-radius: 10px;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        <p style="margin: 0;">Developed by <span style="font-weight: bold; 
    color: #0011ff;">Lovies</span> | &copy;
            2026 | Contact Us: <a href="mailto:bibekmishra@gmail.com"
                style="color: #1048ef; text-decoration: none; font-weight: bold;">@gmail.com</a> | Phone:
            <a href="tel:9708077117" style="color: #fff; text-decoration: none; font-weight: bold;">9708077117
                (bibek)</a>
        </p>
    </footer>

</body>

</html>