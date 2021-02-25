<?php if ( ! defined( 'WPINC' ) ) { die;}
/**
*  ============Description =========================
* Template:          Used to handle backend admin functions
* File type:          PHP
* Plugin URI:        https://github.com/md-nazmul-php/global-vat-calculator
* Followed Standards:https://codex.wordpress.org/WordPress_Coding_Standards
* @link              https://github.com/md-nazmul-php
* @since             1.0.0
* @subpackage        global-vat-calculator/inc
* Author:            Md Nazmul
/**=================== main Program has been started Here ================== */

if (is_admin()): // Admin Check due to security reason.
global $wpdb;
$table_name = $wpdb->prefix . 'globalvatcalculator';
//=========== Data insert =============


if (isset($_POST['newsubmit'])) {
$countrydata = $_POST['country'];
$country = filter_var($countrydata, FILTER_SANITIZE_STRING );
$vatdata = $_POST['vat'];
$vat = filter_var($vatdata, FILTER_VALIDATE_FLOAT);

global $wpdb;
$table_name = $wpdb->prefix . 'globalvatcalculator';
    $wpdb->get_results("SELECT * FROM $table_name WHERE country = '$countrydata' ");

    $rowcount = $wpdb->num_rows;

  if ($rowcount>0):

// echo '<div class="notice notice-error is-dismissible">'.'<p>This Country already exsist! .</p></div>';
$temerror = '';

$temerror .= 'Data already exsist.';

  
else:

  $gblinsert = $wpdb->query("INSERT INTO $table_name(country, vat) VALUES('$country','$vat')");

endif;

if (isset($gblinsert)){

echo '<div class="notice notice-success is-dismissible">'.'<p>Data sucessfully added.</p></div>';
}
else{

echo '<div class="notice notice-error is-dismissible"> <p>There was an Error.  <b>'; echo  $temerror; echo '</b></p></div>';

}

}


//=========== Data Update =============
if (isset($_POST['uptsubmit'])) {
$iddata = $_POST['uptid'];
$id = filter_var($iddata, FILTER_VALIDATE_INT);
$countrydata = $_POST['uptcountry'];
$country = filter_var($countrydata, FILTER_SANITIZE_STRING );
$vatdata = $_POST['uptvat'];
$vat = filter_var($vatdata, FILTER_SANITIZE_STRING);
$gblupdate = $wpdb->query("UPDATE $table_name SET country='$country', vat='$vat'WHERE id='$id' ");
if ($gblupdate) :
echo '<div style= "max-width:420px; margin:40px auto;"class="notice notice-warning is-dismissible">'.'<p>Data sucessfully Updated.</p></div>';
endif;
}
//=========== Data Detele =============
if (isset($_GET['del'])) {
$del_iddata = $_GET['del'];
$del_id = filter_var($del_iddata, FILTER_VALIDATE_INT);
$gbldelete = $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");
if ($gbldelete) :
echo '<div style= "max-width:420px; margin:40px auto;"class="notice notice-warning is-dismissible">'.'<p>Data sucessfully Deleted.</p></div>';
endif;
}?>
<!-- =========== Data Form & Table start ============= -->
<div class="wrap" style="max-width:60%; margin:10px auto;"><br><hr>
  <h3 style="text-align: center;">Welcome to Global Vat Calculator </h3><br>
  <p style="text-align: center;"> Please Use shortcode <b>[global-vat-calculator]</b> anywhere in your page or posts to display the calculator. <br> Insert country name and its vat rate value, VAT rate field allow any Float oe Integer number </p><br>
  <table class="wp-list-table widefat striped" style="text-align: left;">
    <thead>
      <tr>
        <th width="40%">Country Name</th>
        <th width="40%">VAT Rate</th>
        <th width="20%">Actions</th>
      </tr>
    </thead>
    <tbody>
      <form action="" method="post">
        <tr>
          
          <td><input type="text" id="country" name="country" onkeydown="lowerCaseF(this)"  placeholder="UNITED KINGDOM"></td>
          
          <td><input type="number" id="insertfield" step=any name="vat" placeholder="1.43"></td>
          <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
        </tr>
      </form>
      <?php
      $result = $wpdb->get_results("SELECT * FROM $table_name");
      foreach ($result as $print) {
      echo "
      <tr>
        <td width='40%'>$print->country</td>
        <td width='40%'>$print->vat</td>
        <td width='20%'>
          <a href='admin.php?page=global-vat-calculator%2Fglobal-vat-calculator.php&upt=$print->id'><button type='button'>Edit </button></a>
          <a href='admin.php?page=global-vat-calculator%2Fglobal-vat-calculator.php&del=$print->id'><button type='button'>Delete</button></a></td>
        </tr>
        ";
        }
      echo '</tbody>
    </table>
    <br>';?>
    
    <?php
    if (isset($_GET['upt'])) {
    $upt_iddata = $_GET['upt'];
    $upt_id = filter_var($upt_iddata, FILTER_VALIDATE_INT);
    $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
    foreach($result as $print) {
    
    $currencyname = $print->country;
    $action = $print->vat;
    }
    //=========== Data update Form Section =============
    echo "
    <table class='wp-list-table widefat striped' style='margin:10px auto;'>
      <thead>
        
      </thead>
      <tbody>
        <form action='admin.php?page=global-vat-calculator%2Fglobal-vat-calculator.php' method='post'>
          <tr>
            <td style='display:none;' width='33%'>$print->id <input type='hidden' id='uptid' name='uptid' value='$print->id'></td>
            <td width='33%'><input type='text'   id='uptcountry' name='uptcountry' value='$print->country'></td>
            <td width='33%'><input type='number' step=any id='vat' name='uptvat' value='$print->vat'></td>
            <td width='10%'><button id='uptsubmit' name='uptsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=global-vat-calculator%2Fglobal-vat-calculator.php'><button type='button'>CANCEL</button></a></td>
            
          </tr>
        </form>
      </tbody>
    </table>";}
  echo "</div>";
  ?>
  <?php
  endif;