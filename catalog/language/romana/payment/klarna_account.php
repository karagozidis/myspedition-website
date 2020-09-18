<?php
// Text
$_['text_title']           = 'Cont Klarna';
$_['text_pay_month']       = 'Cont Klarna - Plateste de la %s/luna <span id="klarna_account_toc_link"></span><script text="javascript">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Account({ el: \'klarna_account_toc_link\', eid: \'%s\',   country: \'%s\'});})</script>';
$_['text_information']     = 'Informatii cont Klarna';
$_['text_additional']      = 'Contul Klarna necesita unele informatii aditionale pentru a putea procesa comanda.';
$_['text_wait']            = 'Asteapta!';
$_['text_male']            = 'Masculin';
$_['text_female']          = 'Feminin';
$_['text_year']            = 'An';
$_['text_month']           = 'Luna';
$_['text_day']             = 'Zi';
$_['text_payment_option']  = 'Optiuni plata';
$_['text_single_payment']  = 'Plata singulara';
$_['text_monthly_payment'] = '%s - %s pe luna';
$_['text_comment']         = 'ID factura Klarna: %s\n%s/%s: %.4f';

// Entry
$_['entry_gender']         = 'Sexul:';
$_['entry_pno']            = 'CNP:<br /><span class="help">Scrie codul numeric personal in acest camp.</span>';
$_['entry_dob']            = 'Data nasterii:';
$_['entry_phone_no']       = 'Telefon:<br /><span class="help">Scrie numarul de telefon in acest camp.</span>';
$_['entry_street']         = 'Strada:<br /><span class="help">Trebuie sa stii ca livrarea se va face doar la adresa inregistrata cand se plateste cu Klarna.</span>';
$_['entry_house_no']       = 'House No.:<br /><span class="help">Please enter your house number.</span>';
$_['entry_house_ext']      = 'House Ext.:<br /><span class="help">Please submit your house extension here. E.g. A, B, C, Red, Blue ect.</span>';
$_['entry_company']        = 'Company Registration Number:<br /><span class="help">Please enter your Company\'s registration number</span>';

// Error
$_['error_deu_terms']      = 'You must agree to Klarna\'s privacy policy (Datenschutz)';
$_['error_address_match']  = 'Billing and Shipping addresses must match if you want to use Klarna Payments';
$_['error_network']        = 'Error occurred while connecting to Klarna. Please try again later.';
?>
