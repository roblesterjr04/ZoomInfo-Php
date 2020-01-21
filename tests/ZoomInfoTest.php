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
                'name',
                'revenue',
                'employeeCount',
                'logo',
                'website',
                'createdDate',
                'companyStatus',
                'companyStatusDate',
                'phone',
                'descriptionList',
                'country',
                'ticker'
            ]
        ]);

        $this->assertTrue($company->success);
    }
}
