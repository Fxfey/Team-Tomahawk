<?php
/*
* Template Name: Join Template
*/

get_header();

// $_POST = json_decode(file_get_contents("php://input"), true);

?>

<!-- Obtain Home style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/join.css' ?>">

<div class="container">

    <?php 
        
        if(!empty($_POST)){

            $submission_array = $_POST;

            $submission_keys = array_keys($submission_array);

            $whitelist = ['discord-name', 'age', 'airsoft-playtime', 'airsoft-local', 'location'];

            $data_list;

            $logic_decision = 0;

            foreach($submission_keys as $current_submission_value){

                // If submission doesn't match array, render form again
                if(!in_array($current_submission_value, $whitelist)){

                    $logic_decision++;

                }

                $data_list[$current_submission_value] = [$submission_array[$current_submission_value]];

            }

            if($logic_decision === 0){

                include('../email_address.php');

                if($data_list['location'][0] === "0"){
                    
                    $location = "No";
                    
                } else {

                    $location = "Yes";

                }

                $email_body_string = "Discord Name: ". $data_list['discord-name'][0] . "\n\nPerson Age: ". $data_list['age'][0] . "\n\nAirsoft Playtime: ". $data_list['airsoft-playtime'][0] . " Year(s)\n\nLocal Site: ". $data_list['airsoft-local'][0]. "\n\nUK Resident: ". $location;

                wp_mail($email_address, "New Submission: ".$data_list['discord-name'][0], $email_body_string);

                echo '
                <div class="success-message">
                    <p><i class="fas fa-check-circle"></i> Submission successful!</p>
                </div>
                <a href="/" class="success-button" >Return!</a>
                </div>
                ';

                get_footer();

                die();

            }

        }

    ?>

    <h1 class="overall_title">Join Us!</h1>
    <h4 class="overall_sub_title">want to play with us? fill out the form below!</h4>

    <div class="form-container">
        <form action="/join" method="post" class="form">
            <input required class="form-item" type="text" name="discord-name" placeholder="Discord Username">
            <input required class="form-item" type="text" name="age" placeholder="Your Age">
            <input required class="form-item" type="number" name="airsoft-playtime" placeholder="Years of airsoft played">
            <input required class="form-item" type="text" name="airsoft-local" placeholder="Your local site">
            <div class="check-container">
                <label for="location">Are you UK based?</label>
                <input type="hidden" name="location" value="0">
                <input class="form-check form-item" type="checkbox" name="location">
                <input type="checkbox" name="grant-admin" style="display:none">
            </div>
            <div class="submit-container">
                <button class="form-button" type="submit">Submit</button>
            </div>
        </form>
    </div>



</div>

<?php get_footer(); ?>