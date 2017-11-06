<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php 


            $users = User::find_all();

            foreach($users as $user) {
                echo $user->username . "<br>";
            }

            $user2 = Photo::find_by_id(2);
            echo $user2->filename;

            // echo "hello";
            // $found_user = User::find_user_by_id(1);

            // echo $found_user->username;

            // $user = new User();

            // $user->username = "Another User";
            // $user->password = "maadsfasdfadsf";
            // $user->first_name = "Christopher";
            // $user->last_name = "Banks";

            // print_r($user);

            // $user->save();

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

           

            // $photo = new Photo();
            // $photo->title = "Second Photo";
            // $photo->description = "lorem isuasdfasdf";
            // $photo->filename = "second-photo.png";
            // $photo->type = "png";
            // $photo->size = "4352";

            // $photo->save();
            
            //  $photos = Photo::find_all();

            // foreach ($photos as $photo) {
            //     echo $photo->filename . "<hr>";
            // }

            

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