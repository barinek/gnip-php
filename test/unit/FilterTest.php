<?php
require_once dirname(__FILE__).'/../test_helper.php';

class FilterTest extends PHPUnit_Framework_TestCase 
{
    function testToXmlWithoutpostUrlOrJid()
    {
        $expected_xml = '<filter name="test" fullData="true">' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), new Services_Gnip_Rule("actor", "you"), new Services_Gnip_Rule("actor", "bob"));

        $f = new Services_Gnip_Filter('test', 'true', '', '', $rules);

        $this->assertEquals($expected_xml, $f->toXML());	
    }

    function testToXmlWithpostUrl()
    {
        $expected_xml = '<filter name="test" fullData="true">' .
			'<postUrl>http://example.com</postUrl>' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), 
			new Services_Gnip_Rule("actor", "you"), 
			new Services_Gnip_Rule("actor", "bob"));

        $f = new Services_Gnip_Filter('test', 'true', 'http://example.com', '', $rules);
        $this->assertEquals($expected_xml, $f->toXML());
	}

    function testToXmlWithJid()
    {
        $expected_xml = '<filter name="test" fullData="true">' .
			'<jid>joe@jabber.org</jid>' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), 
			new Services_Gnip_Rule("actor", "you"), 
			new Services_Gnip_Rule("actor", "bob"));

        $f = new Services_Gnip_Filter('test', 'true', '', 'joe@jabber.org', $rules);
        $this->assertEquals($expected_xml, $f->toXML());
	}

 function testFromXmlWithoutpostUrlOrJid()
    {
        $xml = '<filter name="test" fullData="true">' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), 
			new Services_Gnip_Rule("actor", "you"), 
			new Services_Gnip_Rule("actor", "bob"));

        $f = Services_Gnip_Filter::fromXml(new SimpleXMLElement($xml));
		$this->assertEquals("test", $f->name);
		$this->assertEquals("true", $f->fullData);
		$this->assertEquals("", $f->postUrl);
		$this->assertEquals("", $f->jid);
		$this->assertEquals($rules, $f->rules);	
    }

	function testFromXmlWithpostUrl()
    {
        $xml = '<filter name="test" fullData="true">' .
            '<postUrl>http://example.com</postUrl>' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), 
			new Services_Gnip_Rule("actor", "you"), 
			new Services_Gnip_Rule("actor", "bob"));

        $f = Services_Gnip_Filter::fromXml(new SimpleXMLElement($xml));
		$this->assertEquals("test", $f->name);
		$this->assertEquals("true", $f->fullData);
		$this->assertEquals("http://example.com", $f->postUrl);
		$this->assertEquals("", $f->jid);
		$this->assertEquals($rules, $f->rules);	
    }

	function testFromXmlWithJid()
    {
        $xml = '<filter name="test" fullData="true">' .
            '<jid>joe@jabber.org</jid>' .
            '<rule type="actor" value="me"/>' .
            '<rule type="actor" value="you"/>' .
            '<rule type="actor" value="bob"/>' .
            '</filter>';

        $rules = array(new Services_Gnip_Rule("actor", "me"), 
			new Services_Gnip_Rule("actor", "you"), 
			new Services_Gnip_Rule("actor", "bob"));

        $f = Services_Gnip_Filter::fromXml(new SimpleXMLElement($xml));
		$this->assertEquals("test", $f->name);
		$this->assertEquals("true", $f->fullData);
		$this->assertEquals("", $f->postUrl);
		$this->assertEquals("joe@jabber.org", $f->jid);
		$this->assertEquals($rules, $f->rules);	
    }
}
?>