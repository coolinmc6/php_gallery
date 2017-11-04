<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php 

            // $result_set = User::find_all_users();
            
            // while($row = mysqli_fetch_array($result_set)) {

            //     echo $row['username'] . "<br>";
            // } 

            // $found_user = User::find_user_by_id(2);

            // $user = User::instantiation($found_user);

            // echo $user->username;

            // $users = User::find_all_users();

            // foreach($users as $user) {
            //     echo $user->username . "<br>";
            // }

            // $found_user = User::find_user_by_id(1);

            // echo $found_user->username;

            $user = new User();

            $user->username = "StNew Users 6";
            $user->password = "learningissweet";
            $user->first_name = "Bob";
            $user->last_name = "Duff";

            $user->create();

            // $user = User::find_user_by_id(4);
            // $user->last_name = "SmithField";
            // $user->first_name = "Mister";
            // $user->password = "password";
            // $user->username = "updateUser45557";

            // $user->update();

            // $user = User::find_by_id(4);
            // print_r($user);

            // $users = USER::find_all();
            // print_r($users);

            // $user = User::find_user_by_id(4);
            // $user->last_name = "LastName";
            // $user->save();

            // $user = new User();
            // $user->username = "MyNewUser57";
            // $user->save();



             ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>