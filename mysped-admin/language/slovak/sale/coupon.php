<?php
// Heading  
$_['heading_title']       = 'Poukazy';

// Text
$_['text_success']        = 'Vykonané: Zmenili ste zoznam poukazov!';
$_['text_percent']        = 'Procenta';
$_['text_amount']         = 'Čiastka';

// Column
$_['column_name']         = 'Názov poukazu';
$_['column_code']         = 'Kód';
$_['column_discount']     = 'Sleva';
$_['column_date_start']   = 'Dátum od';
$_['column_date_end']     = 'Dátum do';
$_['column_status']       = 'Stav';
$_['column_order_id']     = 'ID objednávky';
$_['column_customer']     = 'Zákazník';
$_['column_amount']       = 'Častka';
$_['column_date_added']   = 'Dátum pridania';
$_['column_action']       = 'Akcia';

// Entry
$_['entry_name']          = 'Názov poukazu:';
$_['entry_code']          = 'Kód:<br /><span class="help">Kód, ktorý zákazník musí zadat, aby získal zľavu</span>'; // chybelo podstatne jmeno, prosim o doladeni slovosledu, mam v tom bordel
$_['entry_type']          = 'Typ:<br /><span class="help">Percentuálne alebo fixní sleva</span>';
$_['entry_discount']      = 'Sleva:';
$_['entry_logged']        = 'Pre registrované:<br /><span class="help">Poukaz smí použiť iba registrovaný zákazník.</span>';
$_['entry_shipping']      = 'Doprava zdarma:';
$_['entry_total']         = 'Minimálne hodnota nákupu:<br /><span class="help">Minimálne hodnota nákupu, aby mohl byť použitý slevový poukaz.</span>';
$_['entry_category']      = 'Kategórie:<br /><span class="help">Vybrať všechno tovaru dané kategórie.</span>';
$_['entry_product']       = 'Tovar:<br /><span class="help">Vyberte tovaru (i více), na které bude poukaz použitý. Pokiaľ nič nevyberete použije sa na celý košík.</span>';
$_['entry_date_start']    = 'Dátum od:';
$_['entry_date_end']      = 'Dátum do:';
$_['entry_uses_total']    = 'Počet použití poukazu:<br /><span class="help">Maximální počet použití poukazu (pre všechny zákazníky). Ponechte prázné pokiaľ nie je omezeno</span>';
$_['entry_uses_customer'] = 'Počet použití poukazu na zákazníka:<br /><span class="help">Maximální počet použití poukazu (pre jednotlivého zákazníka). Ponechte prázné pokiaľ nie je omezeno</span>';
$_['entry_status']        = 'Stav:';

// Error
$_['error_permission']    = 'Varovanie: Nemáte povolení na zmenu zoznamu poukazov!';
$_['error_exists']        = 'Varovanie: Poukaz s tímto kódem je už použitý!';
$_['error_name']          = 'Názov poukazu musí byť dlhší ako 3 znaky a kretší ako 128 znakov!';
$_['error_code']          = 'Kód musí byť dlhší ako 3 znaky a kratší ako 10 znakov!';
?>