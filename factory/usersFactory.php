<?php
  
  include_once "usersInterface.php";
  include "usersClass.php";

  class usersFactory {
    public function createUser($row, $data) {
      $user = $row['AccID'];
      $name = $row['Name'];
      $userType = $row['AccType'];
      $emailAddr = $row['Email'];

      if ($row['AccType'] == 0) {
        $userObject = new admin($user, $name, $userType, $emailAddr);
      }

      else if ($row['AccType'] == 1) {
        $userObject = new professors($user, $name, $userType, $emailAddr);
      }

      # Student Object
      else if ($row['AccType'] == 2) {
        $userObject = new students($user, $name, $userType, $emailAddr, $data);
      }
      
      return $userObject;
    }
  }

?>
