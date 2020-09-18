<?php
// Heading
$_['heading_title']           = 'Land';

// Text
$_['text_success']            = 'Erfolgreich: Land erfolgreich geändert!';

// Column
$_['column_name']             = 'Bezeichnung';
$_['column_iso_code_2']       = 'ISO Code (2)';
$_['column_iso_code_3']       = 'ISO Code (3)';
$_['column_action']           = 'Aktion';

// Entry
$_['entry_name']              = 'Bezeichnung:';
$_['entry_iso_code_2']        = 'ISO Code (2):';
$_['entry_iso_code_3']        = 'ISO Code (3):';
$_['entry_address_format']    = 'Adressenformat: <br /><span class="help">Verwendung z.B. bei E-Mails. <br />Jeder Begriff (Datenbankfeldname) muss von einer geschwungenen Klammer begrenzt sein.<br /> Beispiel: {firstname} {lastname}<br /><span class="help">
First Name = {firstname}<br />
Last Name = {lastname}<br />
Company = {company}<br />
Address 1 = {address_1}<br />
Address 2 = {address_2}<br />
City = {city}<br />
Postcode = {postcode}<br />
Zone = {zone}<br />
Zone Code = {zone_code}<br />
Country = {country}</span>';
$_['entry_postcode_required'] = 'Postleitzahl benötigt:';
$_['entry_status']            = 'Status:';

// Error
$_['error_permission']        = 'Warnung: Sie haben keine Berechtigung, um Länder zu ändern!';
$_['error_name']              = 'Die Bezeichnung muss zwischen 3 und 128 Buchstaben lang sein!';
$_['error_default']           = 'Warnung: Dieses Land kann nicht gelöscht werden da es aktuell als Standard definiert ist!';
$_['error_store']             = 'Warnung: Dieses Land kann nicht gelöscht werden da es aktuell %s Shops zugeordnet ist!';
$_['error_address']           = 'Warnung: Dieses Land kann nicht gelöscht werden weil noch %s Adressbucheinträge zugeordnet sind!';
$_['error_affiliate']         = 'Warnung: Dieses Land kann nicht gelöscht werden, da es %s Partnern zugeordnet ist!';
$_['error_zone']              = 'Warnung: Diesem Land sind noch %s Zonen zugeordnet. Es kann daher nicht gelöscht werden!';
$_['error_zone_to_geo_zone']  = 'Warnung: Dieses Land kann nicht gelöscht werden, da es %s Geo-Zonen zugeordnet ist!';
?>
