<?php

  class usersFactory {
    public usersFactory() { }

    public static usersInterface createUser(int userType) {
      if (userType == 0) {
        return new usersClass()
      }
    }
  }

?>
