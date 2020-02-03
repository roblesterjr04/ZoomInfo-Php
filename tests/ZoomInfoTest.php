<?php

use Orchestra\Testbench\TestCase;
use ZoomInfo\ZoomInfo;

class ZoomInfoTest extends TestCase
{
    public function testGetCompany()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $company = $zi->enrich->company->get([
            'matchCompanyInput' => [
                [
                    'companyWebsite' => 'github.com'
                ]
            ],
            'outputFields' => [
                'id',
            ]
        ]);

        $this->assertObjectHasAttribute('success', $company);
    }

    public function testSearchCompany()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->search->company->get([
            "region" => "usa.california.sanfrancisco",
        	"industryCodes" => "education.university",
        	"rpp" => 10
        ]);

        $this->assertObjectHasAttribute('totalResults', $results);
    }

    public function testGetContact()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $contact = $zi->enrich->contact->get([
            'matchPersonInput' => [
                [
                    'personEmailAddress' => 'tim@apple.com'
                ]
            ],
            'outputFields' => [
                'id',
            ]
        ]);

        $this->assertObjectHasAttribute('success', $contact);
    }

    public function testSearchContact()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->search->contact->get([
            "firstName" => "Tim",
            "lastName" => "Cook"
        ]);

        $this->assertObjectHasAttribute('totalResults', $results);
    }

    public function testSearchScoop()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->search->scoop->get([
            "companyName" => "Apple",
        	"publishedStartDate" => "2018-11-01",
        	"publishedEndDate" => "2019-03-01",
        	"scoopType" => "6",
        	"updatedSinceCreation" => false
        ]);

        $this->assertObjectHasAttribute('totalResults', $results);
    }

    public function testLookupGender()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->lookup->gender->get();

        $this->assertIsArray($results);
    }

    public function testLookupCompanyRanking()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->lookup->companyranking->get();

        $this->assertIsArray($results);
    }

    public function testLookupCountry()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $results = $zi->lookup->country->get();

        $this->assertIsArray($results);
    }

    public function testGetOrgchart()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $chart = $zi->enrich->orgchart->get([
            "rpp" => 10,
            "companyId" => "18579882",
            "department" => "Sales, Finance",
            "page" => 0
        ]);

        $this->assertObjectHasAttribute('totalResults', $chart);
    }

    public function testGetTechnology()
    {
        $zi = new ZoomInfo([
            'username' => getenv('ZI_USER'),
            'password' => getenv('ZI_PASS')
        ]);

        $tech = $zi->enrich->technology->get([
            "companyId" => "18579882"
        ]);

    }
}
