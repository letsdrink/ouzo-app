<?php

class AddUsers extends Ruckusing_Migration_Base
{
    public function up()
    {
        $users = $this->create_table("users");
        $users->column("login", "string");
        $users->column("password", "string");
        $users->finish();
    }

    //up()

    public function down()
    {
    }
    //down()
}
