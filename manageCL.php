<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>

  <body class="bg-dark">
      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between pt-3 pb-3">
            <h5>Manage Class List</h5>
          </div>
          
          <!-- content -->
          <h4> ICT2101/2201 INTRODUCTION TO SOFTWARE ENGINEERING
        <button class="btn btn-info float-right ml-2" data-toggle="modal" data-target="#myModal-fb" >Formative Feedback </button>
        <button class="btn btn-success float-right" data-toggle="modal" data-target="#myModal" >upload Class List</button>
      </h4>
      <form class="form-inline mr-auto mb-4">
        <div class="dropdown">
          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Class 1
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">class 2</a></li>
            <li class="divider"></li>
            <li ><a href="#">class 2</a></li>
            <li class="divider"></li>
            <li ><a href="#">class 3</a></li>
            <li class="divider"></li>
            <li><a href="#">class 4</a></li>
          </ul>
        </div>
        <input class="form-control mr-sm-2 ml-2" type="text" placeholder="Search" aria-label="Search" align="center"/>
        <button class="btn btn-outline-success btn-rounded" type="submit">Search</button>
      </form>
      <table class="table table-striped table-hover"" id="mytable">
        <thead>
          <tr>
            <th>
              <input type="checkbox" id="selectall" onClick="selectAll(this)" />
              <ul>
            </th>
            <th>Email</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" name="student[]"/></td>
            <td>1902XXX@sit.singaporetech.sg</td>
            <td>Tom</td>
            <td>70 
              <a href="#"><i class="fa fa-pencil"></i></a>
            </td>
            <td>
              <button class="btn btn-info float-left" data-toggle="modal" data-target="#myModal-sm" >Summative Feedback </button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="student[]"/></td>
            <td>1902XXX@sit.singaporetech.sg</td>
            <td>mary</td>
            <td>70 
              <a href="#"><i class="fa fa-pencil"></i></a>
            </td>
            <td>
              <button class="btn btn-info float-left" data-toggle="modal" data-target="#myModal-sm" >Summative Feedback </button>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="student[]"/></td>
            <td>1902XXX@sit.singaporetech.sg</td>
            <td>sam</td>
            <td>70 
              <a href="#"><i class="fa fa-pencil"></i></a>
            </td>
            <td>
              <button class="btn btn-info float-left" data-toggle="modal" data-target="#myModal-sm" >Summative Feedback </button>
            </td>
          </tr>
        </tbody>
      </table>
      <button class="btn btn-danger float-right ml-2" data-toggle="modal" data-target="#myModal-fb" >Delete Selected Student Account </button>
      <button class="btn btn-success float-right ml-2" data-toggle="modal" data-target="#myModal" >Publish Grades To all students</button>
      <button class="btn btn-info float-right" data-toggle="modal" data-target="#myModal" >Send feedback to selected students</button>
    </div>
    <!-- Formative Feedback Form -->
    <div class="modal fade" id="myModal-fb" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Formative feeback</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="/action_page.php">
              <textarea id="formative" name="formative" rows="5" cols="50">
              TEST TEST
              </textarea>
              <br><br>
              <input type="submit" value="Submit">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Summative Feedback Form -->
    <div class="modal fade" id="myModal-sm" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Summative feeback</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="/action_page.php">
              <textarea id="summative" name="summative" rows="5" cols="50">
              Test test
              </textarea>
              <br><br>
              <input type="submit" value="Submit">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
          <!-- end of content -->
          </div>
        </div>
        </div>
      </div>

          </div>
        </div>
      </div>
  </body>
</html>