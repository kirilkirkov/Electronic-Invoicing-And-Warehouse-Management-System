<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * XmlExport class 
 * For export invoices to xml file
 */

class XmlExport
{

    private $from;
    private $to;
    private $invReadableTypes;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->setInvTypes($this->CI->config->item('inv_readable_types'));
    }

    // wait for invoices array
    public function getXmlFileFromInvoicesArray($invoices)
    {
        $this->getXmlStructure($invoices);
    }

    public function setDates($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    private function setInvTypes($invReadableTypes)
    {
        $this->invReadableTypes = $invReadableTypes;
    }

    private function getXmlStructure($invoices)
    {
        ob_clean();
        $this->getXmlHeaders();



        echo '<?xml version="1.0" encoding="UTF-8"?>
<invoices>';
        foreach ($invoices as $invoice) {
            ?>
            <invoice>
                <type><?= $this->invReadableTypes[$invoice['inv_type']] ?></type>
                <status><?= $invoice['status'] ?></status>
                <number><?= $invoice['inv_number'] ?></number>
                <currency><?= $invoice['inv_currency'] ?></currency>
                <created><?= $invoice['date_create'] ?></created>
                <tax_event_date><?= $invoice['date_tax_event'] ?></tax_event_date>
                <cash_accounting><?= $invoice['cash_accounting'] ?></cash_accounting>
                <have_maturity_date><?= $invoice['have_maturity_date'] ?></have_maturity_date>
                <maturity_date><?= $invoice['maturity_date'] ?></maturity_date>
                <remarks><?= htmlspecialchars($invoice['remarks'], ENT_XML1, 'UTF-8') ?></remarks>
                <payment_method><?= $invoice['payment_method'] ?></payment_method>
                <payment_status><?= $invoice['payment_status'] ?></payment_status>
                <to_inv_number><?= $invoice['to_inv_number'] ?></to_inv_number>
                <to_inv_date><?= $invoice['to_inv_date'] ?></to_inv_date>
                <invoice_amount><?= $invoice['invoice_amount'] ?></invoice_amount>
                <discount><?= $invoice['discount'] ?></discount>
                <discount_type><?= $invoice['discount_type'] ?></discount_type>
                <tax_base><?= $invoice['tax_base'] ?></tax_base>
                <vat_percent><?= $invoice['vat_percent'] ?></vat_percent>
                <vat_sum><?= $invoice['vat_sum'] ?></vat_sum>
                <no_vat><?= $invoice['no_vat'] ?></no_vat>
                <no_vat_reason><?= htmlspecialchars($invoice['no_vat_reason'], ENT_XML1, 'UTF-8') ?></no_vat_reason>
                <final_total><?= $invoice['final_total'] ?></final_total>
                <composed><?= $invoice['composed'] ?></composed>
                <schiffer><?= $invoice['schiffer'] ?></schiffer> 
                <firm>
                    <name><?= $invoice['firm']['name'] ?></name>
                    <bulstat><?= $invoice['firm']['bulstat'] ?></bulstat>
                    <address><?= $invoice['firm']['address'] ?></address>
                    <city><?= $invoice['firm']['city'] ?></city>
                    <accountable_person><?= $invoice['firm']['accountable_person'] ?></accountable_person>
                </firm>
                <client>
                    <name><?= htmlspecialchars($invoice['client']['client_name'], ENT_XML1, 'UTF-8') ?></name>
                    <is_person><?= $invoice['client']['is_to_person'] ?></is_person>
                    <bulstat><?= $invoice['client']['client_bulstat'] ?></bulstat> 
                    <is_client_vat_registered><?= $invoice['client']['client_vat_registered'] ?></is_client_vat_registered> 
                    <vat_number><?= $invoice['client']['vat_number'] ?></vat_number> 
                    <client_ident_num><?= $invoice['client']['client_ident_num'] ?></client_ident_num>
                    <client_address><?= htmlspecialchars($invoice['client']['client_address'], ENT_XML1, 'UTF-8') ?></client_address>
                    <client_city><?= $invoice['client']['client_city'] ?></client_city>
                    <client_country><?= $invoice['client']['client_country'] ?></client_country>
                    <accountable_person><?= $invoice['client']['accountable_person'] ?></accountable_person>
                    <recipient_name><?= $invoice['client']['accountable_person'] ?></recipient_name>
                </client>
                <items>
                    <?php foreach ($invoice['items'] as $item) { ?>
                        <item>
                            <name><?= htmlspecialchars($item['name'], ENT_XML1, 'UTF-8') ?></name>
                            <quantity><?= $item['quantity'] ?></quantity>
                            <quantity_type><?= $item['quantity_type'] ?></quantity_type>
                            <single_price><?= $item['single_price'] ?></single_price>
                            <total_price><?= $item['total_price'] ?></total_price>
                            <position><?= $item['position'] ?></position>
                        </item>
                    <?php } ?>
                </items>
            </invoice>
            <?php
        }
        echo '</invoices>';
        exit();
    }

    private function getXmlHeaders()
    {
        $filename = 'export_invoices.xml';
        if ($this->from != null && $this->to != null) {
            $this->from = date('d.m.Y', $this->from);
            $this->to = date('d.m.Y', $this->to);
            $filename = 'export_invoices_from_' . $this->from . '_to_' . $this->to . '.xml';
        }
        header('Content-Type: application/xml; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
    }

}
