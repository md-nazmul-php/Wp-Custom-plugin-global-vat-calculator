/**
 *  ============Description =========================
 * Template:          Used to store related JavaScript
 * File Tyle          JavaScript
 * Plugin URI:        https://github.com/md-nazmul-php/global-vat-calculator
 * Followed Standards:https://codex.wordpress.org/WordPress_Coding_Standards
 * @link              https://github.com/md-nazmul-php
 * @since             1.0.0
 * @subpackage        global-vat-calculator/assets/js
 * Author:            Md Nazmul
 /**=================== main Program has been started Here ================== */

     function Vat(){         
      var vat_rate=parseFloat(document.vat_form.vat_r.value);
      var tax_action=document.vat_form.tax_action.value;
      var amount=parseFloat(document.vat_form.amount.value);

      if(tax_action=='add_tax'){
          
        var tax_amount = ( amount*vat_rate)/100;
        var net_price=amount+tax_amount;
        document.getElementById("vat").innerHTML ="Result = "+ net_price.toFixed(2);

      }else if(tax_action=='remove_tax'){
          var tax_amount = ( amount*vat_rate)/100;
        var net_price=amount-tax_amount;
        document.getElementById("vat").innerHTML ="Result = "+ net_price.toFixed(2);
      }


     }
   // for clear all from the form
     function clearvat(elementID){
        document.getElementById(elementID).innerHTML = "";
      }
     
    // function for get vat by change function

    function ChangeVat() {
         var vatRate =document.getElementById("country").value;
         var aa=vatRate.toString();
         document.getElementById("vat_r").value = aa;
        }