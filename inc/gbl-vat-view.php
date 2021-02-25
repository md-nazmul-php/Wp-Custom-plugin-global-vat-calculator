<?php if ( ! defined( 'WPINC' ) ) { die;}
/**
*  ============Description =========================
* Template:          Used to handle output and view page
* File type:         PHP
* Plugin URI:        https://github.com/md-nazmul-php/global-vat-calculator
* Followed Standards:https://codex.wordpress.org/WordPress_Coding_Standards
* @link              https://github.com/md-nazmul-php
* @since             1.0.0
* @subpackage        global-vat-calculator/inc
* Author:            Md Nazmul
/**=================== main Program has been started Here ====================== */
function wpb_fx_shortcode() {
global $wpdb;
ob_start();
$table_name = $wpdb->prefix . 'globalvatcalculator';?>
<div class="main-div">
  <form name="vat_form" method="post" action="">
    <table>
      <tr>
        <td style="padding-right:5px;">
          <h6 id="h6-mr"> Select Country</h6>
          <select class='fixed-wide' name='country' id="country" onchange="ChangeVat();">
            <option value="">Select</option>
            <?PHP
            $result = $wpdb->get_results("SELECT * FROM $table_name");
            foreach ($result as $print) {
            echo "<option value='$print->vat'>$print->country </option>";
            }
          echo "</select>.</td>.<td>";?>
          <h6 id="h6-mr"> VAT Rate</h6>
          <input class="fixed-wide" type="text" name="vat_rate" id="vat_r" />
        </td>
      </tr>
    <tr>
<td>
  <h6 id="h6-mr"> Enter Amount</h6>
    <input class="fixed-wide" type="number" name="amount"/>
      </td>
<td>
    <h6 id="h6-mr">Select</h6>
        <select class="fixed-wide" name="tax_action">
          <option value="add_tax">Add TAX</option>
            <option value="remove_tax">Remove Tax</option>
            </select>
                </td>
              </tr>
              <tr>
       <td>
          <button  id="calculate" class="fixed-wide" onclick="Vat();return false;">Calculate</button>
        </td>
        <td>
          <button id="reset" class="fixed-wide" type="reset"  onclick="clearvat('vat')"return false;>Reset</button>
        </td>
      </tr>
      
      <tr>
        <td colspan="2">
          <output class="fixed-wide" id="vat"></output>
        </td>
      </tr>
      
    </table>
    
  </form>
  
</div>
<?php
return ob_get_clean();
}
add_shortcode('global-vat-calculator', 'wpb_fx_shortcode'); ?>