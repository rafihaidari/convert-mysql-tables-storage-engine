<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <title>Convert DB Storage Engine</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-10">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-dbConfig" data-mdb-toggle="pill" href="#pills-dbConfig" role="tab" aria-controls="pills-dbConfig" aria-selected="true">DB Configuration</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-convert" data-mdb-toggle="pill" href="#pills-convert" role="tab" aria-controls="pills-convert" aria-selected="false">Convert Storage Engine</a>
                </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-dbConfig" role="tabpanel" aria-labelledby="tab-dbConfig">
                    <div class="row">
                        <div class="col-6">
                            <form method="post" autocomplete="off" id="check_form">
                                <div class="text-center mb-3">
                                    <a href="https://haidari.co" class="btn btn-primary btn-floating mx-1">
                                        <i class="fas fa-globe-asia"></i>
                                    </a>

                                    <a href="https://www.linkedin.com/in/rafi-haidari/" class="btn btn-primary btn-floating mx-1">
                                        <i class="fab fa-linkedin"></i>
                                    </a>

                                    <a href="https://github.com/rafihaidari" class="btn btn-primary btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>
                                <!-- Database input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="dbName" class="form-control" name="dbName" autocomplete="off" />
                                    <label class="form-label" for="dbName">Database Name</label>
                                </div>

                                <!-- User input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="dbUser" name="dbUser" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="dbUser">User</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="dbPassword" name="dbPassword" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="dbPassword">Password</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" id="checkConnBtn" class="btn btn-primary btn-block mb-4">Test Connection
                                    <span class="spinner-border spinner-border-sm" role="status" id="loading" aria-hidden="true" style="display: none;"></span> </button>
                            </form>
                        </div>

                        <div class="col-6">
                            <div id="errorBox">
                            </div>
                            <div class="scrollit" style="display: none;" id="tableBlock">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Table</th>
                                            <th scope="col">Engine</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTablesBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-convert" role="tabpanel" aria-labelledby="tab-convert">
                    <div class="row">
                        <div class="col-6">
                            <form id="convertForm">
                                <div class="text-center mb-3">
                                    <a href="https://haidari.co" class="btn btn-primary btn-floating mx-1">
                                        <i class="fas fa-globe-asia"></i>
                                    </a>

                                    <a href="https://www.linkedin.com/in/rafi-haidari/" class="btn btn-primary btn-floating mx-1">
                                        <i class="fab fa-linkedin"></i>
                                    </a>

                                    <a href="https://github.com/rafihaidari" class="btn btn-primary btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>

                                <!-- From dropdown -->
                                <div class="mb-4 drpdown">
                                    <label class="myLabel" for="from">From</label>
                                    <select class="form-control" id="from" name="from">
                                        <option value="MyISAM">MyISAM</option>
                                        <option value="InnoDB">InnoDB</option>
                                    </select>
                                </div>

                                <!-- to dropdown -->
                                <div class="mb-4 drpdown">
                                    <label class="myLabel" for="to">To</label>
                                    <select class="form-control" id="to" name="to">
                                        <option value="MyISAM">MyISAM</option>
                                        <option value="InnoDB">InnoDB</option>
                                    </select>
                                </div>

                                <!-- Submit button -->
                                <button type="button" id="convertBtn" class="btn btn-primary btn-block mb-3">Convert <span class="spinner-border spinner-border-sm" role="status" id="convertLoading" aria-hidden="true" style="display: none;"></span></button>
                            </form>
                        </div>
                        <div class="col-6">
                            <div class="alert alert-info alert-dismissible fade show" id="diffStroage" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Uh oh!</strong> Choose different storage engine for convert!
                            </div>
                            <div class="scrollit" style="display:none;height: 315px;" id="convertedTables">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Table</th>
                                            <th scope="col">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody id="convertedTablesBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pills content -->
                <script src="assets/js/custom.js"></script>
                <script src="assets/js/mdb.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            </div>
        </div>
</body>

</html>