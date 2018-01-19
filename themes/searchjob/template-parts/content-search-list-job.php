<?php
$s = '';
$job_type = '';
$place = '';
if (isset($_GET['s'])) {
    $s = $_GET['s'];
}
if (isset($_GET['jobType'])) {
    $job_type = $_GET['jobType'];
}
if (isset($_GET['place'])) {
    $place = $_GET['place'];
}
$the_post_job = apply_filters('the_post_offer', array(0, 50, $s, $job_type, $place));
?>
<?php echo $the_post_job;?>