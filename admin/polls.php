<?php
/*session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['is_admin'])) {
   header("Location:index.php");
   exit();
}*/

require 'classes/Poll.php';
$poll = new Poll();

$lists = $poll->listPolls();
if (isset($_GET['search'])) {
    $lists = $poll->searchPolls($_GET);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/adminstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polls </title>
    <style>
        main .top {
            display: flex;
            background-color: rgb(222, 236, 231);
            margin-bottom: 1rem;
            justify-content: space-around;

        }

        main .top .search span {
            margin-top: 2px;


        }


        main .top a {
            display: flex;
            margin-left: 2rem;
            gap: 2px;
            align-items: center;
            height: 3.2rem;
            transition: all .1sec ease-in;
            color: rgb(21, 23, 21);
        }

        /* search box */
        .search button {
            width: 40px;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 15px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;

        }

        .search input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            font-size: 16px;
            margin-bottom: 2px;
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

        .poll-content .totalcv {
            display: flex;
            justify-content: space-evenly;
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
            width: auto;
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
    <div class="container">
        <!-- aside section start -->

        <div class="left">
            <?php
            include_once 'includes/sidebar.php'
                ?>

        </div>


        <!-- aside end -->

        <!-- main area start -->
        <main class="main">
            <div class="topsection">
                <div class="leftsection">
                    <h1>Pools</h1>
                    <div class="date">
                        <?php echo date("d/m/y"); ?>
                    </div>
                </div>

            </div>
            <!-- top section end -->
            <!-- content stsrt -->
            <div class="content">

                <div class="top">
                    <!-- search form -->
                    <div class="search">
                        <form action="" method="get">
                            <input type="text" name="search" id="">
                            <button type="submit"><span class="material-symbols-sharp">search </span></button>

                        </form>
                    </div>
                    <div class="buttons">
                        <a href="pollsadd.php">
                            <span class="material-symbols-sharp">add </span>
                            <h3>Add Polls</h3>
                        </a>



                    </div>

                </div>
                <!-- top end -->
                <div class="poll-container">
                    <p class="text-center text-muted">Share your opinion about ground-level problems in your area.</p>

                    <!-- Poll 1: Waste Management -->
                    <?php
                    $i = 1;
                    foreach ($lists as $listPoll) {
                        $totalcomments = $poll->getTotalComments($listPoll['id']);
                        $totalvotes = $poll->getTotalVotes($listPoll['id']);
                        ?>
                        <div class="poll-card">
                            <img src="./images/<?php echo $listPoll['image']; ?>" alt="Waste Management">
                            <div class="poll-content">
                                <div class="poll-question">
                                    <?php echo $i; ?>. <?php echo $listPoll['title']; ?>
                                </div>
                                <div class="poll-description">
                                    <?php echo $listPoll['description']; ?>
                                </div>
                                <div class="totoalcv">
                                    <div class="poll-options">

                                        Total Votes:<?php echo $totalvotes; ?>

                                    </div>

                                    <!-- Comment Box -->
                                    <div class="comment-box">
                                        Toal Comments:<?php echo $totalcomments; ?>
                                    </div>
                                </div>
                                <!-- class totalcv end -->

                                <div class="btneditdelete">
                                    <a href="pollsupdate.php?id=<?php echo $listPoll['id']; ?>">Edit</a> &nbsp;&nbsp;&nbsp;
                                    <a href="pollsdelete.php?id=<?php echo $listPoll['id']; ?>"
                                        onclick="return confirm('Are you sure want to delete this record?');">
                                        Delete</a>
                                </div>


                                <!-- Toggle Button for Results -->
                                <button class="btn result-toggle-btn" onclick="toggleResults('poll1Result')">Show
                                    More</button>

                                <!-- Poll Results (Hidden by Default) -->
                                <div class="poll-result" id="poll1Result">
                                    <div class="results-container">
                                        <!-- Poll Results -->
                                        <div class="poll-results">
                                            <h5 class="text-center mb-3">Poll Results</h5>
                                            <div id="poll1ResultsDisplay">
                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <div class="comments-section">
                                            <h5>Comments</h5>
                                            <div id="poll1CommentsDisplay">
                                                <p><strong>User1:</strong> The waste collection is very efficient in my
                                                    area.</p>
                                                <p><strong>User2:</strong> Needs improvement in scheduling.</p>
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

        </main>



        <!-- main area end -->




    </div>
    <!-- container -->
    <script>
        function toggleResults(resultId) {
            const resultSection = document.getElementById(resultId);
            if (resultSection.style.display === "none" || resultSection.style.display === "") {
                resultSection.style.display = "block";
            } else {
                resultSection.style.display = "none";
            }
        }

        function submitPoll(pollId, commentId, resultId) {
            const selectedOption = document.querySelector(`input[name="poll${pollId}"]:checked`);
            const comment = document.getElementById(commentId).value;

            if (!selectedOption) {
                alert("Please select an option before submitting.");
                return;
            }

            // Simulate submission (replace with actual backend call later)
            alert("Poll submitted successfully!");
            toggleResults(resultId);
        }
    </script>
</body>

</html>