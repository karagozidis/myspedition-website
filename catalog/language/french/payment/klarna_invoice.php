<?php
//----------------------------------
// Opencart France				  //
// http://www.opencart-france.fr  //
// Traduit par LeorLindel		  //
// Propriété de Leorlindel		  //
//----------------------------------

// Text
$_['text_title']			= 'Klarna facture ';
$_['text_fee']				= 'Facturation Klarna - Pay within 14 days <span id="klarna_invoice_toc_link"></span> (+%s)<script text="javascript\">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\', charge: %s});})</script>';
$_['text_no_fee']			= 'Facturation Klarna - Pay within 14 days <span id="klarna_invoice_toc_link"></span><script text="javascript">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\'});})</script>';
$_['text_additional']		= 'Klarna requiert des informations suppl&eacute;mentaires avant de pouvoir proc&eacute;der &agrave; votre commande.';
$_['text_wait']				= 'Veuillez patienter !';
$_['text_male']				= 'Homme';
$_['text_female']			= 'Femme';
$_['text_year']				= 'Ann&eacute;e';
$_['text_month']			= 'Mois';
$_['text_day']				= 'Jour';
$_['text_comment']			= 'ID de facturation Klarna: %s\n%s/%s: %.4f';

// Entry
$_['entry_gender']			= 'Genre :';
$_['entry_pno']				= 'Date de naissance :<span class="help">(07071960)</span>';
$_['entry_dob']				= 'Date de naissance :';
$_['entry_phone_no']		= 'N&deg; de t&eacute;l&eacute;phone :<br /><span class="help">Veuillez entrer votre num&eacute;ro de t&eacute;l&eacute;phone.</span>';
$_['entry_street']			= 'Rue :<br /><span class="help">Notez que la livraison ne peut s&#8217;&eacute;ffectuer qu&#8217;&agrave; l&#8217;adresse enregistr&eacut;e lors d&#8217;un paiement avec Klarna.</span>';
$_['entry_house_no']		= 'N&deg; du domicile :<br /><span class="help">Veuillez entrer le num&eacute;ro de votre domicile.</span>';
$_['entry_house_ext']		= 'Compl&eacute;ment du domicile:<br /><span class="help">Veuillez entrer ici les extensions relatives &agrave; votre domicile. Ex. : Escalier A, B ou C, Rouge, Bleu, etc...</span>';
$_['entry_company']			= 'N° enregistrement société:<br /><span class="help">Veuillez entrer votre numéro d\'enregistrement société</span>';

// Error
$_['error_deu_terms']		= 'You must agree to Klarna\'s privacy policy (Datenschutz)';
$_['error_address_match']	= 'Billing and Shipping addresses must match if you want to use Klarna Invoice';
$_['error_network']			= 'Error occurred while connecting to Klarna. Please try again later.';
?>