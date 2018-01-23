<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('features') ?></h1>
    </div>
</div>
<div class="container" id="features-importers">
    <h1><?= lang('universal_xml') ?></h1>
    <p><?= lang('example_of_xml_import_file') ?></p>
    <?php
    echo '<pre>' . htmlspecialchars('<?xml version="1.0" encoding="UTF-8"?>
<invoices>            
    <invoice>
        <type>invoice</type> <!-- invoice/pro-forma/debit-note/credit-note -->
        <status>issued</status> <!-- issued/sended/draft -->
        <number>0000000011</number>
        <currency>EUR</currency>
        <created>1497906000</created> <!-- timestamp format -->
        <tax_event_date>1497906000</tax_event_date> <!-- timestamp format -->
        <cash_accounting>0</cash_accounting> <!-- 1/0 -->
        <have_maturity_date>0</have_maturity_date> <!-- 1/0 -->
        <maturity_date>1497906000</maturity_date> <!-- timestamp format -->
        <remarks>Additional information</remarks>
        <payment_method>Credit or Debit Card</payment_method>
        <payment_status>unpaid</payment_status> <!-- unpaid/paid/partly_paid -->
        <to_inv_number></to_inv_number>
        <to_inv_date>1497906000</to_inv_date> <!-- timestamp format -->
        <invoice_amount>27.30</invoice_amount>
        <discount>0.00</discount>
        <discount_type>EUR</discount_type>
        <tax_base>27.30</tax_base>
        <vat_percent>20</vat_percent>
        <vat_sum>5.46</vat_sum>
        <no_vat>0</no_vat> <!-- 1/0 -->
        <no_vat_reason></no_vat_reason>
        <final_total>32.76</final_total>
        <composed></composed>
        <schiffer></schiffer>
        <inv_lang></inv_lang> <!-- 1 for English(default), Ids of your languages are available in user/new/invoice - dropdown languages -->
        <client>
            <name>UFCLIGUE</name>
            <is_person>0</is_person> <!-- 1/0 -->
            <bulstat>328328382</bulstat> 
            <is_client_vat_registered>0</is_client_vat_registered>  <!-- 1/0 -->
            <vat_number></vat_number> 
            <client_ident_num></client_ident_num>
            <client_address>Bishops Way</client_address>
            <client_city>London</client_city>
            <client_country>England</client_country>
            <accountable_person>Fabrice Bellard</accountable_person>
            <recipient_name>Fabrice Bellard</recipient_name>
        </client>
        <items>
            <item>
                <name>Bananna</name>
                <quantity>2</quantity>
                <quantity_type>kilogram</quantity_type>
                <single_price>2</single_price>
                <total_price>20.00</total_price>
                <position>1</position>
            </item>
        </items>
    </invoice>
</invoices>
') . '</pre>';
    ?>
</div>