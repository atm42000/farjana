<?php
$bodyid = "clients";
include "../includes/header.php";
require_once("../includes/common.php");

if (isset($_POST['create'])) {
    // CREATE RECORD.

    // Check for blank field.
    $client = trim($_POST['client']);
    if (empty($client)) { ?>
        <br>
        <button class="btn btn-danger" type="button"><strong>Warning!</strong> You must enter a client.</button>
        <br><br>
        <a class="btn btn-default" href="clients.php?create" input type="button">Back</a>
        <?php exit;
    }

    print $query = "INSERT INTO clients (modified, client, address, city, state, zip, phone, web, employeeID, notes) VALUES (now(), '$_POST[client]', '$_POST[address]', '$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[phone]', '$_POST[web]', '$_POST[employeeID]', '$_POST[notes]')";exit;
    $result = mysqli_query($connection, $query);
    confirm_query($result);
}

if (isset($_POST['update'])) {
    // UPDATE RECORD.
    $query = "UPDATE clients SET modified=now(), client='$_POST[client]', address='$_POST[address]', city='$_POST[city]', state='$_POST[state]', zip='$_POST[zip]', phone='$_POST[phone]', web='$_POST[web]', employeeID='$_POST[employeeID]', notes='$_POST[notes]' WHERE clientID=".intval($_POST['update']);
    $result = mysqli_query($connection, $query);
    confirm_query($result);
}

if (isset($_GET['delete'])) {
    // DELETE RECORD.
    $query = "DELETE FROM clients WHERE clientID=".intval($_GET['delete']);
    $result = mysqli_query($connection, $query);
    confirm_query($result);
}

if (isset($_GET['create'])) {
    ?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Create Client</h3>
            </div>
        <div class="panel-body">

            <form class="form-horizontal" action="clients.php" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Client</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="client" placeholder="Client">
                    </div>
                </div>

                <?php
                    $query = "SELECT * FROM employees WHERE accountmgr='Yes' ORDER BY employee ASC";
                    $result = mysqli_query($connection, $query);
                    confirm_query($result);
                ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="address" placeholder="Address" rows="2"></textarea>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 control-label">City, State, Zip</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="city" placeholder="City">
                    </div>

                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="state" placeholder="State">
                    </div>

                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="zip" placeholder="Zip">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Web</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="web" placeholder="Web">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Account Mgr</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="employeeID">
                            <option value=""></option>
                            <?php
                                while($c = mysqli_fetch_assoc($result)) {
                                    echo '<option value = "'.$c['employeeID'].'">'.$c['employee'].'</option>';
                                }

                                // Release returned data.
                                mysqli_free_result($result);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="notes" placeholder="Notes" rows="6"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit" name="create">Create</button>
                    <a class="btn btn-default" href="clients.php">Back</a>
                </div>
            </form>
        </div>
        </div>
    </div>
    <?php
}


elseif (isset($_GET['read'])) {
    // READ RECORD.
    $query = "SELECT * FROM clients WHERE clientID=".intval($_GET['read']);
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM employees WHERE employeeID=".intval($row['employeeID']);
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $c = mysqli_fetch_assoc($result);
    
    // Find number of records.
    $query2 = "SELECT * FROM clients";
    $result2 = mysqli_query($connection, $query2);
    confirm_query($result2);
    $limit = mysqli_num_rows($result2);

    // Free result set.
    mysqli_free_result($result2);

    // Get the page number or set it to 1 if no page is set.
    $read = isset($_GET['read']) ? (int)$_GET['read'] : 1;
    ?>

    <ul class="pager">
        <?php if ($read > 1): ?>
            <li class="previous"><a href="?read=<?= ($read - 1)?>">Previous</a></li>
        <?php endif ?>
        <?php if ($read < $limit): ?>
            <li class="previous"><a href="?read=<?= ($read + 1)?>">Next</a></li>
        <?php endif ?>
    </ul>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Read Client</h3>
            </div>
            <div class="panel-body">

            <form class="form-horizontal" action="clients.php" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Client</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="client" value="<?php echo $row['client'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="address" rows="2" readonly><?php echo $row['address'] ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 control-label">City, State, Zip</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="city" value="<?php echo $row['city'] ?>" readonly>
                    </div>

                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="state" value="<?php echo $row['state'] ?>" readonly>
                    </div>

                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="zip" value="<?php echo $row['zip'] ?>" readonly>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Web</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="web" value="<?php echo $row['web'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Account Mgr</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="employeeID" value="<?php echo $c['employee'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="notes" rows="6" readonly><?php echo $row['notes'] ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a class="btn btn-default" href="clients.php">Back</a>
                </div>
            </form>
            </div>
        </div>
    </div>
    <?php
}


elseif (isset($_GET['update'])) {
    // UPDATE RECORD.
    $query = "SELECT * FROM clients WHERE clientID=".intval($_GET['update']);
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Update Client</h3>
            </div>
            <div class="panel-body">

            <form class="form-horizontal" action="clients.php" method="post">
                <input type="hidden" name="update" value="<?php echo $row['clientID'] ?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Client</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="client" value="<?php echo $row['client'] ?>">
                    </div>
                </div>

                <?php
                    $query = "SELECT * FROM employees WHERE accountmgr='Yes' ORDER BY employee ASC";
                    $result = mysqli_query($connection, $query);
                    confirm_query($result);
                ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="address" rows="2"><?php echo $row['address'] ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 control-label">City, State, Zip</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="city" value="<?php echo $row['city'] ?>">
                    </div>

                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="state" value="<?php echo $row['state'] ?>">
                    </div>

                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="zip" value="<?php echo $row['zip'] ?>">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Web</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="web" value="<?php echo $row['web'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Account Mgr</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="employeeID">
                            <option value=""></option>
                            <?php
                                while($c = mysqli_fetch_assoc($result)) {
                                    echo '<option value = "'.$c["employeeID"].'"'.($row['employeeID'] == $c['employeeID'] ? ' selected' : '').'>'.$c["employee"].'</option>';
                                }

                                // Release returned data.
                                mysqli_free_result($result);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="notes" rows="6"><?php echo $row['notes'] ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-warning" type="submit">Update</button>
                    <a class="btn btn-default" href="clients.php">Back</a>
                </div>
            </form>

            </div>
        </div>
    </div>
    <?php
}


else {
    // DISPLAY LIST OF RECORDS.
    ?>
    <br>
    <a class="btn btn-primary" href="clients.php?create" input type="button">New</a>
    <br>
    <br>

    <?php
        // Perform db query.
        $query = "SELECT * FROM clients ORDER BY client ASC";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
    ?>

    <table style="width: auto;" class="table table-bordered table-condensed table-hover">
        <tr>
            <th style="background-color:#E8E8E8;"></th>
            <th style="background-color:#E8E8E8;"></th>
            <th style="background-color:#E8E8E8; color:#0397B7; font-weight:bold; text-align:center;">Client</th>
            <th style="background-color:#E8E8E8; color:#0397B7; font-weight:bold; text-align:center;">Account Manager</th>
            <th style="background-color:#E8E8E8; color:#0397B7; text-align:center;">Modified</th>
            <th style="background-color:#E8E8E8;"></th>
        </tr>

        <?php
            while($row = mysqli_fetch_assoc($result)) {
                $time = strtotime($row['modified']);
                $myDateFormat = date("m-d-y g:i A", $time);
                $query = "SELECT * FROM employees where employeeID = ".intval($row['employeeID']);
                $finding = mysqli_query($connection, $query);
                confirm_query($finding);
                $finding = mysqli_fetch_assoc($finding);

                echo '
                <tr>
                    <td width="50">'.'<a class="btn btn-primary" href="clients.php?read='.$row['clientID'].'"><span class="glyphicon glyphicon-play"></span></a>'.'</td>
                    <td width="50">'.'<a class="btn btn-warning" href="clients.php?update='.$row['clientID'].'"><span class="glyphicon glyphicon-pencil"></span></a>'.'</td>
                    <td width="300">'.$row["client"].'</td>
                    <td width="200">'.$finding['employee'].'</td>
                    <td width="175">'.$myDateFormat.'</td>
                    <td width="50">'.'<a class="btn btn-danger" href="clients.php?delete='.$row['clientID'].'"
                        onclick="return confirm(\'Are you sure you want to delete this record?\');"><span class="glyphicon glyphicon-trash"></span></a>'.'</td>
                </tr>';
            }

            // Release returned data.
            mysqli_free_result($result);
        ?>

    </table>
    <?php
}
?>

<?php include '../includes/footer.php'; ?>
