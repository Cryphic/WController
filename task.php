<?php
// Init session
session_start();

// Include db config
require_once 'config/database.php';


// Validate login
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: login.php');
    exit;
}

$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();


if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    # Gets action from "tasks" table
    $statement = $pdo->prepare("SELECT action, parameters FROM tasks WHERE id = :tk_id");
    $statement->bindValue(":tk_id", $_GET['delete_id']);
    $statement->execute();
    $results = $statement->fetch();

    $statement = $pdo->prepare("DELETE FROM tasks WHERE id = :tk_id");
    $statement->bindValue(":tk_id", $_GET['delete_id']);
    $statement->execute();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">

        Controller
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">

            <a class="nav-link" href="logout.php">

                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-closed" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2zm1 0v13h8V2H4z"/>
                    <path d="M7 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Sign out</a>

        </li>
    </ul>
</nav>

<div class="container-fluid">

    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">

                    <li class="nav-item">

                        <a class="nav-link" href="index.php">
                            <span data-feather="home"></span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            </svg>
                            Dashboard <span class="sr-only">(current)</span>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="task.php">
                            <span data-feather="file"></span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list-task"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                                <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                                <path fill-rule="evenodd"
                                      d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                            </svg>
                            Tasks
                        </a>


                    </li>


                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Account</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link"  href="#">
                            <span data-feather="file-text"></span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                <path fill-rule="evenodd"
                                      d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                            </svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                <h1 class="h2">Dashboard <small class="text-muted"><?php echo $_SESSION['email']; ?></small></h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <h5> Welcome <span class="badge badge-success"> <?php echo $_SESSION['name']; ?>  </span></h5>


                    </div>

                </div>
            </div>
            <p>Account number: <?php echo $_SESSION['id']; ?></p>
            <div class="card">

                <div class="card-body">

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Task panel</h4>
                        Select command below and enter extra parameters if required.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" class="form-inline" method="post"> <!-- Start of task command form -->

                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Host, Command, Parameters</span>
                        </div>
                        <select class="custom-select" name="hostname">
                            <?php
                            # Determines the hosts that have previously beaconed
                            $statement = $pdo->prepare("SELECT hostname FROM hosts WHERE id = :id");
                            $statement->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
                            $statement->execute();
                            $hosts = $statement->fetchAll();
                            # Populates each <option> drop-down with our hosts that have beaconed previously
                            foreach ($hosts as $row) {
                                echo "<option value=" . "\"" . $row["hostname"] . "\"" . ">" . $row["hostname"] . "</option>";
                            }
                            ?>
                        </select>
                        <select name="cmd" class="custom-select" required>
                            <option value="">Select command</option>
                            <option value="Message">Messagebox</option>
                            <option value="Restart">Restart</option>
                            <option value="Lock">Lock</option>
                        </select>

                        <input type="text" class="form-control" name="parameter" placeholder="Parameter">
                        <p>&nbsp</p>
                        <button type="submit" name="submit" class="btn btn-primary">Send</button>
                </div>

                </form> <!-- End of task command form -->


                <?php
                # If the user clicked "Task Command"
                if (isset($_POST["submit"])) {
                    # If all fields are set
                    # Prevent null entries from being added to the "tasks" table
                    if (isset($_POST["hostname"]) && !empty($_POST["hostname"]) && isset($_POST["cmd"]) && !empty($_POST["cmd"])) {
                        $hostname = $_POST["hostname"]; # Hostname that was selected
                        $command = $_POST["cmd"];   # Command that was entered
                        $parameters = $_POST["parameter"];
                    //    $username = $_SESSION["username"]; # Current logged in user

                        # Inserts user, action, hostname, and secondary into "tasks" table
                        $statement = $pdo->prepare("INSERT INTO tasks (hostname, action, parameters, user_id) VALUES (:hostname, :action, :parameters, :user_id)");
                        $statement->bindValue(":hostname", $hostname);
                        $statement->bindValue(":action", $command);
                        $statement->bindValue(":parameters", $parameters);
                        $statement->bindValue(":user_id", $_SESSION['id']);
                        $statement->execute();

                        $logs = fopen("logs/".$_SESSION['email'].".txt", "a+") or die("Unable to open file!");
                        $txt =  date('l jS \of F Y h:i:s')." ".$hostname." ".$command." ".$parameters." ".$_SESSION['id']."\n";
                        fwrite($logs, $txt);
                        fclose($logs);
                        # Displays success message
                        echo "<br><div class='alert alert-success'>Successfully tasked command. Do not refresh the page.</div>";
                        echo "<script type='text/javascript'> document.location = 'task.php'; </script>";


                    } else {
                        # Displays error message - "Please fill out all fields."
                        echo "<br><div class='alert alert-danger'>Please fill out all fields.</div>";
                    }
                }
                ?>

            </div>
            <br>
            <div class="card">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">
                    <span data-feather="file-text"></span>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
                        <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    View logs
                </a>
                <table class="table table-bordered table-sm" id="tasksTable"> <!-- Start of tasks dataTable -->
                    <thead>
                    <tr>
                        <th>Task ID</th>
                        <th>Hostname</th>
                        <th>Task Action</th>
                        <th>Parameters</th>
                        <th>Output</th>
                        <th>Status</th>
                        <th>Issued by (ID)</th>
                        <th>Delete?</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    # Gets a list of all of tasks
                    # This information will be used to build a HTML table
                    $statement = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :id");
                    $statement->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);

                    $statement->execute();
                    $results = $statement->fetchAll();


                    # Builds HTML table for each host in the "tasks" table
                    foreach ($results as $row) {
                        echo "<tr>"; # Start of HTML table row
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["hostname"] . "</td>";
                        echo "<td>" . $row["action"] . "</td>";
                        echo "<td>" . $row["parameters"] . "</td>";
                        echo "<td>" . $row["output"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                    if($row["status"] == "Done") {
                            echo "<td>" . "<a  type='submit' class='btn btn-danger btn-xs btn-block' href='task.php?delete_id=" . $row["id"] . "'>Delete Task</a></td>";
                        } else {
                        echo "<td>" . "<a  type='submit' class='btn btn-danger btn-xs btn-block disabled' href='task.php?delete_id=" . $row["id"] . "'>Delete Task</a></td>";
                    }
                        echo "</tr>"; # End of HTML table row
                    }
                    ?>
                    </tbody>
                </table> <!-- End of tasks dataTable -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Event logs</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $file = "logs/".$_SESSION["email"].".txt";
                                $orig = file_get_contents($file);
                                $a = htmlentities($orig);

                                echo '<code>';
                                echo '<pre>';

                                echo $a;

                                echo '</pre>';
                                echo '</code>';



                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


    </div>




</div>

</body>>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    body {
        font-size: .875rem;
    }

    .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
    }

    /*
     * Sidebar
     */

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 5rem;
        }
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    }

    @supports ((position: -webkit-sticky) or (position: sticky)) {
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
        }
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #999;
    }

    .sidebar .nav-link.active {
        color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
        color: inherit;
    }

    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
    }

    /*
     * Navbar
     */

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
        top: .25rem;
        right: 1rem;
    }

    .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
    }

    .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }

</style>


</html>




