<?php
// Text
$_['text_title']          = 'Klarna Invoice';
$_['text_fee']            = 'Klarna Invoice - Πληρωμή εντός 14 ημερών <span id="klarna_invoice_toc_link"></span> (+%s)<script text="javascript\">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\', charge: %s});})</script>';
$_['text_no_fee']         = 'Klarna Invoice - Πληρωμή εντός 14 ημερών <span id="klarna_invoice_toc_link"></span><script text="javascript">$.getScript(\'http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js\', function(){ var terms = new Klarna.Terms.Invoice({ el: \'klarna_invoice_toc_link\', eid: \'%s\', country: \'%s\'});})</script>';
$_['text_additional']     = 'Το Klarna Invoice απαιτεί ορισμένες συμπληρωματικές πληροφορίες για να μπορέσει να επεξεργαστεί την παραγγελία σας.';
$_['text_wait']           = 'Παρακαλώ περιμένετε!';
$_['text_male']           = 'Άνδρας';
$_['text_female']         = 'Γυναίκα';
$_['text_year']           = 'Έτος';
$_['text_month']          = 'Μήνας';
$_['text_day']            = 'Ημέρα';
$_['text_comment']        = 'Κωδικός ID Τιμολογίου Klarna: %s\n%s/%s: %.4f';

// Entry
$_['entry_gender']         = 'Φύλο:';
$_['entry_pno']            = 'Προσωπικός  αριθμός:<br /><span class="help">Παρακαλώ εισάγετε τον αριθμό κοινωνικής σας ασφάλισης.</span>';
$_['entry_dob']            = 'Ημερομηνία γέννησης:';
$_['entry_phone_no']       = 'Τηλέφωνο:<br /><span class="help">Παρακαλώ εισάγετε τον αριθμό τηλεφώνου σας.</span>';
$_['entry_street']         = 'Οδός:<br /><span class="help">Παρακαλώ σημειώστε ότι η παράδοση μπορεί να γίνει μόνο στη καταχωρημένη διεύθυνση όταν πληρώνετε με Klarna.</span>';
$_['entry_house_no']       = 'Αρ. Οικίας:<br /><span class="help">Παρακαλώ εισάγετε τον αριθμό της οικίας σας.</span>';
$_['entry_house_ext']      = 'Επέκταση Οικίας.:<br /><span class="help">Παρακαλώ εισάγετε την επέκταση (extension) της οικίας σας. E.g. A, B, C, Red, Blue ect.</span>';
$_['entry_company']        = 'Αριθμός μητρώου εταιρίας (Company Registration Number):<br /><span class="help">Παρακαλώ εισάγετε τον αριθμό μητρώου της εταιρίας σας </span>';

// Error
$_['error_deu_terms']     = 'Πρέπει να συμφωνήσετε με τη πολιτική προσωπικών δεδομένων της Klarna\'s (Datenschutz)';
$_['error_address_match'] = 'Οι διευθύνσεις αποστολής και χρέωσης πρέπει να ταιριάζουν αν θέλετε να χρησιμοποιήσετε το Klarna Payments';
$_['error_network']       = 'Προέκυψε σφάλμα κατά τη σύνδεση στο Klarna. Παρακαλώ δοκιμάστε ξανά αργότερα.';
?>